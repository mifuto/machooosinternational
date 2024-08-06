/*!
 * Real3D FlipBook [https://real3dflipbook.com]
 * @author creativeinteractivemedia [https://codecanyon.net/user/creativeinteractivemedia/portfolio]
 * @version 3.42
 * @date 2023-10-23
 */

var FLIPBOOK = FLIPBOOK || {};

FLIPBOOK.PdfService = function (pdfDocument, main, options) {
    var self = this;
    this.pdfDocument = pdfDocument;
    this.pdfInfo = pdfDocument._pdfInfo;
    this.numPages = this.pdfInfo.numPages;
    this.webgl = options.viewMode == 'webgl' && this.numPages > 1;
    this.options = options;
    this.main = options.main;
    this.main = main;

    this.pages = [];
    this.thumbs = [];
    this.canvasBuffer = [];
    window.cb = this.canvasBuffer;
    this.viewports = [];
    this.eventBus = new EventBus();

    this.linkService = new PDFLinkService({
        eventBus: this.eventBus,
    });
    this.linkService.setViewer(this.main);
    this.linkService.setDocument(pdfDocument);

    var linkTarget;
    switch (options.pdfLinkTarget) {
        case '_self':
            linkTarget = pdfjsLib.LinkTarget.SELF;
            break;
        case '_parent':
            linkTarget = pdfjsLib.LinkTarget.PARENT;
            break;
        case '_top':
            linkTarget = pdfjsLib.LinkTarget.TOP;
            break;
        default:
            linkTarget = pdfjsLib.LinkTarget.BLANK;
            break;
    }

    this.linkService.externalLinkTarget = linkTarget;

    window._dbg = 0;

    this.getCanvas = function (_) {
        var i;
        var c;

        for (i = 0; i < this.canvasBuffer.length; i++) {
            c = this.canvasBuffer[i];
            if (c.available) {
                c.available = false;
                c.double = false;
                break;
            }
            c = null;
        }

        if (!c) {
            c = document.createElement('canvas');
            c.available = false;
            c.index = this.canvasBuffer.length;
            this.canvasBuffer.push(c);
        }

        return c;
    };

    this.loadThumbs = function (convertToBlob, callback) {
        var self = this;

        this.thumbLoading = this.thumbLoading || 0;

        if (this.thumbLoading >= this.pdfInfo.numPages) {
            callback.call(self);
        } else {
            this.loadThumb(this.thumbLoading, function (c) {
                self.options.thumbLoaded(c);
                self.thumbLoading++;
                self.loadThumbs(convertToBlob, callback);
            });
        }
    };

    this.loadThumb = function (index, callback) {
        var self = this;

        this.getViewport(index, function () {
            var page = self.pages[index];

            var scale = 100 / page.getViewport({ scale: 1 }).height;

            var viewport = page.getViewport({ scale: scale });

            var c = document.createElement('canvas');
            c.index = index;
            var context = c.getContext('2d');
            context.willReadFrequently = true;
            c.height = viewport.height;
            c.width = viewport.width;

            var renderContext = {
                canvasContext: context,
                viewport: viewport,
            };
            page.cleanupAfterRender = true;
            page.render(renderContext).then(function () {
                page.cleanup();

                if (callback) {
                    callback.call(self, c);
                }
            });
        });
    };

    this.init = function (backCover) {
        self.getViewport(0, function (viewport) {
            self.r1 = viewport.width / viewport.height;

            if (self.pdfInfo.numPages == 1) {
                self.double = false;
                self.main.trigger('pdfinit');
            } else {
                self.getViewport(1, function (viewport) {
                    self.r2 = viewport.width / viewport.height;
                    self.double = self.r2 / self.r1 > 1.5;

                    //last page index
                    self.backCover = backCover || true;

                    self.main.trigger('pdfinit');
                });
            }
        });
    };

    this.loadOutline = function (callback) {
        var self = this;
        this.pdfDocument.getOutline().then(function (outline) {
            self.outline = outline;
            self.outlineLoaded = true;
            callback.call(self, outline);
        });
    };

    this.startLoadingText = function () {
        this.loadingText = true;
    };

    this.stopLoadingText = function () {
        this.loadingText = false;
    };

    this.getPdfPage = async function (index) {
        const page = this.pages[index] || (await this.pdfDocument.getPage(index + 1));
        return page;
    };

    this.getPageViewport = async function (index) {
        const page = await this.getPage(index);
        const viewport = page.getViewport({ scale: 1 });
        return viewport;
    };

    this.getViewport = function (index, callback) {
        if (index >= self.pdfInfo.numPages) {
            return;
        }
        if (!self.pages[index]) {
            pdfDocument.getPage(index + 1).then(function (page) {
                self.pages[page._pageIndex] = page;
                self.getViewport(page._pageIndex, callback);
            });
        } else {
            self.viewports[index] = self.pages[index].getViewport({ scale: 1 });
            callback.call(self, self.viewports[index]);
        }
    };

    this.getPageViewport = async function (index) {
        if (!this.pages[index]) {
            this.pages[index] = await pdfDocument.getPage(index + 1);
        }
        this.viewports[index] = this.pages[index].getViewport({ scale: 1 });
        return this.viewports[index];
    };

    this.getText = function (index, callback) {
        var self = this;
        this.getViewport(index, function (_) {
            var page = self.pages[index];

            self.getTextContent(page, function () {
                callback.call(self, page);
            });
        });
    };

    this.getTextAllPages = function (callback) {
        var self = this;

        this.loadingTextFromPage = this.loadingTextFromPage || 0;

        this.getText(this.loadingTextFromPage, function () {
            if (self.loadingTextFromPage == self.numPages - 1) {
                if (callback) {
                    callback.call(self);
                }
            } else {
                self.loadingTextFromPage++;
                self.getTextAllPages(callback);
            }
        });
    };

    this.findInPage = function (str, index, callback) {
        var self = this;
        this.findInPageCallbacks = this.findInPageCallbacks || [];
        this.findInPageCallbacks[index] = callback;
        this.searchingString = str;

        if (this.pages[index] && this.pages[index].textContent) {
            self.findInPageTextContentAvailable(this.pages[index], index);
        } else {
            this.getText(index, function (page) {
                self.findInPageTextContentAvailable(page, index);
            });
        }
    };

    this.findInPageTextContentAvailable = function (page, index) {
        var arr = page.textContent.items;
        if (typeof page.textContentString == 'undefined') {
            page.textContentString = '';
            for (var i = 0; i < arr.length; i++) {
                page.textContentString += arr[i].str;
            }
        }

        var self = this;

        var matches = [];

        var str = '';

        arr.forEach(function (item) {
            str += item.str;
        });

        str = str.replace(/\s+/g, ' ').trim();
        self.searchingString = self.searchingString.replace(/\s+/g, ' ').trim();

        let regex = new RegExp(self.searchingString, 'ig'); // case insensitive, return array of matches
        let regexSingle = new RegExp(self.searchingString, 'i'); // case insensitive
        let regexMatches = str.match(regex);

        if (regexMatches) {
            regexMatches.forEach(function (_) {
                matches.push({ page: index });
            });

            let i = str.search(regexSingle);

            if (i !== -1) {
                str = str.substring(i);
            }
        }

        var callback = this.findInPageCallbacks[index];
        if (callback) {
            callback.call(this, matches, page.htmlContent, page._pageIndex, str.substring(0, 60) + '...');
        }

        this.findInPageCallbacks[index] = null;
    };

    this.getThumb = function (index, size, callback) {
        this.getViewport(index, function (viewport) {
            var page = self.pages[index];
            if (page.thumb) {
                callback.call(self, page.thumb);
            } else {
                //render thumb first
                var scale = size / self.viewports[index].height;
                viewport = page.getViewport({ scale: scale });
                var c = document.createElement('canvas');
                page.thumb = c;
                var context = c.getContext('2d');
                c.height = viewport.height;
                c.width = viewport.width;

                var renderContext = {
                    canvasContext: context,
                    viewport: viewport,
                };
                page.cleanupAfterRender = true;
                page.render(renderContext).then(function () {
                    page.cleanup();
                    callback.call(self, page.thumb);
                });
            }
        });
    };

    this.getPage = function (index, callback) {
        var self = this;
        var pdfPageIndex = self.double ? Math.round(index / 2) + 1 : index + 1;
        if (pdfPageIndex > this.pdfInfo.numPages) {
            return;
        }
        pdfDocument.getPage(index).then(function (p) {
            self.renderPage(p, callback);
        });
    };

    this.renderPage = async function (page, size) {
        page.renderingPromises = page.renderingPromises || {};

        if (!page.renderingPromises[size]) {
            var v = page.getViewport({ scale: 1 });
            var portrait = v.width <= v.height;
            var scale = portrait || !self.webgl ? size / v.height : size / v.width;
            var viewport = page.getViewport({ scale: scale });
            var canvas;

            if (typeof OffscreenCanvas != 'undefined') {
                canvas = new OffscreenCanvas(viewport.width, viewport.height);
            } else {
                canvas = self.getCanvas(size);
            }

            canvas.size = size;
            canvas.pdfPageIndex = page._pageIndex;

            canvas.width = viewport.width;
            canvas.height = viewport.height;

            var ctx = canvas.getContext('2d');
            ctx.fillStyle = '#000000';
            ctx.willReadFrequently = true;

            var renderContext = {
                canvasContext: ctx,
                viewport: viewport,
            };

            page.scale = scale;
            page.canvas = page.canvas || {};
            page.canvas[size] = canvas;
            page.canvas[size].ratio = viewport.width / viewport.height;

            page.cleanupAfterRender = true;

            page.renderingPromises[size] = page.render(renderContext).promise;
        }

        await page.renderingPromises[size];
        canvas = null;
    };

    this.renderBookPage = async function (bookPageIndex, size, callback) {
        var pageIndex = this.options.doublePage ? Math.round(bookPageIndex / 2) : bookPageIndex;

        var page = this.pages[pageIndex] || (await pdfDocument.getPage(pageIndex + 1));

        page.renderCallbacks = page.renderCallbacks || {};
        page.renderCallbacks[size] = page.renderCallbacks[size] || [];
        page.renderCallbacks[size].push(callback);

        await this.renderPage(page, size);

        await this.createPageImage(page, size);

        page.renderCallbacks[size].forEach((callback) => {
            this.onPdfPageImageReady(page, size, callback);
        });
        page.renderCallbacks[size] = [];
    };

    this.loadPageTextLayer = async function (pageIndex) {
        const page = await self.getPdfPage(pageIndex);
        if (self.options.pdfTextLayer) {
            page.textloadingTask = page.textloadingTask || page.getTextContent();
            page.textContent = await page.textloadingTask;
        }

        if (self.options.annotationLayer) {
            page.annotationloadingTask = page.annotationloadingTask || page.getAnnotations({ intent: 'display' });
            page.annotations = await page.annotationloadingTask;
        }
        return page;
    };

    this.loadTextLayer = async function (bookPageIndex, callback) {
        var pageIndex = this.options.doublePage ? Math.round(bookPageIndex / 2) : bookPageIndex;
        var self = this;

        const pdfPage = await this.loadPageTextLayer(pageIndex);

        var page = options.pages[bookPageIndex] || {};
        page.index = bookPageIndex;

        if (!page.htmlContentInitialized) {
            page.htmlContentInitialized = true;
            page.textRendering = true;

            var h = document.createElement('div');
            h.classList.add('flipbook-page-htmlContent');
            h.dataset.pageNumber = pageIndex + 1;

            if (page.htmlContent) {
                jQuery(h).append(jQuery(page.htmlContent));
            }

            page.htmlContent = h;

            if (pdfPage.textContent) {
                var textLayerDiv = document.createElement('div');
                textLayerDiv.className = 'flipbook-textLayer';
                h.appendChild(textLayerDiv);
                page.textLayerDiv = h;

                var scale = 1000 / pdfPage.getViewport({ scale: 1 }).height;

                textLayerDiv.style.width =
                    String(
                        (1000 * pdfPage.getViewport({ scale: 1 }).width) / pdfPage.getViewport({ scale: 1 }).height
                    ) + 'px';
                textLayerDiv.style.height = '1000px';

                var textLayer = new TextLayerBuilder({
                    eventBus: self.eventBus,
                    textLayerDiv: textLayerDiv,
                    pageIndex: pageIndex,
                    viewport: pdfPage.getViewport({ scale: scale }),
                });

                //the page. It is set to page.number - 1.
                textLayer.setTextContent(pdfPage.textContent);
                textLayer.render();

                if (pdfPage.annotations.length > 0) {
                    var div = document.createElement('div');
                    div.className = 'annotationLayer';
                    h.appendChild(div);

                    var parameters = {
                        viewport: pdfPage
                            .getViewport({ scale: 1000 / pdfPage.getViewport({ scale: 1 }).height })
                            .clone({ dontFlip: true }),
                        div: div,
                        annotations: pdfPage.annotations,
                        page: pdfPage,
                        linkService: self.linkService,
                    };

                    pdfjsLib.AnnotationLayer.render(parameters);
                }

                h.style.transformOrigin = '0 0';

                this.eventBus.on('textlayerrendered', function (e) {
                    if (e.source.pageIdx == pageIndex) {
                        page.textRendering = false;
                        page.textLayerRendered = true;

                        self.main.trigger('textlayerrendered', { index: pageIndex });

                        if (self.options.pdfAutoLinks) {
                            page.htmlContent.querySelectorAll('span').forEach(function (span) {
                                span.innerHTML = self.Linkify(span.innerHTML);
                            });
                        }

                        callback.call(this);
                    }
                });
            } else {
                callback.call(this);
            }
        } else {
            callback.call(this);
        }
    };

    this.Linkify = function (inputText) {
        //URLs starting with http://, https://, or ftp://
        var replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
        var replacedText = inputText.replace(
            replacePattern1,
            '<a href="$1" target="_blank" class="flipbook-page-auto-link">$1</a>'
        );

        //URLs starting with www. (without // before it, or it'd re-link the ones done above)
        var replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
        replacedText = replacedText.replace(
            replacePattern2,
            '$1<a href="http://$2" target="_blank" class="flipbook-page-auto-link">$2</a>'
        );

        //Change email addresses to mailto:: links
        var replacePattern3 = /(([a-zA-Z0-9_\-\.]+)@[a-zA-Z_]+?(?:\.[a-zA-Z]{2,6}))+/gim;
        replacedText = replacedText.replace(
            replacePattern3,
            '<a href="mailto:$1" class="flipbook-page-auto-link">$1</a>'
        );

        return replacedText;
    };

    this.convertToBlob = async function (canvas, mimeType = 'image/webp', quality = 0.8) {
        return new Promise((resolve, reject) => {
            if (canvas instanceof OffscreenCanvas) {
                canvas.convertToBlob({ type: mimeType, quality }).then(resolve).catch(reject);
            } else {
                canvas.toBlob(
                    (blob) => {
                        if (blob) {
                            resolve(blob);
                        } else {
                            reject(new Error('Unable to convert canvas to Blob.'));
                        }
                    },
                    mimeType,
                    quality
                );
            }
        });
    };

    this.onBookPageRendered = function (page, canvas, index, size) {
        this.main.trigger('pageLoaded', {
            index: index,
            size: size,
            canvas: canvas,
            images: page.image[size],
        });
    };

    this.getBookPage = function (index, size) {
        var toReturn = null;
        this.canvasBuffer.forEach(function (c) {
            if (c.pageIndex == index && c.size == size) {
                toReturn = c;
            }
        });

        return toReturn;
    };

    this.onPdfPageImageReady = function (page, size, callback) {
        if (!page.canvas) {
            return;
        }
        if (!page.canvas[size]) {
            return;
        }
        if (!page.image[size]) {
            return;
        }

        var c = page.canvas[size];
        var img = page.image[size];
        var pdfPageIndex = page._pageIndex;
        c.pdfPageIndex = pdfPageIndex;

        if (options.doublePage) {
            if (pdfPageIndex == 0) {
                c.pageIndex = 0;
                self.onBookPageRendered(page, c, 0, size);
            } else if (pdfPageIndex == options.pages.length / 2) {
                c.pageIndex = options.numPages - 1;
                self.onBookPageRendered(page, c, options.numPages - 1, size);
            } else {
                if (self.webgl) {
                    c.double = true;
                    c.scaleX = c.width / 2 / size;
                    c.pageIndex = 2 * pdfPageIndex;
                    self.onBookPageRendered(page, c, 2 * pdfPageIndex, size);
                    self.onBookPageRendered(page, c, 2 * pdfPageIndex - 1, size);
                } else {
                    var loadedIndexR = self.options.rightToLeft ? 2 * pdfPageIndex - 1 : 2 * pdfPageIndex;
                    var loadedIndexL = self.options.rightToLeft ? 2 * pdfPageIndex : 2 * pdfPageIndex - 1;

                    self.onBookPageRendered(page, img, loadedIndexL, size);
                    self.onBookPageRendered(page, img.clone, loadedIndexR, size);

                    c.size = 200;
                    c.pageIndex = loadedIndexL;
                }
            }
        } else {
            c.pageIndex = pdfPageIndex;
            c.index = pdfPageIndex;
            c.size = size;
            self.onBookPageRendered(page, c, pdfPageIndex, size);
        }

        if (callback) {
            callback.call(self, {
                canvas: c,
                image: page.image,
                /*lCanvas: lCanvas, rCanvas: rCanvas, */ size: size,
                pdfPageIndex: pdfPageIndex,
                htmlContent: page.htmlContent,
            });
        }
        callback = null;
    };

    this.loadImage = async function (imageElement) {
        return new Promise((resolve, reject) => {
            if (imageElement.complete) {
                resolve(imageElement);
            } else {
                imageElement.onload = () => {
                    imageElement.onload = null;
                    resolve(imageElement);
                };

                imageElement.onerror = (error) => {
                    imageElement.onerror = null;
                    reject(error);
                };
            }
        });
    };

    this.createPageImage = async function (page, size) {
        page.convertToBlobPromises = page.convertToBlobPromises || {};
        if (!page.convertToBlobPromises[size]) {
            page.convertToBlobPromises[size] = this.convertToBlob(page.canvas[size]);
        }

        const blob = await page.convertToBlobPromises[size];
        page.image = page.image || {};
        if (!page.image[size]) {
            page.image[size] = new Image();
        }
        if (!page.image[size].src) {
            const url = URL.createObjectURL(blob);
            page.image[size].src = url;
        }
        await this.loadImage(page.image[size]);

        if (options.doublePage && page._pageIndex > 0 && page._pageIndex < options.pages.length / 2 && !this.webgl) {
            if (!page.image[size].clone) {
                page.image[size].clone = new Image();
            }
            page.image[size].clone.src = URL.createObjectURL(blob);
            page.image[size].clone.className = 'clone';
            await this.loadImage(page.image[size].clone);
        }

        return page;
    };

    this.getTextContent = function (page, callback) {
        page.getTextCallback = callback;
        if (page.textContent) {
            page.getTextCallback(page);
        } else {
            if (page.textContentLoading) {
                var self = this;
                setTimeout(function () {
                    self.getTextContent(page, callback);
                }, 100);
                return;
            }

            page.getTextContent().then(function (textContent) {
                page.textContent = textContent;
                page.textContentLoading = false;
                page.textContentLoaded = true;

                page.getTextCallback(page);
            });

            page.textContentLoading = true;
        }
    };
};

FLIPBOOK.PdfService.prototype = {};

var _createClass = (function () {
    function defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ('value' in descriptor) {
                descriptor.writable = true;
            }
            Object.defineProperty(target, descriptor.key, descriptor);
        }
    }
    return function (Constructor, protoProps, staticProps) {
        if (protoProps) {
            defineProperties(Constructor.prototype, protoProps);
        }
        if (staticProps) {
            defineProperties(Constructor, staticProps);
        }
        return Constructor;
    };
})();

function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
        throw new TypeError('Cannot call a class as a function');
    }
}

// eslint-disable-next-line no-redeclare
var EventBus = (function () {
    function EventBus() {
        var _ref7 = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
        var _ref7$dispatchToDOM = _ref7.dispatchToDOM;
        var dispatchToDOM = _ref7$dispatchToDOM === undefined ? false : _ref7$dispatchToDOM;

        _classCallCheck(this, EventBus);

        this._listeners = Object.create(null);
        this._dispatchToDOM = dispatchToDOM === true;
    }

    _createClass(EventBus, [
        {
            key: 'on',
            value: function on(eventName, listener) {
                var eventListeners = this._listeners[eventName];
                if (!eventListeners) {
                    eventListeners = [];
                    this._listeners[eventName] = eventListeners;
                }
                eventListeners.push(listener);
            },
        },
        {
            key: 'off',
            value: function off(eventName, listener) {
                var eventListeners = this._listeners[eventName];
                var i = void 0;
                if (!eventListeners || (i = eventListeners.indexOf(listener)) < 0) {
                    return;
                }
                eventListeners.splice(i, 1);
            },
        },
        {
            key: 'dispatch',
            value: function dispatch(eventName) {
                var eventListeners = this._listeners[eventName];
                if (!eventListeners || eventListeners.length === 0) {
                    if (this._dispatchToDOM) {
                        var _args5 = Array.prototype.slice.call(arguments, 1);
                        this._dispatchDOMEvent(eventName, _args5);
                    }
                    return;
                }
                var args = Array.prototype.slice.call(arguments, 1);
                eventListeners.slice(0).forEach(function (listener) {
                    listener.apply(null, args);
                });
                if (this._dispatchToDOM) {
                    this._dispatchDOMEvent(eventName, args);
                }
            },
        },
        {
            key: '_dispatchDOMEvent',
            value: function _dispatchDOMEvent(eventName) {
                var args = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

                if (!this._dispatchToDOM) {
                    return;
                }
                var details = Object.create(null);
                if (args && args.length > 0) {
                    var obj = args[0];
                    for (var key in obj) {
                        var value = obj[key];
                        if (key === 'source') {
                            if (value === window || value === document) {
                                return;
                            }
                            continue;
                        }
                        details[key] = value;
                    }
                }
                var event = document.createEvent('CustomEvent');
                event.initCustomEvent(eventName, true, true, details);
                document.dispatchEvent(event);
            },
        },
    ]);

    return EventBus;
})();

var EXPAND_DIVS_TIMEOUT = 300;
var MATCH_SCROLL_OFFSET_TOP = -50;
var MATCH_SCROLL_OFFSET_LEFT = -400;

var TextLayerBuilder = (function () {
    function TextLayerBuilder(_ref) {
        var textLayerDiv = _ref.textLayerDiv;
        var eventBus = _ref.eventBus;
        var pageIndex = _ref.pageIndex;
        var viewport = _ref.viewport;
        var _ref$findController = _ref.findController;
        var findController = _ref$findController === undefined ? null : _ref$findController;
        var _ref$enhanceTextSelec = _ref.enhanceTextSelection;
        var enhanceTextSelection = _ref$enhanceTextSelec === undefined ? false : _ref$enhanceTextSelec;

        _classCallCheck(this, TextLayerBuilder);

        this.textLayerDiv = textLayerDiv;
        this.eventBus = eventBus || (0, _dom_events.getGlobalEventBus)();
        this.textContent = null;
        this.textContentItemsStr = [];
        this.textContentStream = null;
        this.renderingDone = false;
        this.pageIdx = pageIndex;
        this.pageNumber = this.pageIdx + 1;
        this.matches = [];
        this.viewport = viewport;
        this.textDivs = [];
        this.findController = findController;
        this.textLayerRenderTask = null;
        this.enhanceTextSelection = enhanceTextSelection;
        this._boundEvents = Object.create(null);
        this._bindEvents();
        this._bindMouse();
    }

    _createClass(TextLayerBuilder, [
        {
            key: '_finishRendering',
            value: function _finishRendering() {
                this.renderingDone = true;
                if (!this.enhanceTextSelection) {
                    var endOfContent = document.createElement('div');
                    endOfContent.className = 'endOfContent';
                    this.textLayerDiv.appendChild(endOfContent);
                }
                this.eventBus.dispatch('textlayerrendered', {
                    source: this,
                    pageNumber: this.pageNumber,
                    numTextDivs: this.textDivs.length,
                });
            },
        },
        {
            key: 'render',
            value: function render() {
                var _this = this;

                var timeout = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;

                if (!(this.textContent || this.textContentStream) || this.renderingDone) {
                    return;
                }
                this.cancel();
                this.textDivs = [];
                var textLayerFrag = document.createDocumentFragment();
                this.textLayerRenderTask = (0, pdfjsLib.renderTextLayer)({
                    textContent: this.textContent,
                    textContentStream: this.textContentStream,
                    container: textLayerFrag,
                    viewport: this.viewport,
                    textDivs: this.textDivs,
                    textContentItemsStr: this.textContentItemsStr,
                    timeout: timeout,
                    enhanceTextSelection: this.enhanceTextSelection,
                });
                this.textLayerRenderTask.promise.then(
                    function () {
                        _this.textLayerDiv.appendChild(textLayerFrag);
                        _this._finishRendering();
                        _this.updateMatches();
                    },
                    function (_) {}
                );
            },
        },
        {
            key: 'cancel',
            value: function cancel() {
                if (this.textLayerRenderTask) {
                    this.textLayerRenderTask.cancel();
                    this.textLayerRenderTask = null;
                }
            },
        },
        {
            key: 'setTextContentStream',
            value: function setTextContentStream(readableStream) {
                this.cancel();
                this.textContentStream = readableStream;
            },
        },
        {
            key: 'setTextContent',
            value: function setTextContent(textContent) {
                this.cancel();
                this.textContent = textContent;
            },
        },
        {
            key: 'convertMatches',
            value: function convertMatches(matches, matchesLength) {
                var i = 0;
                var iIndex = 0;
                var textContentItemsStr = this.textContentItemsStr;
                var end = textContentItemsStr.length - 1;
                var queryLen = this.findController === null ? 0 : this.findController.state.query.length;
                var ret = [];
                if (!matches) {
                    return ret;
                }
                for (var m = 0, len = matches.length; m < len; m++) {
                    var matchIdx = matches[m];
                    while (i !== end && matchIdx >= iIndex + textContentItemsStr[i].length) {
                        iIndex += textContentItemsStr[i].length;
                        i++;
                    }
                    if (i === textContentItemsStr.length) {
                        console.error('Could not find a matching mapping');
                    }
                    var match = {
                        begin: {
                            divIdx: i,
                            offset: matchIdx - iIndex,
                        },
                    };
                    if (matchesLength) {
                        matchIdx += matchesLength[m];
                    } else {
                        matchIdx += queryLen;
                    }
                    while (i !== end && matchIdx > iIndex + textContentItemsStr[i].length) {
                        iIndex += textContentItemsStr[i].length;
                        i++;
                    }
                    match.end = {
                        divIdx: i,
                        offset: matchIdx - iIndex,
                    };
                    ret.push(match);
                }
                return ret;
            },
        },
        {
            key: 'renderMatches',
            value: function renderMatches(matches) {
                if (matches.length === 0) {
                    return;
                }
                var textContentItemsStr = this.textContentItemsStr;
                var textDivs = this.textDivs;
                var prevEnd = null;
                var pageIdx = this.pageIdx;
                var isSelectedPage =
                    this.findController === null ? false : pageIdx === this.findController.selected.pageIdx;
                var selectedMatchIdx = this.findController === null ? -1 : this.findController.selected.matchIdx;
                var highlightAll = this.findController === null ? false : this.findController.state.highlightAll;
                var infinity = {
                    divIdx: -1,
                    offset: undefined,
                };
                function beginText(begin, className) {
                    var divIdx = begin.divIdx;
                    textDivs[divIdx].textContent = '';
                    appendTextToDiv(divIdx, 0, begin.offset, className);
                }
                function appendTextToDiv(divIdx, fromOffset, toOffset, className) {
                    var div = textDivs[divIdx];
                    var content = textContentItemsStr[divIdx].substring(fromOffset, toOffset);
                    var node = document.createTextNode(content);
                    if (className) {
                        var span = document.createElement('span');
                        span.className = className;
                        span.appendChild(node);
                        div.appendChild(span);
                        return;
                    }
                    div.appendChild(node);
                }
                var i0 = selectedMatchIdx;
                var i1 = i0 + 1;
                if (highlightAll) {
                    i0 = 0;
                    i1 = matches.length;
                } else if (!isSelectedPage) {
                    return;
                }
                for (var i = i0; i < i1; i++) {
                    var match = matches[i];
                    var begin = match.begin;
                    var end = match.end;
                    var isSelected = isSelectedPage && i === selectedMatchIdx;
                    var highlightSuffix = isSelected ? ' selected' : '';
                    if (this.findController) {
                        if (
                            this.findController.selected.matchIdx === i &&
                            this.findController.selected.pageIdx === pageIdx
                        ) {
                            var spot = {
                                top: MATCH_SCROLL_OFFSET_TOP,
                                left: MATCH_SCROLL_OFFSET_LEFT,
                            };
                            (0, _ui_utils.scrollIntoView)(textDivs[begin.divIdx], spot, true);
                        }
                    }
                    if (!prevEnd || begin.divIdx !== prevEnd.divIdx) {
                        if (prevEnd !== null) {
                            appendTextToDiv(prevEnd.divIdx, prevEnd.offset, infinity.offset);
                        }
                        beginText(begin);
                    } else {
                        appendTextToDiv(prevEnd.divIdx, prevEnd.offset, begin.offset);
                    }
                    if (begin.divIdx === end.divIdx) {
                        appendTextToDiv(begin.divIdx, begin.offset, end.offset, 'highlight' + highlightSuffix);
                    } else {
                        appendTextToDiv(
                            begin.divIdx,
                            begin.offset,
                            infinity.offset,
                            'highlight begin' + highlightSuffix
                        );
                        for (var n0 = begin.divIdx + 1, n1 = end.divIdx; n0 < n1; n0++) {
                            textDivs[n0].className = 'highlight middle' + highlightSuffix;
                        }
                        beginText(end, 'highlight end' + highlightSuffix);
                    }
                    prevEnd = end;
                }
                if (prevEnd) {
                    appendTextToDiv(prevEnd.divIdx, prevEnd.offset, infinity.offset);
                }
            },
        },
        {
            key: 'updateMatches',
            value: function updateMatches() {
                if (!this.renderingDone) {
                    return;
                }
                var matches = this.matches;
                var textDivs = this.textDivs;
                var textContentItemsStr = this.textContentItemsStr;
                var clearedUntilDivIdx = -1;
                for (var i = 0, len = matches.length; i < len; i++) {
                    var match = matches[i];
                    var begin = Math.max(clearedUntilDivIdx, match.begin.divIdx);
                    for (var n = begin, end = match.end.divIdx; n <= end; n++) {
                        var div = textDivs[n];
                        div.textContent = textContentItemsStr[n];
                        div.className = '';
                    }
                    clearedUntilDivIdx = match.end.divIdx + 1;
                }
                if (!this.findController || !this.findController.highlightMatches) {
                    return;
                }
                var pageMatches = void 0;
                var pageMatchesLength = void 0;
                if (this.findController !== null) {
                    pageMatches = this.findController.pageMatches[this.pageIdx] || null;
                    pageMatchesLength = this.findController.pageMatchesLength
                        ? this.findController.pageMatchesLength[this.pageIdx] || null
                        : null;
                }
                this.matches = this.convertMatches(pageMatches, pageMatchesLength);
                this.renderMatches(this.matches);
            },
        },
        {
            key: '_bindEvents',
            value: function _bindEvents() {
                var _this2 = this;

                var eventBus = this.eventBus;
                var _boundEvents = this._boundEvents;

                _boundEvents.pageCancelled = function (evt) {
                    if (evt.pageNumber !== _this2.pageNumber) {
                        return;
                    }
                    if (_this2.textLayerRenderTask) {
                        console.error(
                            'TextLayerBuilder._bindEvents: `this.cancel()` should ' +
                                'have been called when the page was reset, or rendering cancelled.'
                        );
                        return;
                    }
                    for (var name in _boundEvents) {
                        eventBus.off(name.toLowerCase(), _boundEvents[name]);
                        delete _boundEvents[name];
                    }
                };
                _boundEvents.updateTextLayerMatches = function (evt) {
                    if (evt.pageIndex !== _this2.pageIdx && evt.pageIndex !== -1) {
                        return;
                    }
                    _this2.updateMatches();
                };
                eventBus.on('pagecancelled', _boundEvents.pageCancelled);
                eventBus.on('updatetextlayermatches', _boundEvents.updateTextLayerMatches);
            },
        },
        {
            key: '_bindMouse',
            value: function _bindMouse() {
                var _this3 = this;

                var div = this.textLayerDiv;
                var expandDivsTimer = null;
                div.addEventListener('mousedown', function (evt) {
                    if (_this3.enhanceTextSelection && _this3.textLayerRenderTask) {
                        _this3.textLayerRenderTask.expandTextDivs(true);
                        if (expandDivsTimer) {
                            clearTimeout(expandDivsTimer);
                            expandDivsTimer = null;
                        }
                        return;
                    }
                    var end = div.querySelector('.endOfContent');
                    if (!end) {
                        return;
                    }
                    var adjustTop = evt.target !== div;
                    adjustTop =
                        adjustTop && window.getComputedStyle(end).getPropertyValue('-moz-user-select') !== 'none';
                    if (adjustTop) {
                        var divBounds = div.getBoundingClientRect();
                        var r = Math.max(0, (evt.pageY - divBounds.top) / divBounds.height);
                        end.style.top = (r * 100).toFixed(2) + '%';
                    }
                    end.classList.add('active');
                });
                div.addEventListener('mouseup', function () {
                    if (_this3.enhanceTextSelection && _this3.textLayerRenderTask) {
                        expandDivsTimer = setTimeout(function () {
                            if (_this3.textLayerRenderTask) {
                                _this3.textLayerRenderTask.expandTextDivs(false);
                            }
                            expandDivsTimer = null;
                        }, EXPAND_DIVS_TIMEOUT);
                        return;
                    }
                    var end = div.querySelector('.endOfContent');
                    if (!end) {
                        return;
                    }
                    end.style.top = '';
                    end.classList.remove('active');
                });
            },
        },
    ]);

    return TextLayerBuilder;
})();

var DefaultTextLayerFactory = (function () {
    function DefaultTextLayerFactory() {
        _classCallCheck(this, DefaultTextLayerFactory);
    }

    _createClass(DefaultTextLayerFactory, [
        {
            key: 'createTextLayerBuilder',
            value: function createTextLayerBuilder(textLayerDiv, pageIndex, viewport) {
                var enhanceTextSelection = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;

                return new TextLayerBuilder({
                    textLayerDiv: textLayerDiv,
                    pageIndex: pageIndex,
                    viewport: viewport,
                    enhanceTextSelection: enhanceTextSelection,
                });
            },
        },
    ]);

    return DefaultTextLayerFactory;
})();

// eslint-disable-next-line no-redeclare
var PDFLinkService = (function () {
    function PDFLinkService() {
        var _ref = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
        var eventBus = _ref.eventBus;
        var _ref$externalLinkTarg = _ref.externalLinkTarget;
        var externalLinkTarget = _ref$externalLinkTarg === undefined ? null : _ref$externalLinkTarg;
        var _ref$externalLinkRel = _ref.externalLinkRel;
        var externalLinkRel = _ref$externalLinkRel === undefined ? null : _ref$externalLinkRel;

        _classCallCheck(this, PDFLinkService);

        this.eventBus = eventBus || (0, _dom_events.getGlobalEventBus)();
        this.externalLinkTarget = externalLinkTarget;
        this.externalLinkRel = externalLinkRel;
        this.baseUrl = null;
        this.pdfDocument = null;
        this.pdfViewer = null;
        this.pdfHistory = null;
        this._pagesRefCache = null;
    }

    _createClass(PDFLinkService, [
        {
            key: 'setDocument',
            value: function setDocument(pdfDocument) {
                var baseUrl = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

                this.baseUrl = baseUrl;
                this.pdfDocument = pdfDocument;
                this._pagesRefCache = Object.create(null);
            },
        },
        {
            key: 'setViewer',
            value: function setViewer(pdfViewer) {
                this.pdfViewer = pdfViewer;
            },
        },
        {
            key: 'setHistory',
            value: function setHistory(pdfHistory) {
                this.pdfHistory = pdfHistory;
            },
        },
        {
            key: 'goToDestination',
            value: function navigateTo(dest) {
                var _this = this;

                var goToDestination = function goToDestination(_ref2) {
                    var namedDest = _ref2.namedDest;
                    var explicitDest = _ref2.explicitDest;

                    var destRef = explicitDest[0];
                    var pageNumber = void 0;
                    if (destRef instanceof Object || typeof destRef == 'object') {
                        pageNumber = _this._cachedPageNumber(destRef);
                        if (pageNumber === null) {
                            _this.pdfDocument
                                .getPageIndex(destRef)
                                .then(function (pageIndex) {
                                    _this.cachePageRef(pageIndex + 1, destRef);
                                    goToDestination({
                                        namedDest: namedDest,
                                        explicitDest: explicitDest,
                                    });
                                })
                                .catch(function () {
                                    console.error(
                                        'PDFLinkService.navigateTo: "' +
                                            destRef +
                                            '" is not ' +
                                            ('a valid page reference, for dest="' + dest + '".')
                                    );
                                });
                            return;
                        }
                    } else if (Number.isInteger(destRef)) {
                        pageNumber = destRef + 1;
                    } else {
                        console.error(
                            'PDFLinkService.navigateTo: "' +
                                destRef +
                                '" is not ' +
                                ('a valid destination reference, for dest="' + dest + '".')
                        );
                        return;
                    }
                    if (!pageNumber || pageNumber < 1 || pageNumber > _this.pagesCount) {
                        console.error(
                            'PDFLinkService.navigateTo: "' +
                                pageNumber +
                                '" is not ' +
                                ('a valid page number, for dest="' + dest + '".')
                        );
                        return;
                    }
                    if (_this.pdfHistory) {
                        _this.pdfHistory.pushCurrentPosition();
                        _this.pdfHistory.push({
                            namedDest: namedDest,
                            explicitDest: explicitDest,
                            pageNumber: pageNumber,
                        });
                    }
                    _this.pdfViewer.scrollPageIntoView({
                        pageNumber: pageNumber,
                        destArray: explicitDest,
                    });
                };
                new Promise(function (resolve, _) {
                    if (typeof dest === 'string') {
                        _this.pdfDocument.getDestination(dest).then(function (destArray) {
                            resolve({
                                namedDest: dest,
                                explicitDest: destArray,
                            });
                        });
                        return;
                    }
                    resolve({
                        namedDest: '',
                        explicitDest: dest,
                    });
                }).then(function (data) {
                    if (!Array.isArray(data.explicitDest)) {
                        console.error(
                            'PDFLinkService.navigateTo: "' +
                                data.explicitDest +
                                '" is' +
                                (' not a valid destination array, for dest="' + dest + '".')
                        );
                        return;
                    }
                    goToDestination(data);
                });
            },
        },

        {
            key: 'navigateTo',

            value: function navigateTo(dest) {
                var _this = this;

                var goToDestination = function goToDestination(_ref2) {
                    var namedDest = _ref2.namedDest;
                    var explicitDest = _ref2.explicitDest;

                    var destRef = explicitDest[0];
                    var pageNumber = void 0;
                    if (destRef instanceof Object || typeof destRef == 'object') {
                        pageNumber = _this._cachedPageNumber(destRef);
                        if (pageNumber === null) {
                            _this.pdfDocument
                                .getPageIndex(destRef)
                                .then(function (pageIndex) {
                                    _this.cachePageRef(pageIndex + 1, destRef);
                                    goToDestination({
                                        namedDest: namedDest,
                                        explicitDest: explicitDest,
                                    });
                                })
                                .catch(function () {
                                    console.error(
                                        'PDFLinkService.navigateTo: "' +
                                            destRef +
                                            '" is not ' +
                                            ('a valid page reference, for dest="' + dest + '".')
                                    );
                                });
                            return;
                        }
                    } else if (Number.isInteger(destRef)) {
                        pageNumber = destRef + 1;
                    } else {
                        console.error(
                            'PDFLinkService.navigateTo: "' +
                                destRef +
                                '" is not ' +
                                ('a valid destination reference, for dest="' + dest + '".')
                        );
                        return;
                    }
                    if (!pageNumber || pageNumber < 1 || pageNumber > _this.pagesCount) {
                        console.error(
                            'PDFLinkService.navigateTo: "' +
                                pageNumber +
                                '" is not ' +
                                ('a valid page number, for dest="' + dest + '".')
                        );
                        return;
                    }
                    if (_this.pdfHistory) {
                        _this.pdfHistory.pushCurrentPosition();
                        _this.pdfHistory.push({
                            namedDest: namedDest,
                            explicitDest: explicitDest,
                            pageNumber: pageNumber,
                        });
                    }
                    _this.pdfViewer.scrollPageIntoView({
                        pageNumber: pageNumber,
                        destArray: explicitDest,
                    });
                };
                new Promise(function (resolve, _) {
                    if (typeof dest === 'string') {
                        _this.pdfDocument.getDestination(dest).then(function (destArray) {
                            resolve({
                                namedDest: dest,
                                explicitDest: destArray,
                            });
                        });
                        return;
                    }
                    resolve({
                        namedDest: '',
                        explicitDest: dest,
                    });
                }).then(function (data) {
                    if (!Array.isArray(data.explicitDest)) {
                        console.error(
                            'PDFLinkService.navigateTo: "' +
                                data.explicitDest +
                                '" is' +
                                (' not a valid destination array, for dest="' + dest + '".')
                        );
                        return;
                    }
                    goToDestination(data);
                });
            },
        },

        {
            key: 'getDestinationHash',
            value: function getDestinationHash(dest) {
                if (typeof dest === 'string') {
                    return this.getAnchorUrl('#' + escape(dest));
                }
                if (Array.isArray(dest)) {
                    var str = JSON.stringify(dest);
                    return this.getAnchorUrl('#' + escape(str));
                }
                return this.getAnchorUrl('');
            },
        },
        {
            key: 'getAnchorUrl',
            value: function getAnchorUrl(anchor) {
                return (this.baseUrl || '') + anchor;
            },
        },
        {
            key: 'setHash',
            value: function setHash(hash) {
                var pageNumber = void 0;
                var dest = void 0;
                if (hash.includes('=')) {
                    var params = (0, _ui_utils.parseQueryString)(hash);
                    if ('search' in params) {
                        this.eventBus.dispatch('findfromurlhash', {
                            source: this,
                            query: params['search'].replace(/"/g, ''),
                            phraseSearch: params['phrase'] === 'true',
                        });
                    }
                    if ('nameddest' in params) {
                        this.navigateTo(params.nameddest);
                        return;
                    }
                    if ('page' in params) {
                        pageNumber = params.page | 0 || 1;
                    }
                    if ('zoom' in params) {
                        var zoomArgs = params.zoom.split(',');
                        var zoomArg = zoomArgs[0];
                        var zoomArgNumber = parseFloat(zoomArg);
                        if (!zoomArg.includes('Fit')) {
                            dest = [
                                null,
                                { name: 'XYZ' },
                                zoomArgs.length > 1 ? zoomArgs[1] | 0 : null,
                                zoomArgs.length > 2 ? zoomArgs[2] | 0 : null,
                                zoomArgNumber ? zoomArgNumber / 100 : zoomArg,
                            ];
                        } else {
                            if (zoomArg === 'Fit' || zoomArg === 'FitB') {
                                dest = [null, { name: zoomArg }];
                            } else if (
                                zoomArg === 'FitH' ||
                                zoomArg === 'FitBH' ||
                                zoomArg === 'FitV' ||
                                zoomArg === 'FitBV'
                            ) {
                                dest = [null, { name: zoomArg }, zoomArgs.length > 1 ? zoomArgs[1] | 0 : null];
                            } else if (zoomArg === 'FitR') {
                                if (zoomArgs.length !== 5) {
                                    console.error('PDFLinkService.setHash: Not enough parameters for "FitR".');
                                } else {
                                    dest = [
                                        null,
                                        { name: zoomArg },
                                        zoomArgs[1] | 0,
                                        zoomArgs[2] | 0,
                                        zoomArgs[3] | 0,
                                        zoomArgs[4] | 0,
                                    ];
                                }
                            } else {
                                console.error(
                                    'PDFLinkService.setHash: "' + zoomArg + '" is not ' + 'a valid zoom value.'
                                );
                            }
                        }
                    }
                    if (dest) {
                        this.pdfViewer.scrollPageIntoView({
                            pageNumber: pageNumber || this.page,
                            destArray: dest,
                            allowNegativeOffset: true,
                        });
                    } else if (pageNumber) {
                        this.page = pageNumber;
                    }
                    if ('pagemode' in params) {
                        this.eventBus.dispatch('pagemode', {
                            source: this,
                            mode: params.pagemode,
                        });
                    }
                } else {
                    dest = unescape(hash);
                    try {
                        dest = JSON.parse(dest);
                        if (!Array.isArray(dest)) {
                            dest = dest.toString();
                        }
                    } catch (ex) {}
                    if (typeof dest === 'string' || isValidExplicitDestination(dest)) {
                        this.navigateTo(dest);
                        return;
                    }
                    console.error('PDFLinkService.setHash: "' + unescape(hash) + '" is not ' + 'a valid destination.');
                }
            },
        },
        {
            key: 'executeNamedAction',
            value: function executeNamedAction(action) {
                switch (action) {
                    case 'GoBack':
                        if (this.pdfHistory) {
                            this.pdfHistory.back();
                        }
                        break;
                    case 'GoForward':
                        if (this.pdfHistory) {
                            this.pdfHistory.forward();
                        }
                        break;
                    case 'NextPage':
                        if (this.page < this.pagesCount) {
                            this.page++;
                        }
                        break;
                    case 'PrevPage':
                        if (this.page > 1) {
                            this.page--;
                        }
                        break;
                    case 'LastPage':
                        this.page = this.pagesCount;
                        break;
                    case 'FirstPage':
                        this.page = 1;
                        break;
                    default:
                        break;
                }
                this.eventBus.dispatch('namedaction', {
                    source: this,
                    action: action,
                });
            },
        },
        {
            key: 'cachePageRef',
            value: function cachePageRef(pageNum, pageRef) {
                if (!pageRef) {
                    return;
                }
                var refStr = pageRef.num + ' ' + pageRef.gen + ' R';
                this._pagesRefCache[refStr] = pageNum;
            },
        },
        {
            key: '_cachedPageNumber',
            value: function _cachedPageNumber(pageRef) {
                var refStr = pageRef.num + ' ' + pageRef.gen + ' R';
                return (this._pagesRefCache && this._pagesRefCache[refStr]) || null;
            },
        },
        {
            key: 'pagesCount',
            get: function get() {
                return this.pdfDocument ? this.pdfDocument.numPages : 0;
            },
        },
        {
            key: 'page',
            get: function get() {
                return this.pdfViewer.currentPageNumber;
            },
            set: function set(value) {
                this.pdfViewer.currentPageNumber = value;
            },
        },
        {
            key: 'rotation',
            get: function get() {
                return this.pdfViewer.pagesRotation;
            },
            set: function set(value) {
                this.pdfViewer.pagesRotation = value;
            },
        },
    ]);

    return PDFLinkService;
})();

function isValidExplicitDestination(dest) {
    if (!Array.isArray(dest)) {
        return false;
    }
    var destLength = dest.length;
    var allowNull = true;
    if (destLength < 2) {
        return false;
    }
    var page = dest[0];
    if (
        !(
            (typeof page === 'undefined' ? 'undefined' : _typeof(page)) === 'object' &&
            Number.isInteger(page.num) &&
            Number.isInteger(page.gen)
        ) &&
        !(Number.isInteger(page) && page >= 0)
    ) {
        return false;
    }
    var zoom = dest[1];
    if (!((typeof zoom === 'undefined' ? 'undefined' : _typeof(zoom)) === 'object' && typeof zoom.name === 'string')) {
        return false;
    }
    switch (zoom.name) {
        case 'XYZ':
            if (destLength !== 5) {
                return false;
            }
            break;
        case 'Fit':
        case 'FitB':
            return destLength === 2;
        case 'FitH':
        case 'FitBH':
        case 'FitV':
        case 'FitBV':
            if (destLength !== 3) {
                return false;
            }
            break;
        case 'FitR':
            if (destLength !== 6) {
                return false;
            }
            allowNull = false;
            break;
        default:
            return false;
    }
    for (var i = 2; i < destLength; i++) {
        var param = dest[i];
        if (!(typeof param === 'number' || (allowNull && param === null))) {
            return false;
        }
    }
    return true;
}
