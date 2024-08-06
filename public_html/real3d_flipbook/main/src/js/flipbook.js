/*!
 * Real3D FlipBook [https://real3dflipbook.com]
 * @author creativeinteractivemedia [https://codecanyon.net/user/creativeinteractivemedia/portfolio]
 * @version 3.42
 * @date 2023-10-23
 */

var FLIPBOOK = FLIPBOOK || {};

{
    // eslint-disable-next-line no-shadow-restricted-names
    (function init($, window, document, undefined) {
        $.fn.flipBook = function (options) {
            return new FLIPBOOK.Main(options, this);
        };

        $.fn.swipeBook = function (options) {
            options.viewMode = 'swipe';
            return new FLIPBOOK.Main(options, this);
        };

        $.fn.flipBook.options = {
            name: '',
            pages: [],
            tableOfContent: [],
            tableOfContentCloseOnClick: true,
            thumbsCloseOnClick: true,
            deeplinkingEnabled: false,
            deeplinkingPrefix: '',
            assets: {
                preloader: '../assets/images/preloader.jpg',
                flipMp3: '../assets/mp3/turnPage.mp3',
                spinner: '../assets/images/spinner.gif',
                backgroundMp3: '../assets/mp3/background.mp3',
            },
            pdfUrl: null,
            pdfBrowserViewerIfMobile: false,
            pdfBrowserViewerIfIE: false,
            pdfBrowserViewerFullscreen: true,
            pdfBrowserViewerFullscreenTarget: '_blank',
            rangeChunkSize: 64,
            disableRange: false,
            disableStream: true,
            disableAutoFetch: true,
            pdfAutoLinks: false,
            htmlLayer: true,
            rightToLeft: false,
            startPage: 0,
            sound: true,
            backgroundColor: 'rgb(81, 85, 88)',
            backgroundImage: '',
            backgroundPattern: '',
            backgroundTransparent: false,
            thumbSize: 130,
            loadAllPages: false,
            loadPagesF: 2,
            loadPagesB: 1,
            autoplayOnStart: false,
            autoplayInterval: 3000,
            autoplayLoop: true,
            skin: 'light',
            layout: '3',
            menuOverBook: false,
            menuFloating: false,
            menuBackground: '',
            menuShadow: '',
            menuMargin: 0,
            menuPadding: 0,
            menuTransparent: false,
            menu2OverBook: true,
            menu2Floating: false,
            menu2Background: '',
            menu2Shadow: '',
            menu2Margin: 0,
            menu2Padding: 0,
            menu2Transparent: true,
            skinColor: '',
            skinBackground: '',
            btnColor: '',
            btnBackground: 'none',
            btnSize: 14,
            btnRadius: 2,
            btnMargin: 2,
            btnPaddingV: 10,
            btnPaddingH: 10,
            btnShadow: '',
            btnTextShadow: '',
            btnBorder: '',
            btnColorHover: '',
            btnBackgroundHover: '',
            sideBtnColor: '#FFF',
            sideBtnBackground: '#00000033',
            sideBtnSize: 30,
            sideBtnRadius: 0,
            sideBtnMargin: 0,
            sideBtnPaddingV: 5,
            sideBtnPaddingH: 0,
            sideBtnShadow: '',
            sideBtnTextShadow: '',
            sideBtnBorder: '',
            sideBtnColorHover: '#FFF',
            sideBtnBackgroundHover: '#00000066',
            floatingBtnColor: '#EEE',
            floatingBtnColorHover: '',
            floatingBtnBackground: '#00000044',
            floatingBtnBackgroundHover: '',
            floatingBtnSize: null,
            floatingBtnRadius: null,
            floatingBtnMargin: null,
            floatingBtnPadding: null,
            floatingBtnShadow: '',
            floatingBtnTextShadow: '',
            floatingBtnBorder: '',
            btnOrder: [
                'currentPage',
                'search',
                'btnFirst',
                'btnPrev',
                'btnNext',
                
                'btnLast',
                'btnZoomIn',
                'btnZoomOut',
                'btnRotateLeft',
                'btnRotateRight',
                'btnAutoplay',
                'btnSearch',
                'btnSelect',
                'btnBookmark',
                'btnNotes',
                'btnToc',
                'btnThumbs',
                'btnShare',
                'btnPrint',
                'btnDownloadPages',
                'btnDownloadPdf',
                'btnSound',
                'btnExpand',
                
                'btnClose',
            ],
            currentPage: {
                enabled: true,
                title: 'Current page',
                vAlign: 'top',
                hAlign: 'left',
                marginH: 0,
                marginV: 0,
                color: '',
                background: '',
            },
            search: {
                enabled: false,
            },
            btnFirst: {
                enabled: false,
                title: 'First page',
                iconFA: 'flipbook-icon-angle-double-left',
                iconM: 'flipbook-icon-first_page',
            },
            btnPrev: {
                enabled: true,
                title: 'Previous page',
                iconFA: 'flipbook-icon-angle-left',
                iconM: 'flipbook-icon-keyboard_arrow_left',
            },
            btnNext: {
                enabled: true,
                title: 'Next page',
                iconFA: 'flipbook-icon-angle-right',
                iconM: 'flipbook-icon-keyboard_arrow_right',
            },
            btnLast: {
                enabled: false,
                title: 'Last page',
                iconFA: 'flipbook-icon-angle-double-right',
                iconM: 'flipbook-icon-last_page',
            },
            btnZoomIn: {
                enabled: true,
                title: 'Zoom in',
                iconFA: 'flipbook-icon-plus',
                iconM: 'flipbook-icon-add',
            },
            btnZoomOut: {
                enabled: true,
                title: 'Zoom out',
                iconFA: 'flipbook-icon-minus',
                iconM: 'flipbook-icon-remove1',
            },
            btnRotateLeft: {
                enabled: false,
                title: 'Rotate left',
                iconFA: 'flipbook-icon--undo',
            },
            btnRotateRight: {
                enabled: false,
                title: 'Rotate right',
                iconFA: 'flipbook-icon--redo',
            },
            btnAutoplay: {
                enabled: true,
                title: 'Autoplay',
                iconFA: 'flipbook-icon-play',
                iconM: 'flipbook-icon-play_arrow',
                iconFA_alt: 'flipbook-icon-pause',
                iconM_alt: 'flipbook-icon-pause1',
            },
            btnSearch: {
                enabled: false,
                title: 'Search',
                iconFA: 'flipbook-icon-search',
                iconM: 'flipbook-icon-search1',
            },
            btnSelect: {
                enabled: true,
                title: 'Select tool',
                iconFA: 'flipbook-icon-i-cursor',
                iconM: 'flipbook-icon-text_format',
            },
            btnBookmark: {
                enabled: true,
                title: 'Bookmark',
                iconFA: 'flipbook-icon-bookmark',
                iconM: 'flipbook-icon-bookmark1',
            },
            btnNotes: {
                enabled: false,
                title: 'Notes',
                iconFA: 'flipbook-icon-comment',
                iconM: 'flipbook-icon-chat_bubble',
            },
            btnToc: {
                enabled: true,
                title: 'Table of Contents',
                iconFA: 'flipbook-icon-list-ol',
                iconM: 'flipbook-icon-toc',
            },
            btnThumbs: {
                enabled: true,
                title: 'Pages',
                iconFA: 'flipbook-icon-th-large',
                iconM: 'flipbook-icon-view_module',
            },
            btnShare: {
                enabled: true,
                title: 'Share',
                iconFA: 'flipbook-icon-share-alt',
                iconM: 'flipbook-icon-share1',
                hideOnMobile: true,
            },
            btnPrint: {
                enabled: true,
                title: 'Print',
                iconFA: 'flipbook-icon-print',
                iconM: 'flipbook-icon-local_printshop',
                hideOnMobile: true,
            },
            btnDownloadPages: {
                enabled: true,
                title: 'Download pages',
                iconFA: 'flipbook-icon-download',
                iconM: 'flipbook-icon-file_download',
                url: 'images/pages.zip',
                name: 'allPages.zip',
            },
            btnDownloadPdf: {
                forceDownload: false,
                enabled: true,
                title: 'Download PDF',
                iconFA: 'flipbook-icon-file',
                iconM: 'flipbook-icon-picture_as_pdf',
                url: null,
                openInNewWindow: true,
                name: 'allPages.pdf',
            },
            btnSound: {
                enabled: true,
                title: 'Volume',
                iconFA: 'flipbook-icon-volume-up',
                iconFA_alt: 'flipbook-icon-volume-off',
                iconM: 'flipbook-icon-volume_up',
                iconM_alt: 'flipbook-icon-volume_mute',
                hideOnMobile: true,
            },
            btnExpand: {
                enabled: true,
                title: 'Toggle fullscreen',
                iconFA: 'flipbook-icon-expand',
                iconM: 'flipbook-icon-fullscreen',
                iconFA_alt: 'flipbook-icon-compress',
                iconM_alt: 'flipbook-icon-fullscreen_exit',
            },
            btnClose: {
                title: 'Close',
                iconFA: 'flipbook-icon-times',
                iconM: 'flipbook-icon-clear',
                hAlign: 'right',
                vAlign: 'top',
                size: 20,
            },
            btnShareIfMobile: false,
            btnSoundIfMobile: false,
            btnPrintIfMobile: false,
            sideNavigationButtons: true,
            hideMenu: false,
            shareUrl: null,
            shareTitle: null,
            shareImage: null,
            whatsapp: {
                enabled: true,
                icon: 'flipbook-icon-whatsapp',
            },
            twitter: {
                enabled: true,
                icon: 'flipbook-icon-twitter',
            },
            facebook: {
                enabled: true,
                icon: 'flipbook-icon-facebook',
            },
            pinterest: {
                enabled: true,
                icon: 'flipbook-icon-pinterest-p',
            },
            email: {
                enabled: true,
                icon: 'flipbook-icon-envelope',
            },
            linkedin: {
                enabled: true,
                icon: 'flipbook-icon-linkedin',
            },
            digg: {
                enabled: false,
                icon: 'flipbook-icon-digg',
            },
            reddit: {
                enabled: false,
                icon: 'flipbook-icon-reddit-alien',
            },
            pdf: {
                annotationLayer: false,
            },
            pageTextureSize: 2048,
            pageTextureSizeSmall: 1500,
            thumbTextureSize: 300,
            pageTextureSizeMobile: 1500,
            pageTextureSizeMobileSmall: 1024,
            viewMode: 'webgl',
            singlePageMode: false,
            singlePageModeIfMobile: false,
            zoomMin: 0.95,
            zoomMin2: 0.15,
            zoomMax2: null,
            zoomSize: null,
            zoomStep: 2,
            zoomTime: 300,
            zoomReset: false,
            zoomResetTime: 300,
            wheelDisabledNotFullscreen: false,
            arrowsDisabledNotFullscreen: false,
            arrowsAlwaysEnabledForNavigation: true,
            touchSwipeEnabled: true,
            responsiveView: true,
            responsiveViewRatio: 1,
            responsiveViewTreshold: 768,
            minPixelRatio: 1,
            pageFlipDuration: 1,
            contentOnStart: false,
            thumbnailsOnStart: false,
            searchOnStart: false,
            sideMenuOverBook: true,
            sideMenuOverMenu: false,
            sideMenuOverMenu2: true,
            sideMenuPosition: 'left',
            lightBox: false,
            lightBoxOpened: false,
            lightBoxFullscreen: false,
            lightboxCloseOnClick: false,
            lightboxResetOnOpen: true,
            lightboxBackground: null,
            lightboxBackgroundColor: null,
            lightboxBackgroundPattern: null,
            lightboxBackgroundImage: null,
            lightboxStartPage: null,
            lightboxMarginV: '0',
            lightboxMarginH: '0',
            lightboxCSS: '',
            lightboxPreload: false,
            lightboxShowMenu: false,
            lightboxCloseOnBack: true,
            disableImageResize: true,
            pan: 0,
            panMax: 10,
            panMax2: 2,
            panMin: -10,
            panMin2: -2,
            tilt: 0,
            tiltMax: 0,
            tiltMax2: 0,
            tiltMin: 0,
            tiltMin2: -5,
            rotateCameraOnMouseMove: false,
            rotateCameraOnMouseDrag: true,
            lights: true,
            lightColor: 0xffffff,
            lightPositionX: 0,
            lightPositionZ: 1400,
            lightPositionY: 350,
            lightIntensity: 0.6,
            shadows: true,
            shadowMapSize: 1024,
            shadowOpacity: 0.2,
            shadowDistance: 0,
            pageRoughness: 1,
            pageMetalness: 0,
            pageHardness: 2,
            coverHardness: 2,
            pageSegmentsW: 10,
            pageSegmentsH: 1,
            pageMiddleShadowSize: 2,
            pageMiddleShadowColorL: '#999999',
            pageMiddleShadowColorR: '#777777',
            antialias: false,
            preloaderText: '',
            fillPreloader: {
                enabled: false,
                imgEmpty: 'images/logo_light.png',
                imgFull: 'images/logo_dark.png',
            },
            logoImg: '',
            logoUrl: '',
            logoCSS: 'position:absolute;',
            logoHideOnMobile: false,
            printMenu: true,
            downloadMenu: true,
            cover: true,
            backCover: true,
            pdfTextLayer: true,
            annotationLayer: true,
            googleAnalyticsTrackingCode: null,
            minimumAndroidVersion: 6,
            linkColor: 'rgba(0, 0, 0, 0)',
            linkColorHover: 'rgba(255, 255, 0, 1)',
            linkOpacity: 0.4,
            linkTarget: '_blank',
            rightClickEnabled: true,
            pageNumberOffset: 0,
            flipSound: true,
            backgroundMusic: false,
            doubleClickZoomDisabled: false,
            pageDragDisabled: false,
            pageClickAreaWdith: '10%',
            noteTypes: [
                { id: 1, title: 'User', color: 'green', enabled: true },
                { id: 2, title: 'Group', color: 'yellow', enabled: true },
                { id: 3, title: 'Admin', color: 'blue', enabled: true },
            ],
            pageRangeStart: null,
            pageRangeEnd: null,
            strings: {
                print: 'Print',
                printLeftPage: 'Print left page',
                printRightPage: 'Print right page',
                printCurrentPage: 'Print current page',
                printAllPages: 'Print all pages',
                download: 'Download',
                downloadLeftPage: 'Download left page',
                downloadRightPage: 'Download right page',
                downloadCurrentPage: 'Download current page',
                downloadAllPages: 'Download all pages',
                bookmarks: 'Bookmarks',
                bookmarkLeftPage: 'Bookmark left page',
                bookmarkRightPage: 'Bookmark right page',
                bookmarkCurrentPage: 'Bookmark current page',
                search: 'Search',
                findInDocument: 'Find in document',
                pagesFoundContaining: 'pages found containing',
                noMatches: 'No matches',
                matchesFound: 'matches found',
                page: 'Page',
                matches: 'matches',
                thumbnails: 'Thumbnails',
                tableOfContent: 'Table of Contents',
                share: 'Share',
                notes: 'Notes',
                pressEscToClose: 'Press ESC to close',
                password: 'Password',
                addNote: 'Add note',
                typeInYourNote: 'Type in your note...',
            },
            mobile: {
                shadows: false,
                pageSegmentsW: 5,
            },
        };

        FLIPBOOK.Main = function (options, elem) {
            var self = this;
            this.elem = elem;
            this.$elem = jQuery(elem);
            this.$body = jQuery('body');
            this.body = this.$body[0];
            this.$window = jQuery(window);

            this.bodyHasVerticalScrollbar = function () {
                return self.body.scrollHeight > window.innerHeight;
            };
            this.isZoomed = function () {
                return self.zoom > 1;
            };
            this.options = {};

            var dummyStyle = document.createElement('div').style;
            var vendor = (function () {
                var vendors = 't,webkitT,MozT,msT,OT'.split(',');
                var t;
                var i = 0;
                var l = vendors.length;

                for (; i < l; i++) {
                    t = vendors[i] + 'ransform';
                    if (t in dummyStyle) {
                        return vendors[i].substr(0, vendors[i].length - 1);
                    }
                }
                return false;
            })();
            var prefixStyle = function (style) {
                if (vendor === '') {
                    return style;
                }

                style = style.charAt(0).toUpperCase() + style.substr(1);
                return vendor + style;
            };
            var isAndroid = /android/gi.test(navigator.appVersion);
            var has3d = prefixStyle('perspective') in dummyStyle;

            this.isAndroid = isAndroid;
            this.has3d = has3d;

            function webgl_detect() {
                const canvas = document.createElement('canvas');
                const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
                return gl instanceof WebGLRenderingContext;
            }

            if (typeof FLIPBOOK.hasWebGl == 'undefined') {
                FLIPBOOK.hasWebGl = webgl_detect();
            }

            this.hasWebGl = FLIPBOOK.hasWebGl;

            this.thumbsShowing = false;
            this.bookmarkShowing = false;
            this.searchingString = false;
            this.tocShowing = false;
            this.menuShowing = true;
            this.fullscreenActive = false;

            var layouts = {
                2: {
                    currentPage: { vAlign: 'bottom', hAlign: 'center' },
                    btnAutoplay: { hAlign: 'left' },
                    btnSound: { hAlign: 'left' },
                    btnExpand: { hAlign: 'right' },
                    btnZoomIn: { hAlign: 'right' },
                    btnZoomOut: { hAlign: 'right' },
                    btnSearch: { hAlign: 'left' },
                    btnBookmark: { hAlign: 'left' },
                    btnToc: { hAlign: 'left' },
                    btnThumbs: { hAlign: 'left' },
                    btnShare: { hAlign: 'right' },
                    btnPrint: { hAlign: 'right' },
                    btnDownloadPages: { hAlign: 'right' },
                    btnDownloadPdf: { hAlign: 'right' },
                    btnSelect: { hAlign: 'right' },
                },
                3: {
                    menuTransparent: true,
                    menu2Transparent: false,
                    menu2OverBook: false,
                    menu2Padding: 5,
                    btnMargin: 5,
                    currentPage: { vAlign: 'top', hAlign: 'center' },
                    btnPrint: { vAlign: 'top', hAlign: 'right' },
                    btnDownloadPdf: { vAlign: 'top', hAlign: 'right' },
                    btnDownloadPages: { vAlign: 'top', hAlign: 'right' },
                    btnThumbs: { vAlign: 'top', hAlign: 'left' },
                    btnToc: { vAlign: 'top', hAlign: 'left' },
                    btnBookmark: { vAlign: 'top', hAlign: 'left' },
                    btnSearch: { vAlign: 'top', hAlign: 'left' },
                    btnSelect: { vAlign: 'top', hAlign: 'right' },
                    btnShare: { vAlign: 'top', hAlign: 'right' },
                    btnAutoplay: { hAlign: 'right' },
                    btnExpand: { hAlign: 'right' },
                    btnZoomIn: { hAlign: 'right' },
                    btnZoomOut: { hAlign: 'right' },
                    btnSound: { hAlign: 'right' },
                    menuPadding: 5,
                },
                4: {
                    menu2Transparent: false,
                    menu2OverBook: false,
                    sideMenuOverMenu2: false,
                    currentPage: { vAlign: 'top', hAlign: 'center' },
                    btnAutoplay: { vAlign: 'top', hAlign: 'left' },
                    btnSound: { vAlign: 'top', hAlign: 'left' },
                    btnExpand: { vAlign: 'top', hAlign: 'right' },
                    btnZoomIn: { vAlign: 'top', hAlign: 'right' },
                    btnZoomOut: { vAlign: 'top', hAlign: 'right' },
                    btnSearch: { vAlign: 'top', hAlign: 'left' },
                    btnBookmark: { vAlign: 'top', hAlign: 'left' },
                    btnToc: { vAlign: 'top', hAlign: 'left' },
                    btnThumbs: { vAlign: 'top', hAlign: 'left' },
                    btnShare: { vAlign: 'top', hAlign: 'right' },
                    btnPrint: { vAlign: 'top', hAlign: 'right' },
                    btnDownloadPages: { vAlign: 'top', hAlign: 'right' },
                    btnDownloadPdf: { vAlign: 'top', hAlign: 'right' },
                    btnSelect: { vAlign: 'top', hAlign: 'right' },
                },
            };

            var skins = {
                dark: {
                    skinColor: '#EEE',
                    btnColorHover: '#FFF',
                    skinBackground: '#313538',
                },
                light: {
                    skinColor: '#222',
                    btnColorHover: '#000',
                    skinBackground: '#FFF',
                    floatingBtnColor: '#FFF',
                    floatingBtnBackground: '#00000055',
                },
                gradient: {
                    skinColor: '#EEE',
                    btnColor: '#EEE',
                    btnColorHover: '#FFF',
                    skinBackground: '#313538DD',
                    zoomMin: 0.85,
                    menuOverBook: true,
                    menu2OverBook: true,
                    sideMenuOverMenu: true,
                    sideMenuOverMenu2: true,
                    menuBackground: 'linear-gradient(to top, rgba(0, 0, 0, 0.65) 0%, transparent 100%)',
                    menu2Background: 'linear-gradient(to bottom, rgba(0, 0, 0, 0.65) 0%, transparent 100%)',
                },
            };

            for (var key in skins) {
                if (options.skin == key) {
                    options = jQuery.extend(true, {}, skins[key], options);
                }
            }

            // eslint-disable-next-line no-redeclare
            for (var key in layouts) {
                if (String(options.layout) === key) {
                    options = jQuery.extend(true, {}, layouts[key], options);
                }
            }

            this.options = jQuery.extend(true, {}, jQuery.fn.flipBook.options, options);

            var o = this.options;

            o.isMobile =
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
                (navigator.maxTouchPoints && navigator.maxTouchPoints > 2 && /MacIntel/.test(navigator.platform));

            if (o.isMobile) {
                // eslint-disable-next-line no-redeclare
                for (var key in o.mobile) {
                    o[key] = o.mobile[key];
                }
            }

            this.strings = o.strings;

            o.pageShininess = o.pageShininess / 2;

            this.s = 0;

            if (o.googleAnalyticsTrackingCode) {
                this.gaCode = o.googleAnalyticsTrackingCode;

                if (this.gaCode.includes('UA-')) {
                    if (!window.ga) {
                        (function (i, s, o, g, r, a, m) {
                            i['GoogleAnalyticsObject'] = r;
                            (i[r] =
                                i[r] ||
                                function () {
                                    (i[r].q = i[r].q || []).push(arguments);
                                }),
                                (i[r].l = 1 * new Date());
                            (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
                            a.async = 1;
                            a.src = g;
                            m.parentNode.insertBefore(a, m);
                        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
                    }

                    ga('create', this.gaCode, 'auto');
                } else if (this.gaCode.includes('G-') || this.gaCode.includes('AW-')) {
                    var script = document.createElement('script');
                    script.setAttribute('src', 'https://www.googletagmanager.com/gtag/js?id=' + this.gaCode);
                    const self = this;
                    script.async = 1;
                    script.onload = function () {
                        window.dataLayer = window.dataLayer || [];
                        function gtag() {
                            dataLayer.push(arguments);
                        }
                        gtag('js', new Date());
                        gtag('config', self.gaCode);
                    };
                    document.body.appendChild(script);
                }
            }

            if (o.isMobile) {
                o.singlePageMode = o.singlePageModeIfMobile ? true : o.singlePageMode;

                if (o.viewModeMobile) {
                    o.viewMode = o.viewModeMobile;
                }

                if (o.pageTextureSizeMobile) {
                    o.pageTextureSize = o.pageTextureSizeMobile;
                }

                if (o.pageTextureSizeMobileSmall) {
                    o.pageTextureSizeSmall = o.pageTextureSizeMobileSmall;
                }

                o.touchSwipeEnabled = true;
            }

            if (o.viewMode == '3dSinglePage') {
                o.singlePageMode = true;
            }
            if (o.viewMode == '2dSinglePage') {
                o.singlePageMode = true;
                o.viewMode = '2d';
            }

            if (o.singlePageMode) {
                if (o.viewMode != '2d' && o.viewMode != 'swipe') {
                    o.viewMode = '3d';
                }

                if (o.rightToLeft) {
                    o.viewMode = 'swipe';
                }

                o.cover = true;
            }

            if (o.singlePageMode && o.viewMode == '3d') {
                o.rightToLeft = false;
            }

            if (o.viewMode == 'simple') {
                o.viewMode = '3d';
                o.instantFlip = true;
            }

            if (!o.cover) {
                o.responsiveView = false;
            }

            o.sideMenuPosition = o.rightToLeft ? 'right' : 'left';

            function getAndroidVersion(ua) {
                ua = (ua || navigator.userAgent).toLowerCase();
                var match = ua.match(/android\s([0-9\.]*)/);
                return match ? match[1] : false;
            }

            if (o.viewMode == 'webgl') {
                if (!this.hasWebGl || (parseFloat(getAndroidVersion()) < o.minimumAndroidVersion && this.isAndroid)) {
                    o.viewMode = '3d';
                }
            }
            if (o.viewMode == '3d' && !self.has3d) {
                o.viewMode = '2d';
            }

            this.webgl = o.viewMode == 'webgl';

            if (o.menuFloating) {
                o.menuOverBook = true;
                o.sideMenuOverMenu = true;
            }

            if (o.menu2Floating) {
                o.menu2OverBook = true;
                o.sideMenuOverMenu2 = true;
            }

            if (o.menuTransparent) {
                o.menuOverBook = true;
                o.sideMenuOverMenu = true;
                o.menuBackground = 'none';
            }

            if (o.menu2Transparent) {
                o.menu2OverBook = true;
                o.sideMenuOverMenu2 = true;
                o.menu2Background = 'none';
            } else {
                o.sideMenuOverMenu2 = false;
            }

            if (o.menuOverBook) {
                o.sideMenuOverMenu = true;
            }

            if (o.menu2OverBook) {
                o.sideMenuOverMenu2 = true;
            }

            if (o.isMobile && o.pdfBrowserViewerIfMobile && o.pdfUrl) {
                if (o.lightBox && !o.lightBoxOpened) {
                    this.$elem
                        .on('touched click', function () {
                            openPdfBrowserViewer();
                        })
                        .css('cursor', 'pointer');
                } else {
                    openPdfBrowserViewer();
                }
                return;
            }

            if (o.isIE && o.pdfBrowserViewerIfIE && o.pdfUrl) {
                if (o.lightBox && !o.lightBoxOpened) {
                    this.$elem
                        .on('touched click', function () {
                            openPdfBrowserViewer();
                        })
                        .css('cursor', 'pointer');
                } else {
                    openPdfBrowserViewer();
                }
                return;
            }

            function openPdfBrowserViewer() {
                if (o.pdfBrowserViewerFullscreen) {
                    window.open(o.pdfUrl, o.pdfBrowserViewerFullscreenTarget);
                } else {
                    jQuery('<object type="application/pdf"/>')
                        .width('100%')
                        .height('100%')
                        .attr('data', o.pdfUrl)
                        .appendTo(self.$elem);
                }
            }

            o.pdfMode = Boolean(o.pdfUrl && o.pdfUrl != '') || o.pdfBase64;

            if (o.backgroundTransparent) {
                o.backgroundColor = 'none';
            }

            this.wrapper = jQuery(document.createElement('div')).addClass('flipbook-main-wrapper');

            if (o.backgroundColor != '') {
                this.wrapper.css('background', o.backgroundColor);
            }

            if (o.backgroundPattern != '') {
                this.wrapper.css('background', 'url(' + o.backgroundPattern + ') repeat');
            }

            if (o.backgroundImage != '') {
                this.wrapper.css('background', 'url(' + o.backgroundImage + ') no-repeat');
                this.wrapper.css('background-size', 'cover');
                this.wrapper.css('background-position', 'center center');
            }

            this.bookLayer = jQuery(document.createElement('div'))
                .addClass('flipbook-bookLayer')
                .appendTo(self.wrapper);

            if (!o.rightClickEnabled) {
                this.bookLayer.bind('contextmenu', function (_) {
                    return false;
                });
            }

            if (o.hideMenu) {
                this.bookLayer.css('bottom', '0');
                o.menuOverBook = true;
            }

            o.pagesOriginal = JSON.parse(JSON.stringify(o.pages));

            this.book = jQuery(document.createElement('div')).addClass('book').appendTo(self.bookLayer);

            if (o.preloader) {
                this.preloader = o.preloader;
            } else if (!jQuery('.flipbook-preloader').length && o.lightBox) {
                this.preloader = jQuery(
                    '<div class="flipbook-preloader cssload-container">' +
                        '<div class="cssload-speeding-wheel"></div>' +
                        '<div class="flipbook-loading-text">' +
                        o.preloaderText +
                        '</div><div class="flipbook-loading-bg"></div></div>'
                );
            } else if (!o.lightBox) {
                this.preloader = jQuery(
                    '<div class="flipbook-preloader-2 cssload-container">' +
                        '<div class="cssload-speeding-wheel"></div>' +
                        '<div class="flipbook-loading-text">' +
                        o.preloaderText +
                        '</div><div class="flipbook-loading-bg"></div></div>'
                );
            } else {
                this.preloader = jQuery('.flipbook-preloader');
            }

            this.setLoadingProgress(0);

            async function checkHash() {
                if (self.disposed) {
                    return;
                }

                var fullHash = window.location.hash;

                var targetPage = self.getPageFromHash();
                if (!o.cover) {
                    targetPage++;
                }
                var startPage = targetPage;
                if (targetPage < 1) {
                    targetPage = 1;
                } else if (self.numPages && targetPage > self.numPages) {
                    targetPage = self.numPages;
                }
                if (targetPage) {
                    targetPage =
                        o.rightToLeft && o.pages && o.pages.length ? o.pages.length - targetPage + 1 : targetPage;

                    if (!self.started) {
                        o.startPage = startPage;

                        if (o.lightBox) {
                            init();

                            if (o.lightBoxFullscreen) {
                                setTimeout(function () {
                                    self.toggleExpand();
                                }, 100);
                            }
                        }
                    } else if (self.Book) {
                        if (self.lightbox && !FLIPBOOK.lightboxOpened) {
                            self.lightbox.openLightbox();
                            await self.lightboxStart();
                        }
                        self.goToPage(targetPage, fullHash.indexOf('flip') == -1);
                    }
                }
            }

            async function preload() {
                var scripts = [];

                if (typeof IScroll == 'undefined') {
                    scripts.push(self.loadScript(FLIPBOOK.iscrollSrc));
                }

                if (typeof FLIPBOOK.PdfService == 'undefined') {
                    scripts.push(self.loadScript(FLIPBOOK.pdfServiceSrc));
                }

                if (typeof jQuery(window).swipe == 'undefined') {
                    scripts.push(self.loadScript(FLIPBOOK.jqueryTouchSwipeSrc));
                }

                if (typeof window.screenfull == 'undefined') {
                    scripts.push(self.loadScript(FLIPBOOK.screenfullSrc));
                }

                if (o.pdfMode) {
                    if (typeof pdfjsLib == 'undefined') {
                        scripts.push(self.loadScript(FLIPBOOK.pdfjsSrc));
                    }
                    if (typeof FLIPBOOK.PdfService == 'undefined') {
                        scripts.push(self.loadScript(FLIPBOOK.pdfServiceSrc));
                    }

                    if (o.btnSearch.enabled || o.btnNotes.enabled || o.search.enabled) {
                        scripts.push(self.loadScript(FLIPBOOK.markSrc));
                    }
                }
                if (o.viewMode == 'webgl') {
                    if (typeof THREE == 'undefined') {
                        await self.loadScript(FLIPBOOK.threejsSrc);
                    }
                }

                await Promise.all(scripts);
            }

            function init() {
                if (self.initStarted) {
                    return;
                }
                self.initStarted = true;
                if (o.fillPreloader.enabled) {
                    self.$fillPreloader = jQuery('<div>').addClass('flipbook-fillPreloader');
                    var empty = new Image();
                    empty.src = o.fillPreloader.imgEmpty;
                    empty.onload = function () {
                        var full = new Image();
                        full.src = o.fillPreloader.imgFull;
                        full.onload = function () {
                            jQuery(empty).appendTo(self.$fillPreloader);
                            self.$fillPreloaderImg = jQuery(full).appendTo(self.$fillPreloader);
                            self.$fillPreloader.appendTo(self.wrapper);
                            initBook();
                        };
                    };
                } else {
                    initBook();
                }
            }

            function initBook() {
                if (self.initialized) {
                    return;
                }

                self.id = Date.now();

                self.addPageItems();

                if (o.pdfMode) {
                    self.initPdf();
                } else {
                    self.initJpg();
                }

                self.setLoadingProgress(0.1);

                if (self.lightbox && self.options.lightboxShowMenu) {
                    self.createMenu();
                }

                self.initialized = true;
            }

            this.dispose = function () {
                this.disposed = true;
            };

            o.main = this;

            this._events = {};

            this.on = function (type, fn) {
                if (!this._events[type]) {
                    this._events[type] = [];
                }

                this._events[type].push(fn);
            };

            this.off = function (type, fn) {
                if (!this._events[type]) {
                    return;
                }

                var index = this._events[type].indexOf(fn);

                if (index > -1) {
                    this._events[type].splice(index, 1);
                }
            };

            this.trigger = function (type) {
                if (!this._events[type]) {
                    return;
                }

                var i = 0;
                var l = this._events[type].length;

                if (!l) {
                    return;
                }

                for (; i < l; i++) {
                    this._events[type][i].apply(this, [].slice.call(arguments, 1));
                }
            };

            this.on('textlayerrendered', function (_) {
                if (self.searchingString) {
                    self.mark(self.searchingString, true);
                }
            });

            this.on('pageLoaded', function (e) {
                o.pages[e.index] = o.pages[e.index] || {};
                o.pages[e.index].canvas = o.pages[e.index].canvas || {};
                o.pages[e.index].images = o.pages[e.index].images || {};
                o.pages[e.index].images[e.size] = e.images;

                if (self.searchingString) {
                    self.mark(self.searchingString, true);
                }
            });

            this.addPageNotes = function (page) {
                if (this.noteService) {
                    this.noteService.initPageNotes(page);
                }
            };

            this.on('pdfinit', function () {
                o.tableOfContent = self.pdfService.outline || o.tableOfContent;
                o.doublePage = self.pdfService.double;

                if (!o.doublePage) {
                    o.backCover = self.pdfService.numPages % 2 == 0;
                    if (!o.cover) {
                        o.backCover = !o.backCover;
                    }
                }

                self.viewportOriginal = self.pdfService.viewports[0];

                o.firstPage = {
                    width: self.pdfService.viewports[0].width,
                    height: self.pdfService.viewports[0].height,
                    ratio: self.pdfService.viewports[0].width / self.pdfService.viewports[0].height,
                };

                if (self.pdfService.numPages > 1) {
                    o.secondPage = {
                        width: self.pdfService.viewports[1].width,
                        height: self.pdfService.viewports[1].height,
                        ratio: self.pdfService.viewports[1].width / self.pdfService.viewports[1].height,
                    };
                }

                o.numPages = self.pdfService.numPages;

                if (o.numPages == 1) {
                    o.viewMode = 'swipe';
                    o.singlePageMode = true;
                    o.btnNext.enabled = false;
                    o.btnPrev.enabled = false;
                    o.btnFirst.enabled = false;
                    o.btnLast.enabled = false;
                    o.sideNavigationButtons = false;
                    o.btnAutoplay.enabled = false;
                    o.printMenu = false;
                    o.downloadMenu = false;
                    self.webgl = false;
                }

                var pages = [];
                var pageSize = o.pageTextureSize;

                for (var i = 0; i < o.numPages; i++) {
                    var p = {
                        canvas: {},
                    };

                    if (o.pages && o.pages[i]) {
                        jQuery.extend(p, o.pages[i]);
                    } else {
                        p.title = i + 1;
                    }
                    pages[i] = p;
                }

                o.pages = pages;
                o.pageWidth = parseInt((pageSize * self.viewportOriginal.width) / self.viewportOriginal.height);
                o.pageHeight = pageSize;
                o.pw = o.pageWidth;
                o.ph = o.pageHeight;
                o.zoomSize = o.zoomSize || o.pageTextureSize;

                self.start();
            });

            this.on('toolSelect', function () {
                self.bookLayer.removeClass('flipbook-move');
                if (self.btnSelect) {
                    self.btnSelect.addClass('flipbook-btn-active');
                }
                self.bookLayer.removeClass('flipbook-disable-text-selection');
            });

            this.on('toolMove', function () {
                self.bookLayer.addClass('flipbook-move');
                if (self.btnSelect) {
                    self.btnSelect.removeClass('flipbook-btn-active');
                }
                self.bookLayer.addClass('flipbook-disable-text-selection');
            });

            function getFlipbookSrc() {
                var scripts = document.getElementsByTagName('script');
                for (var i = 0; i < scripts.length; i++) {
                    var src = String(scripts[i].src);
                    if (src.match('flipbook\\.js') || src.match('flipbook\\.min\\.js')) {
                        return src;
                    } else if (src.match('flipbook\\.lite\\.js') || src.match('flipbook\\.lite\\.min\\.js')) {
                        return src.replace('.lite', '');
                    }
                }
                return '';
            }

            FLIPBOOK.flipbookSrc = FLIPBOOK.flipbookSrc || this.options.flipbookSrc || getFlipbookSrc();

            const isMinified = FLIPBOOK.flipbookSrc.includes('flipbook.min.js');
            const replaceStr = isMinified ? 'flipbook.min.js' : 'flipbook.js';
            const suffix = isMinified ? '.min' : '';

            FLIPBOOK.markSrc = `https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark${suffix}.js`;

            const sources = [
                { key: 'iscrollSrc', value: 'libs/iscroll' },
                { key: 'threejsSrc', value: 'libs/three' },
                { key: 'flipbookWebGlSrc', value: 'flipbook.webgl' },
                { key: 'flipbookBook3Src', value: 'flipbook.book3' },
                { key: 'flipBookSwipeSrc', value: 'flipbook.swipe' },
                { key: 'flipBookScrollSrc', value: 'flipbook.scroll' },
                { key: 'pdfjsSrc', value: 'libs/pdf' },
                { key: 'pdfServiceSrc', value: 'flipbook.pdfservice' },
                { key: 'pdfjsworkerSrc', value: 'libs/pdf.worker' },
                { key: 'jqueryTouchSwipeSrc', value: 'libs/jquery.touchSwipe' },
                { key: 'screenfullSrc', value: 'libs/screenfull' },
            ];

            sources.forEach((source) => {
                FLIPBOOK[source.key] = FLIPBOOK.flipbookSrc.replace(replaceStr, source.value + suffix + '.js');
            });

            if (!o.deeplinkingPrefix && o.deeplinking && o.deeplinking.prefix) {
                o.deeplinkingPrefix = o.deeplinking.prefix;
            }

            o.deeplinkingEnabled =
                o.deeplinkingPrefix || o.deeplinkingEnabled || (o.deeplinking && o.deeplinking.enabled);

            if (o.deeplinkingEnabled) {
                checkHash();
                window.addEventListener('hashchange', checkHash);
            }

            if (o.lightBox) {
                o.btnClose.enabled = true;

                this.lightbox = new FLIPBOOK.Lightbox(this, this.wrapper, o);
                this.lightboxStartedTimes = 0;
                this.wrapper.css('background', 'none');
                this.bookLayer.css('background', 'none');
                this.book.css('background', 'none');

                this.preloader.appendTo(this.$body).css('position', 'fixed');

                this.$elem
                    .css('cursor', 'pointer')

                    .bind('tap click', async function (e) {
                        e.preventDefault();

                        self.lightboxStartPage = jQuery(this).attr('data-page');

                        if (self.started) {
                            await self.lightboxStart();

                            if (o.lightBoxFullscreen) {
                                setTimeout(function () {
                                    self.toggleExpand();
                                }, 0);
                            }
                        } else {
                            init();

                            if (o.lightBoxFullscreen) {
                                setTimeout(function () {
                                    self.toggleExpand();
                                }, 100);
                            }
                        }
                    });

                if (o.lightBoxOpened) {
                    init();
                    jQuery(window).trigger('r3d-lightboxloadingstarted');
                } else if (o.lightboxPreload) {
                    preload();
                }

                this.fullscreenElement = document.documentElement;
            } else {
                o.btnClose.enabled = false;
                this.preloader.appendTo(this.wrapper);
                this.wrapper.appendTo(this.$elem);
                this.fullscreenElement = this.$elem[0];

                const observer = new IntersectionObserver((entries) => {
                    const isVisible = entries[0].isIntersecting;
                    if (isVisible) {
                        if (!self.Book) {
                            init();
                        } else {
                            self.Book.enable();
                        }
                    } else if (self.Book) {
                        self.Book.disable();
                    }
                });
                observer.observe(this.wrapper[0]);
            }
        };

        FLIPBOOK.Main.prototype = {
            start: async function () {
                if (this.options.dp) {
                    this.options.doublePage = true;
                }

                if (this.started) {
                    return;
                }

                this.pageW = this.options.pageWidth;
                this.bookW = 2 * this.options.pageWidth;
                if (this.options.singlePageMode) {
                    this.bookW /= 2;
                }
                this.pageH = this.options.pageHeight;
                this.bookH = this.options.pageHeight;

                if (this.options.numPages % 2 == 0) {
                    this.options.numSheets = (this.options.numPages + 2) / 2;
                } else {
                    this.options.numSheets = (this.options.numPages + 1) / 2;
                }

                this.started = true;

                if (this.options.lightBox) {
                    this.lightbox.openLightbox();
                    await this.lightboxStart();
                }

                const pageClickAreaWdith = this.options.pageClickAreaWdith;
                const numPages = this.options.pages.length;
                const doublePage = this.options.doublePage;
                const singlePageMode = this.options.singlePageMode;
                const webglMode = this.options.viewMode == 'webgl';

                if (pageClickAreaWdith && (webglMode || !doublePage)) {
                    this.options.pages.forEach(function (page, index) {
                        page.htmlContent = page.htmlContent || '';
                        if (singlePageMode) {
                            if (index > 0) {
                                addBtnPrev(page);
                            }
                            if (index < numPages - 1) {
                                addBtnNext(page);
                            }
                        } else {
                            if (index % 2 == 0) {
                                addBtnNext(page);
                            } else {
                                addBtnPrev(page, index);
                            }
                        }
                    });
                }

                function addBtnPrev(page) {
                    page.htmlContent +=
                        '<div style="position: absolute; width: ' +
                        pageClickAreaWdith +
                        '; height: 100%; ' +
                        'top: 0; ' +
                        'left: 0; ' +
                        'cursor: pointer;" class="internalLink" data-page="prev"></div>';
                }

                function addBtnNext(page) {
                    page.htmlContent +=
                        '<div style="position: absolute; width: ' +
                        pageClickAreaWdith +
                        '; height: 100%; ' +
                        'top: 0; ' +
                        'right: 0; ' +
                        'cursor: pointer;" class="internalLink" data-page="next"></div>';
                }

                await this.createBook();
                this.createTooltip();
                if (this.options.btnNotes.enabled) {
                    this.initNotes();
                }

                this.updateSkinColors();
            },

            updateSkinColors: function () {
                var o = this.options;

                if (o.skinColor) {
                    this.wrapper.find('.skin-color').css('color', o.skinColor);
                }
                if (o.skinBackground) {
                    this.wrapper.find('.skin-color-bg').css('background', o.skinBackground);
                }
            },

            lightboxStart: async function () {
                var self = this;
                if (!this.started) {
                    await this.start();
                }

                if (typeof this.Book == 'undefined') {
                    setTimeout(function () {
                        self.lightboxStart();
                    }, 100);
                    return;
                }

                this.Book.enable();

                if (this.backgroundMusic) {
                    this.backgroundMusic.pause();
                }

                if (this.lightboxStartPage) {
                    this.goToPage(this.lightboxStartPage, true);
                } else if (this.options.lightboxStartPage) {
                    this.goToPage(this.options.lightboxStartPage, true);
                }

                this.lightboxStartedTimes++;

                this.sendGAEvent({
                    event: `Flipbook : ${this.options.name}`,
                    action: 'Lightbox open',
                    label: 'Lightbox open',
                    value: this.lightboxStartedTimes,
                });

                this.updateCurrentPage();
                this.initColors();
                this.resize();
            },

            setHash: function (page) {
                if (page < 1) {
                    page = 1;
                }

                if ('#' + this.options.deeplinkingPrefix + page == window.location.hash) {
                    return;
                }

                if (this.options.deeplinkingEnabled && this.Book.enabled && this.hash != page) {
                    window.location.hash = '#' + this.options.deeplinkingPrefix + String(page);
                    this.hash = page;
                }
            },

            clearHash: function () {
                
                var scrollV;
                var scrollH;
                var loc = window.location;
                if ('pushState' in history) {
                    history.pushState('', document.title, loc.pathname + loc.search);
                } else {
                    scrollV = document.body.scrollTop;
                    scrollH = document.body.scrollLeft;

                    loc.hash = '';

                    document.body.scrollTop = scrollV;
                    document.body.scrollLeft = scrollH;
                }
                
            },

            getPageFromHash: function () {
                var page;
                
                var string = window.location.hash;
                var substring = '#' + this.options.deeplinkingPrefix;
                var hasPrefix = string.indexOf(substring) !== -1;
                if (hasPrefix) {
                    page = parseInt(window.location.hash.replace(/#/g, '').replace(this.options.deeplinkingPrefix, ''));
                }
                
                return page;
            },

            sendGAEvent: function (params) {
                
                if (this.gaCode) {
                    if (this.gaCode.includes('UA-')) {
                        ga('send', {
                            hitType: 'event',
                            eventCategory: params.event,
                            eventAction: params.action,
                            eventLabel: params.label,
                            eventValue: params.value,
                            nonInteraction: true,
                        });
                    } else {
                        window.dataLayer = window.dataLayer || [];
                        // eslint-disable-next-line no-inner-declarations
                        function gtag() {
                            dataLayer.push(arguments);
                        }
                        gtag('event', params.event, {
                            action: params.action,
                        });
                    }
                }
                
            },

            initColors: function () {
                
                this.wrapper
                    .find('.skin-color-bg')
                    .removeClass('flipbook-bg-light')
                    .removeClass('flipbook-bg-dark')
                    .addClass('flipbook-bg-' + this.options.skin);

                this.wrapper
                    .find('.skin-color')
                    .removeClass('flipbook-color-light')
                    .removeClass('flipbook-color-dark')
                    .addClass('flipbook-color-' + this.options.skin);

                this.updateSkinColors();
                
            },

            lightboxEnd: function () {
                if (typeof window.screenfull != 'undefined' && window.screenfull.isFullscreen) {
                    window.screenfull.exit();
                }

                if (window.location.hash) {
                    this.clearHash();
                }

                this.setLoadingProgress(1);

                if (this.Book) {
                    this.Book.disable();
                }

                this.wrapper[0].querySelectorAll('.flipbook-page-item').forEach(function (item) {
                    if (item.nodeName == 'VIDEO' || item.nodeName == 'AUDIO') {
                        item.pause();
                    }
                });

                if (this.backgroundMusic) {
                    this.backgroundMusic.pause();
                }
            },

            turnPageComplete: function () {
                this.animating = false;
                this.updateCurrentPage();

                var rightIndex = this.Book.rightIndex || 0;

                if (this.options.rightToLeft) {
                    rightIndex = this.options.pages.length - rightIndex;
                }

                this.trigger('turnpagecomplete', { rightIndex: rightIndex });

                if (this.options.zoomReset) {
                    this.Book.zoomTo(this.options.zoomMin);
                }
            },

            updateCurrentPage: function () {
                var rtl = this.options.rightToLeft;
                var total = this.options.numPages;
                var totalDisplay = total - this.options.pageNumberOffset;
                var rightIndex = this.Book.rightIndex || 0;
                var s;

                if (rightIndex % 2 == 1) {
                    rightIndex++;
                }

                if (rtl) {
                    rightIndex = this.options.pages.length - rightIndex;
                }

                if (this.options.singlePageMode || this.Book.singlePage || this.Book.view == 1) {
                    if (this.Book.getCurrentPageNumber) {
                        s = this.Book.getCurrentPageNumber();
                    } else {
                        if (rtl) {
                            rightIndex--;
                        }

                        s = rightIndex + 1;
                    }

                    if (!this.options.cover) {
                        s = Number(s) - 1;
                    }

                    this.setHash(s);
                    this.cPage = [s - 1];
                } else {
                    if (rightIndex > total || (rightIndex == total && total % 2 == 0)) {
                        s = total;
                        this.cPage = [total - 1];
                        if (!this.options.cover) {
                            s = String(rightIndex - 1) + '-' + String(rightIndex);
                            this.cPage = [rightIndex - 2, rightIndex - 1];
                        }
                    } else if (rightIndex < 1) {
                        s = 1;
                        this.cPage = [0];
                    } else {
                        s = String(rightIndex) + '-' + String(rightIndex + 1);
                        if (!this.options.cover) {
                            s = String(rightIndex - 1) + '-' + String(rightIndex);
                        }
                        this.cPage = [rightIndex - 1, rightIndex];
                    }

                    if (!this.options.cover) {
                        this.setHash(rightIndex - 1);
                    } else {
                        this.setHash(rightIndex);
                    }
                }

                if (rtl) {
                    this.enableNext(rightIndex > 0);
                    if (!this.options.cover) {
                        this.enableNext(rightIndex > 2);
                    }
                    this.enablePrev(this.Book.canFlipPrev() || rightIndex < total - 1);
                } else {
                    this.enablePrev(rightIndex > 0);
                    if (!this.options.cover) {
                        this.enablePrev(rightIndex > 2);
                    }
                    this.enableNext(this.Book.canFlipNext() || rightIndex < total - 1);
                }

                if (this.cPage.length == 2) {
                    this.wrapper.find('.c-l-p').show();
                    this.wrapper.find('.c-r-p').show();
                    this.wrapper.find('.c-p').hide();
                } else {
                    this.wrapper.find('.c-l-p').hide();
                    this.wrapper.find('.c-r-p').hide();
                    this.wrapper.find('.c-p').show();
                }

                if (typeof this.currentPage === 'undefined') {
                    return;
                }

                this.s && this.options.pdfPageScale > 0 && this.goToPage(0);

                if (s != this.currentPageValue) {
                    this.currentPageValue = String(s);

                    var first = Number(String(s).split('-')[0]);
                    var second = Number(String(s).split('-')[1]);

                    if (first && this.options.pages[Number(first - 1)] && this.options.pages[Number(first - 1)].name) {
                        first = this.options.pages[Number(first - 1)].name;
                    }

                    if (
                        second &&
                        this.options.pages[Number(second - 1)] &&
                        this.options.pages[Number(second - 1)].name
                    ) {
                        second = this.options.pages[Number(second - 1)].name;
                    }

                    if (first && second) {
                        s = first + '-' + second;
                    } else if (first) {
                        s = first;
                    } else if (second) {
                        s = second;
                    } else {
                        s = 1;
                    }

                    this.currentPage.text(s + ' / ' + String(totalDisplay));

                    this.currentPageInput.width(this.currentPageHolder.width());

                    this.resize();

                    jQuery(this).trigger({
                        type: 'pagechange',
                        page: this.currentPageValue,
                        name: this.options.name,
                    });

                    jQuery(window).trigger({
                        type: 'r3d-pagechange',
                        page: this.currentPageValue,
                        name: this.options.name,
                    });

                    this.sendGAEvent({
                        event: `Flipbook : ${this.options.name}`,
                        action: `page ${this.currentPageValue}`,
                    });

                    // if (this.searchingString)
                    //     this.mark(this.searchingString, true)
                }
            },

            initJpg: function () {
                var self = this;

                if (this.options.numPages == 1) {
                    this.options.viewMode = 'swipe';
                    this.options.singlePageMode = true;
                    this.webgl = false;
                }

                if (this.options.pageRangeStart || this.options.pageRangeEnd) {
                    const start = this.options.pageRangeStart || 1;
                    const end = this.options.pageRangeEnd || this.options.pages.length;
                    this.options.pages = this.options.pages.splice(start - 1, end - start + 1);
                }

                var firstPageIndex = 0;
                var secondPageIndex = 1;
                if (!this.options.cover) {
                    firstPageIndex = 1;
                    secondPageIndex = 2;
                }

                this.loadPage(firstPageIndex, this.options.pageTextureSize, function () {
                    self.setLoadingProgress(0.5);

                    var o = self.options;

                    if (o.pages.length == 1) {
                        var p1 = o.pages[0].img;

                        o.pw = p1.width;
                        o.ph = p1.height;
                        o.pageWidth = p1.width;
                        o.pageHeight = p1.height;
                        o.pageMode = 'singlePage';
                        o.doublePage = false;
                        o.zoomSize = o.zoomSize || p1.height;
                        self.setLoadingProgress(0.7);
                        o.btnNext.enabled = false;
                        o.btnPrev.enabled = false;
                        o.btnFirst.enabled = false;
                        o.btnLast.enabled = false;
                        o.sideNavigationButtons = false;
                        o.btnAutoplay.enabled = false;
                        self.start();
                    } else {
                        self.loadPage(secondPageIndex, o.pageTextureSize, function () {
                            var p1 = o.pages[0].img;
                            var p2 = o.pages[1].img;
                            var r1 = p1.width / p1.height;
                            var r2 = p2.width / p2.height;

                            o.pw = p1.width;
                            o.ph = p1.height;
                            o.pageWidth = p1.width;
                            o.pageHeight = p1.height;
                            o.doublePage = r2 / r1 > 1.5;

                            if (!o.doublePage) {
                                o.backCover = o.pages.length % 2 == 0;
                                if (!o.cover) {
                                    o.backCover = !o.backCover;
                                }
                            }

                            o.zoomSize = o.zoomSize || p1.height;
                            self.setLoadingProgress(0.7);
                            self.start();
                        });
                    }
                });
            },

            initPdf: async function () {
                var scripts = [];
                if (this.started) {
                    return;
                }

                var self = this;

                if (typeof pdfjsLib == 'undefined') {
                    scripts.push(self.loadScript(FLIPBOOK.pdfjsSrc));
                }

                this.setLoadingProgress(0.2);

                if (typeof FLIPBOOK.PdfService == 'undefined') {
                    scripts.push(self.loadScript(FLIPBOOK.pdfServiceSrc));
                }

                await Promise.all(scripts);

                this.setLoadingProgress(0.3);
                if (window.CanvasPixelArray) {
                    window.CanvasPixelArray.prototype.set = function (arr) {
                        var l = this.length;
                        var i = 0;

                        for (; i < l; i++) {
                            this[i] = arr[i];
                        }
                    };
                }

                pdfjsLib.GlobalWorkerOptions.workerSrc = this.options.pdfjsworkerSrc || FLIPBOOK.pdfjsworkerSrc;

                var params = {
                    cMapPacked: true,
                    cMapUrl: this.options.cMapUrl || 'cmaps/',
                    disableRange: this.options.disableRange,
                    disableAutoFetch: this.options.disableAutoFetch,
                    disableStream: this.options.disableStream,
                    rangeChunkSize: Number(self.options.rangeChunkSize) * 1024,
                };

                if (self.options.pdfUrl) {
                    if (self.options.matchProtocol !== false) {
                        if (location.protocol == 'https:') {
                            self.options.pdfUrl = self.options.pdfUrl.replace('http://', 'https://');
                        } else if (location.protocol == 'http:') {
                            self.options.pdfUrl = self.options.pdfUrl.replace('https://', 'http://');
                        }
                    }

                    params.url = self.options.pdfUrl;
                } else if (self.options.pdfBase64) {
                    params.data = atob(self.options.pdfBase64);
                }

                if (this.options.password) {
                    var pass = prompt('Please enter PDF password', '');
                    if (pass != null) {
                        params.password = pass;
                    } else {
                        if (this.lightbox) {
                            this.lightbox.closeLightbox(true);
                        }
                        this.setLoadingProgress(1);
                        this.pdfinitStarted = false;
                        return;
                    }
                }

                if (this.pdfinitStarted) {
                    return;
                }
                this.pdfinitStarted = true;

                var loadingTask = pdfjsLib.getDocument(params);

                loadingTask.promise.then(
                    function (pdf) {
                        self.pdfDocument = pdf;

                        self.pdfService = new FLIPBOOK.PdfService(pdf, self, self.options);

                        self.options.thumbLoaded = function (c) {
                            self.options.thumbs = self.options.thumbs || [];
                            self.options.thumbs[c.index] = c;
                        };

                        self.setLoadingProgress(0.5);

                        self.pdfService.init();
                    },
                    function error(e) {
                        if (e.name == 'PasswordException') {
                            self.pdfinitStarted = false;
                            self.options.password = true;
                            self.initPdf();
                        } else {
                            alert(e);
                        }
                    }
                );
            },

            initPageHTML: function (index) {
                const page = this.options.pages[index];
                if (page.htmlInitialized) {
                    return;
                }

                this.addPageLinks(page);
                this.addPageNotes(page);

                page.htmlInitialized = true;
            },

            addPageLinks: function (page) {
                var self = this;
                const htmlContent = page.htmlContent.jquery ? page.htmlContent[0] : page.htmlContent;
                var links = htmlContent.querySelectorAll('.internalLink');
                links.forEach(function (link) {
                    if (link.dataset.page) {
                        link.onclick = function () {
                            if (link.dataset.page == 'prev') {
                                self.prevPage();
                                return false;
                            }
                            if (link.dataset.page == 'next') {
                                self.nextPage();
                                return false;
                            }
                            let targetPage = Number(link.dataset.page);
                            if (self.options.doublePage) {
                                targetPage = 2 * targetPage - 1;
                            }
                            if (self.options.rightToLeft) {
                                targetPage = self.options.pages.length - targetPage + 1;
                            }
                            self.goToPage(targetPage);
                            return false;
                        };
                    }
                });
                var spotlightLinks = htmlContent.querySelectorAll('.spotlight');
                spotlightLinks.forEach(function (link) {
                    if (link.dataset.spotlightUrl) {
                        link.style.cursor = 'pointer';
                        link.onclick = function (e) {
                            e.preventDefault();
                            self.spotlight(
                                this.dataset.spotlightUrl,
                                this.dataset.spotlightTitle,
                                this.dataset.spotlightDescription
                            );
                        };
                    }
                });
            },

            addPageNames: function () {
                const offset = this.options.pageNumberOffset;
                if (!offset) {
                    return;
                }
                const roman = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII'];
                this.options.pages.forEach(function (page, index) {
                    if (typeof page.name == 'undefined') {
                        page.name = index - offset + 1;
                        if (page.name < 1) {
                            page.name = roman.shift();
                        }
                    }
                });
            },

            loadPageHTML: function (index, callback) {
                var self = this;
                var options = this.options;

                if (!this.options.cover) {
                    index--;
                }

                if (this.options.pdfMode) {
                    if (!this.options.pages[index]) {
                        callback.call(this, {});
                    } else {
                        
                        this.pdfService.loadTextLayer(index, function (_) {
                            
                            self.initPageHTML(index);
                            callback.call(self, options.pages[index].htmlContent, index);
                            
                        });
                        
                    }
                }
                
                else if (options.pages[index].json) {
                    this.loadPageJSON(index, function (json) {
                        var page = options.pages[index] || {};

                        if (!page.htmlContentInitialized) {
                            var h = document.createElement('div');
                            h.classList.add('flipbook-page-htmlContent');
                            h.classList.add('page' + String(index));
                            h.innerHTML = decodeURIComponent(json.data);

                            if (page.htmlContent) {
                                jQuery(h).append(jQuery(page.htmlContent));
                            }

                            page.htmlContent = h;

                            self.initPageHTML(index);

                            page.htmlContentInitialized = true;
                        }

                        callback.call(self, page.htmlContent, index);
                    });
                }
                
                else {
                    this.initPageHTML(index);

                    callback.call(this, options.pages[index].htmlContent, index);
                }
            },

            loadPageJSON: function (index, callback) {
                var options = this.options;
                var page = options.pages[index] || {};
                var self = this;

                if (self.options.matchProtocol !== false) {
                    if (location.protocol == 'https:') {
                        page.json = page.json.replace('http:', 'https:');
                    } else if (location.protocol == 'http:') {
                        page.json = page.json.replace('https:', 'http:');
                    }
                }

                if (!page.jsonLoading && !page.jsonLoaded) {
                    page.jsonLoading = true;

                    jQuery.getJSON(page.json, function (json) {
                        page.jsonLoaded = true;
                        page.jsonLoading = false;

                        callback.call(self, json);
                    });

                    return;
                }

                if (!page.jsonLoaded) {
                    setTimeout(function () {
                        self.loadPageJSON(index, callback);
                    }, 100);

                    return;
                }

                callback.call(self);
            },

            loadPage: function (index, size, callback) {
                if (!this.options.cover) {
                    index--;
                }

                var self = this;
                var pageSrc = this.options.pages && this.options.pages[index] && this.options.pages[index].src;
                var page = this.options.pages[index];

                if (!page) {
                    callback.call(this);
                    return;
                }

                if (this.options.pdfMode && !pageSrc) {
                    this.loadPageFromPdf(index, size, callback);
                } else {
                    if (size == this.options.thumbTextureSize && page.thumb) {
                        if (!page.thumbImg) {
                            page.thumbImg = document.createElement('img');
                            page.thumbImg.setAttribute('data-id', index);

                            page.thumbImg.onload = function () {
                                page.thumbLoaded = true;

                                self.pageLoaded(
                                    {
                                        index: index,
                                        size: size,
                                        image: page.thumbImg,
                                    },
                                    callback
                                );
                            };

                            if (this.options.viewMode == 'webgl') {
                                page.thumbImg.crossOrigin = 'Anonymous';
                            }

                            if (self.options.matchProtocol !== false) {
                                if (location.protocol == 'https:') {
                                    page.thumb = page.thumb.replace('http://', 'https://');
                                } else if (location.protocol == 'http:') {
                                    page.thumb = page.thumb.replace('https://', 'http://');
                                }
                            }
                            page.thumbImg.src = page.thumb;
                        } else if (page.thumbLoaded) {
                            self.pageLoaded({ index: index, size: size, image: page.thumb }, callback);
                        } else {
                            setTimeout(function () {
                                self.loadPage(index, size, callback);
                            }, 300);
                        }
                    } else {
                        if (!page.img) {
                            page.img = document.createElement('img');
                            page.img.setAttribute('data-id', index);

                            page.img.onload = function () {
                                page.imgLoaded = true;
                                self.pageLoaded(
                                    {
                                        index: index,
                                        size: size,
                                        image: page.img,
                                    },
                                    callback
                                );
                            };

                            // crossOrigin is used only for mode webgl
                            if (this.options.viewMode == 'webgl') {
                                page.img.crossOrigin = 'Anonymous';
                            }

                            if (self.options.matchProtocol !== false) {
                                if (location.protocol == 'https:') {
                                    page.src = page.src.replace('http://', 'https://');
                                } else if (location.protocol == 'http:') {
                                    page.src = page.src.replace('https://', 'http://');
                                }
                            }

                            page.img.src = page.src;
                        } else if (page.imgLoaded) {
                            self.pageLoaded({ index: index, size: size, image: page.img }, callback);
                        } else {
                            setTimeout(function () {
                                self.loadPage(index, size, callback);
                            }, 300);
                        }
                    }
                }
            },

            pageLoaded: function (page, callback) {
                callback.call(this, page, callback);

                if (this.options.loadAllPages && page.index < this.options.numPages - 1) {
                    this.loadPage(page.index + 1, page.size, function () {});
                }

                if (this.searchingString) {
                    this.mark(this.searchingString, true);
                }
            },

            loadPageFromPdf: function (pageIndex, size, callback) {
                size = size || this.options.pageTextureSize;
                this.pdfService.renderBookPage(pageIndex, size, callback);
            },

            getString: function (name) {
                return this.options.strings[name];
            },

            mark: function (str, redraw) {
                if (str != this.markedStr || redraw) {
                    this.markedStr = str;
                    this.options.pages.forEach(function (page) {
                        var $htmlContent = jQuery(page.htmlContent);
                        var $textLayer = $htmlContent.find('.flipbook-textLayer');
                        if (page.marked != str && $textLayer.length) {
                            page.marked = str;
                            $textLayer.unmark({
                                className: 'mark-search',
                                done: function () {
                                    $textLayer.mark(str, {
                                        acrossElements: true,
                                        separateWordSearch: false,
                                        className: 'mark-blue mark-search',
                                    });
                                },
                            });
                        }
                    });
                }
            },

            unmark: function () {
                this.searchingString = null;

                this.markedStr = null;

                this.options.pages.forEach(function (page) {
                    if (page.marked) {
                        page.marked = null;
                        var c = jQuery(page.htmlContent);
                        c.unmark({
                            className: 'mark-search',
                        });
                    }
                });
            },

            setTool: function (tool) {
                this.tool = tool;
                this.trigger(tool);
            },

            toggleTool: function () {
                var tool = this.tool == 'toolSelect' ? 'toolMove' : 'toolSelect';
                this.setTool(tool);
            },

            toggleSound: function () {
                var o = this.options;
                o.sound = !o.sound;
                if (this.backgroundMusic) {
                    o.sound ? this.backgroundMusic.play() : this.backgroundMusic.pause();
                }
                this.toggleIcon(this.btnSound, o.sound);
            },

            toggleIcon: function (btn, val) {
                var prev = val ? btn.iconAlt : btn.icon;
                var curr = val ? btn.icon : btn.iconAlt;

                btn.find('.' + prev)
                    .removeClass(prev)
                    .addClass(curr);
            },

            scrollPageIntoView: function (obj) {
                let targetPage = obj.pageNumber;

                if (this.options.doublePage) {
                    targetPage = 2 * targetPage - 1;
                }

                if (this.options.rightToLeft) {
                    targetPage = this.options.pages.length - targetPage + 1;
                }

                this.goToPage(targetPage);
            },

            loadScript: function (src) {
                return new Promise(function (resolve, reject) {
                    var script = document.createElement('script');
                    var prior = document.getElementsByTagName('script')[0];
                    script.async = true;
                    script.src = src;

                    script.onload = script.onreadystatechange = function (_, isAbort) {
                        if (isAbort || !script.readyState || /loaded|complete/.test(script.readyState)) {
                            script.onload = script.onreadystatechange = null;
                            script = undefined;

                            if (!isAbort) {
                                resolve();
                            }
                        }
                    };

                    script.onerror = function (error) {
                        reject(error, script);
                    };

                    prior.parentNode.insertBefore(script, prior);
                });
            },

            createBook: async function () {
                var self = this;
                var options = this.options;
                var scripts = [];

                if (typeof IScroll == 'undefined') {
                    scripts.push(this.loadScript(FLIPBOOK.iscrollSrc));
                }

                if (typeof jQuery(window).swipe == 'undefined') {
                    scripts.push(this.loadScript(FLIPBOOK.jqueryTouchSwipeSrc));
                }

                if (typeof window.screenfull == 'undefined') {
                    scripts.push(this.loadScript(FLIPBOOK.screenfullSrc));
                }

                if (this.options.searchOnStart) {
                    this.options.btnSearch.enabled = true;
                }

                if (this.options.btnSearch.enabled || this.options.btnNotes.enabled || this.options.search.enabled) {
                    scripts.push(this.loadScript(FLIPBOOK.markSrc));
                }

                this.setLoadingProgress(0.9);

                if (this.options.viewMode == 'webgl') {
                    if (typeof THREE == 'undefined') {
                        await this.loadScript(FLIPBOOK.threejsSrc);
                    }

                    if (typeof FLIPBOOK.BookWebGL == 'undefined') {
                        scripts.push(this.loadScript(FLIPBOOK.flipbookWebGlSrc));
                    }
                } else if (this.options.viewMode == 'swipe') {
                    if (typeof FLIPBOOK.BookSwipe == 'undefined') {
                        scripts.push(this.loadScript(FLIPBOOK.flipBookSwipeSrc));
                    }
                } else if (this.options.viewMode == 'scroll') {
                    if (typeof FLIPBOOK.BookScroll == 'undefined') {
                        scripts.push(this.loadScript(FLIPBOOK.flipBookScrollSrc));
                    }
                } else {
                    if (typeof FLIPBOOK.Book3 == 'undefined') {
                        scripts.push(this.loadScript(FLIPBOOK.flipbookBook3Src));
                    }
                }

                await Promise.all(scripts);

                this.setLoadingProgress(1);

                this.initEasing();

                if (this.options.doublePage && this.options.pages.length > 2) {
                    var p = this.options.pages[0];
                    var left;
                    var right;
                    p.title = 1;
                    var newArr = [p];

                    for (var i = 1; i <= this.options.pages.length - 2; i++) {
                        p = this.options.pages[i];
                        left = {
                            src: p.src,
                            thumb: p.thumb,
                            title: 2 * i,
                            htmlContent: p.htmlContent,
                            json: p.json,
                            side: 'left',
                        };
                        right = {
                            src: p.src,
                            thumb: p.thumb,
                            title: 2 * i + 1,
                            htmlContent: p.htmlContent,
                            json: p.json,
                            side: 'right',
                        };
                        newArr.push(left);
                        newArr.push(right);
                    }

                    p = this.options.pages[this.options.pages.length - 1];
                    p.title = this.options.pages.length;

                    if (this.options.backCover) {
                        newArr.push(p);
                    } else {
                        left = {
                            src: p.src,
                            thumb: p.thumb,
                            title: 2 * i,
                            htmlContent: p.htmlContent,
                            json: p.json,
                            side: 'left',
                        };
                        right = {
                            src: p.src,
                            thumb: p.thumb,
                            title: 2 * i + 1,
                            htmlContent: p.htmlContent,
                            json: p.json,
                            side: 'right',
                        };
                        newArr.push(left);
                        newArr.push(right);
                    }
                    this.options.pages = newArr;
                }

                this.addPageNames();

                this.options.numPages = this.options.pages.length;
                if (this.options.numPages % 2 != 0 && !this.options.singlePageMode) {
                    this.options.backCover = false;
                    if (!this.options.cover) {
                        this.options.backCover = !this.options.backCover;
                    }
                    this.options.pages.push({
                        src: this.options.assets.preloader,
                        thumb: this.options.assets.preloader,
                        empty: true,
                    });
                }

                if (this.options.pages.length > 0) {
                    this.options.pages.forEach((page) => {
                        if (typeof page.htmlContent != 'undefined') {
                            self.options.hasHtmlContent = true;
                            page.htmlContent = jQuery(
                                `<div class="flipbook-page-htmlContent">${page.htmlContent}</div>`
                            );
                        }
                    });
                }

                if (this.options.viewMode == 'webgl') {
                    var bookOptions = this.options;
                    bookOptions.scroll = this.scroll;
                    bookOptions.parent = this;
                    this.Book = new FLIPBOOK.BookWebGL(this.book[0], this, bookOptions);
                    this.webglMode = true;

                    this.initSwipe();
                    this.initSound();
                } else if (this.options.viewMode == 'swipe') {
                    this.Book = new FLIPBOOK.BookSwipe(this.book[0], this.bookLayer[0], this, options);

                    this.initSwipe();
                } else if (this.options.viewMode == 'scroll') {
                    this.options.singlePageMode = true;
                    this.Book = new FLIPBOOK.BookScroll(this.book[0], this.bookLayer[0], this, options);

                    this.initSwipe();
                } else {
                    if (this.options.viewMode != '2d') {
                        this.options.viewMode = '3d';
                    }

                    this.Book = new FLIPBOOK.Book3(this.book[0], this, options);

                    this.initSwipe();

                    this.webglMode = false;
                    this.initSound();
                }

                this.resize();

                this.Book.enable();
                this.book.hide().fadeIn('slow');

                this.tocCreated = false;

                this.createMenu();

                this.onZoom(this.options.zoomMin);

                if (this.options.pages.length == 1) {
                    this.rightToLeft = false;
                }

                FLIPBOOK.books = FLIPBOOK.books || {};
                FLIPBOOK.books[self.id] = self.Book;

                var $book = jQuery(self.Book);

                $book.bind('loadPagesFromPdf', function (e, arr, size, callback) {
                    self.loadPagesFromPdf(arr, size, callback);
                });

                $book.bind('turnPageComplete', function (_) {
                    self.turnPageComplete();
                });

                $book.bind('initEasing', function (_) {
                    self.initEasing();
                });

                $book.bind('playFlipSound', function (_) {
                    self.playFlipSound();
                });

                $book.bind('closeLightbox', function (_) {
                    self.closeLightbox();
                });

                $book.bind('updateCurrentPage', function (_) {
                    self.updateCurrentPage();
                });

                this.createLogo();
                this.onBookCreated();
            },

            initNotes: function () {
                this.noteService = new FLIPBOOK.Notes(this);
                const self = this;
                window.addEventListener('r3d-update-note-visibility', function (e) {
                    self.options.noteTypes.forEach(function (noteType) {
                        if (e.detail.id == noteType.id) {
                            noteType.enabled = e.detail.enabled;
                        }
                    });
                    self.noteService.updateNoteVisibility();
                });
            },

            createTooltip: function () {
                this.tooltip = new FLIPBOOK.Tooltip();
                this.wrapper[0].appendChild(this.tooltip.domElement);
            },

            showTooltip: function (params) {
                this.tooltip.show(params);
            },

            hideTooltip: function () {
                this.tooltip.hide();
            },

            addPageItems: function () {
                
                const pages = this.options.pages;
                let el;

                for (let key in pages) {
                    let page = pages[key];
                    page.htmlContent = page.htmlContent || '';

                    if (page.items) {
                        for (let item of page.items) {
                            const {
                                autoplay = true,
                                controls = false,
                                loop = true,
                                muted = true,
                                src,
                                url = src,
                                x = 0,
                                y = 0,
                                width = 100,
                                height = 100,
                                type,
                            } = item;

                            const autoplayAttribute = autoplay ? 'autoplay' : '';
                            const controlsAttribute = controls ? 'controls' : '';
                            const loopAttribute = loop ? 'loop' : '';
                            const mutedAttribute = muted ? 'muted' : '';

                            switch (type) {
                                case 'iframe':
                                case 'youtube':
                                    if (url.includes('<iframe')) {
                                        page.htmlContent += `
										<div class="flipbook-page-item" 
										style="top:${y}px;left:${x}px;width:${width}px;height:${height}px;">
											${url}
										</div>`;
                                    } else {
                                        const getYouTubeEmbedUrl = (url) => {
                                            if (url.includes('youtu.be/')) {
                                                return url.replace('youtu.be/', 'youtube.com/embed/');
                                            }
                                            if (url.includes('youtube.com/watch?v=')) {
                                                return url.split('&')[0].replace('/watch?v=', '/embed/');
                                            }
                                            return url;
                                        };

                                        item.url = getYouTubeEmbedUrl(url) + '?enablejsapi=1';

                                        if (autoplay) {
                                            item.url += '&autoplay=1&mute=1';
                                        }

                                        page.htmlContent += `
										<iframe class="flipbook-page-item flipbook-youtube" src="${item.url}" 
											style="top:${y}px;left:${x}px;width:${width}px;height:${height}px;" 
											frameborder="0" allow="accelerometer; autoplay; encrypted-media; 
											gyroscope; picture-in-picture" allowfullscreen></iframe>`;
                                    }
                                    break;

                                case 'link':
                                    el = document.createElement('a');
                                    el.className = 'flipbook-page-item flipbook-page-item-link';
                                    el.style.cssText = `
									width:${width}px;height:${height}px;position:absolute;top:${y}px;left:${x}px;`;

                                    if (item.content) {
                                        el.innerHTML = item.content;
                                    }

                                    if (url) {
                                        el.href = url;
                                        el.target = item.target || this.options.linkTarget;
                                    } else if (item.page) {
                                        el.href = '#';
                                        el.classList.add('internalLink');
                                        el.dataset.page = item.page;
                                    } else if (item.spotlightUrl) {
                                        el.href = '#';
                                        el.classList.add('spotlight');
                                        el.dataset.spotlightUrl = item.spotlightUrl;
                                        if (item.title) {
                                            el.dataset.spotlightTitle = item.title;
                                        }
                                        if (item.description) {
                                            el.dataset.spotlightDescription = item.description;
                                        }
                                    }

                                    page.htmlContent += el.outerHTML;
                                    break;

                                case 'image':
                                    page.htmlContent += `
									<img class="flipbook-page-item" src="${url}" 
										style="top:${y}px;left:${x}px;width:${width}px;height:${height}px;"
									>`;
                                    break;

                                case 'video':
                                    page.htmlContent += `
									<video class="flipbook-page-item" playsinline autoplay muted
									${loopAttribute} ${autoplayAttribute} ${controlsAttribute} ${mutedAttribute} 
									style="top:${y}px;left:${x}px;width:${width}px;height:${height}px;">
                    					<source type="video/mp4" src="${url}">
                        			</video>`;
                                    break;

                                case 'audio':
                                    page.htmlContent += `
									<audio ${loopAttribute} ${loopAttribute} ${controlsAttribute} 
									class="flipbook-page-item" 
									style="top:${y}px;left:${x}px;width:${width}px;height:${height}px;">
										<source src="${url}" type="audio/mpeg">
									</audio>`;
                                    break;
                            }
                        }
                    }
                }

                
            },

            spotlight: function (url, title, description) {
                
                let overlay = document.querySelector('.flipbook-spotlight-overlay');

                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.className = 'flipbook-spotlight-overlay';

                    const closeButton = document.createElement('button');
                    closeButton.className = 'flipbook-spotlight-close-button';
                    closeButton.innerHTML = `
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M6 6L18 18" stroke="white" stroke-width="2"
							 stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M6 18L18 6" stroke="white" stroke-width="2"
							 stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					`;
                    closeButton.onclick = () => (overlay.style.display = 'none');
                    overlay.appendChild(closeButton);
                    this.wrapper[0].appendChild(overlay);

                    overlay.addEventListener('click', (event) => {
                        if ([overlay, closeButton].includes(event.target)) {
                            overlay.style.display = 'none';
                        }
                    });
                } else {
                    const existingContent = overlay.querySelector('img, video, iframe');
                    existingContent && overlay.removeChild(existingContent);
                }

                const getYouTubeEmbedUrl = (url) =>
                    url.includes('youtu.be/')
                        ? url.replace('youtu.be/', 'youtube.com/embed/')
                        : url.includes('youtube.com/watch?v=')
                        ? url.split('&')[0].replace('/watch?v=', '/embed/')
                        : url;

                const createElement = (tag, attrs) => {
                    const el = document.createElement(tag);
                    for (let key in attrs) {
                        if (key === 'style') {
                            el.style.cssText = attrs[key];
                        } else {
                            el[key] = attrs[key];
                        }
                    }
                    return el;
                };

                let content;
                if (url.endsWith('.mp4')) {
                    content = createElement('video', {
                        src: url,
                        controls: true,
                        style: 'max-width: 80%; max-height: 80%;',
                        className: 'flipbook-spotlight-video',
                    });
                } else if (url.includes('youtube.com') || url.includes('youtu.be')) {
                    content = createElement('iframe', {
                        src: getYouTubeEmbedUrl(url) + '?enablejsapi=1&autoplay=1&mute=1',
                        style: `width: 80vw; height: 45vw; max-width: 960px; max-height: 540px;
						 min-width: 300px; min-height: 168.75px;`,
                        frameBorder: '0',
                        allow: 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
                        allowFullscreen: true,
                    });
                } else if (
                    url.endsWith('.jpg') ||
                    url.endsWith('.jpeg') ||
                    url.endsWith('.png') ||
                    url.endsWith('.gif') ||
                    url.endsWith('.bmp') ||
                    url.endsWith('.webp')
                ) {
                    content = createElement('img', { src: url, style: 'max-width: 80%; max-height: 80%;' });
                } else {
                    return;
                }

                overlay.appendChild(content);
                overlay.style.display = 'flex';

                if (title || description) {
                    let captionContainer = overlay.querySelector('.flipbook-spotlight-caption-container');
                    if (!captionContainer) {
                        captionContainer = createElement('div', { className: 'flipbook-spotlight-caption-container' });
                    }
                    overlay.appendChild(captionContainer);

                    captionContainer.innerHTML = '';
                    if (title) {
                        captionContainer.innerHTML += '<strong>' + title + '</strong><br />';
                    }
                    if (description) {
                        captionContainer.innerHTML += description;
                    }
                }
                
            },

            onBookCreated: function () {
                var o = this.options;

                var self = this;

                if (!o.cover && Number(o.startPage) < 2) {
                    o.startPage = 2;
                }

                if (o.rightToLeft) {
                    this.goToPage(Number(o.pages.length - Number(o.startPage) + 1), true);
                } else {
                    this.goToPage(Number(o.startPage), true);
                }

                var root = document.documentElement;
                root.style.setProperty('--flipbook-link-color', this.options.linkColor);
                root.style.setProperty('--flipbook-link-color-hover', this.options.linkColorHover);
                root.style.setProperty('--flipbook-link-opacity', this.options.linkOpacity);

                jQuery(window).resize(function () {
                    self.resize();
                });

                this.resize();

                this.Book.updateVisiblePages();
                this.Book.zoomTo(o.zoomMin);

                this.updateCurrentPage();

                this.playBgMusic();

                document.addEventListener('keydown', function (e) {
                    if (!self.Book.enabled) {
                        return;
                    }

                    if (!self.options.lightBox && document.body.classList.contains('flipbook-overflow-hidden')) {
                        return;
                    }

                    if (!self.isFullscreen && document.body.classList.contains('flipbook-fullscreen')) {
                        return;
                    }

                    if (
                        !(self.options.arrowsAlwaysEnabledForNavigation && (e.keyCode == 37 || e.keyCode == 39)) &&
                        (self.options.lightBox ||
                            self.fullscreenActive ||
                            (!self.options.arrowsDisabledNotFullscreen && !self.bodyHasVerticalScrollbar()))
                    ) {
                        return;
                    }

                    e = e || window.event;
                    switch (e.keyCode) {
                        case 37:
                            self.zoom > 1 ? self.moveBook('left') : self.prevPage();
                            break;
                        case 38:
                            self.zoom > 1 ? self.moveBook('up') : self.nextPage();
                            break;
                        case 39:
                            self.zoom > 1 ? self.moveBook('right') : self.nextPage();
                            break;
                        case 33:
                            self.prevPage();
                            break;
                        case 34:
                            self.nextPage();
                            break;
                        case 36:
                            self.firstPage();
                            break;
                        case 35:
                            self.lastPage();
                            break;
                        case 40:
                            self.zoom > 1 ? self.moveBook('down') : self.prevPage();
                            break;
                        case 107:
                        case 187:
                            self.zoomIn();
                            break;
                        case 109:
                        case 189:
                            self.zoomOut();
                            break;
                    }
                    return false;
                });

                document.addEventListener('MSFullscreenChange', function (_) {
                    self.handleFsChange();
                });

                document.addEventListener('mozfullscreenchange', function (_) {
                    self.handleFsChange();
                });

                document.addEventListener('webkitfullscreenchange', function (_) {
                    self.handleFsChange();
                });

                document.addEventListener('fullscreenchange', function (_) {
                    self.handleFsChange();
                });

                if (o.lightboxCloseOnBack) {
                    window.onpopstate = function () {
                        if (self.Book.enabled && FLIPBOOK.lightboxOpened) {
                            if (!window.location.hash) {
                                self.lightbox.closeLightbox(true);
                            }
                        }
                    };
                }

                this.bookLayer.bind('DOMMouseScroll', function (e) {
                    if (!self.Book.enabled) {
                        return;
                    }

                    if (!self.options.lightBox && !self.fullscreenActive) {
                        if (self.options.wheelDisabledNotFullscreen || self.bodyHasVerticalScrollbar()) {
                            return;
                        }
                    }

                    e.stopPropagation();
                    e.preventDefault();

                    if (e.originalEvent.detail > 0) {
                        self.zoomOut(e.originalEvent);
                    } else {
                        self.zoomIn(e.originalEvent);
                    }
                    return false;
                });

                this.bookLayer.bind('mousewheel', function (e) {
                    if (!self.Book.enabled) {
                        return;
                    }

                    if (!self.options.lightBox && !self.fullscreenActive) {
                        if (self.options.wheelDisabledNotFullscreen || self.bodyHasVerticalScrollbar()) {
                            return;
                        }
                    }

                    if (self.options.viewMode != 'scroll') {
                        e.stopPropagation();
                        e.preventDefault();

                        if (e.originalEvent.wheelDelta < 0) {
                            self.zoomOut(e.originalEvent);
                        } else {
                            self.zoomIn(e.originalEvent);
                        }
                        return false;
                    }
                });

                if (this.options.viewMode == 'scroll') {
                    this.setTool('toolSelect');
                    this.options.btnSelect.enabled = false;
                } else {
                    this.setTool('toolMove');
                }

                if (self.options.contentOnStart) {
                    self.toggleToc(true);
                } else if (self.options.thumbnailsOnStart) {
                    self.toggleThumbs(true);
                } else if (self.options.searchOnStart) {
                    self.toggleSearch(true);
                    if (typeof self.options.searchOnStart == 'string') {
                        self.thumbs.$findInput.val(self.options.searchOnStart).trigger('keyup');
                    }
                }

                if (o.autoplayOnStart) {
                    self.toggleAutoplay(true);
                }

                if (self.options.lightBox) {
                    self.Book.disable();
                }

                self.initColors();

                setTimeout(function () {
                    self.resize();
                    self.Book.updateVisiblePages();
                    self.Book.zoomTo(o.zoomMin);
                }, 500);

                if (o.onbookcreated) {
                    o.onbookcreated.call(this);
                }
            },

            initSound: function () {
                if (this.options.flipSound) {
                    this.flipSound = jQuery(
                        '<audio><source src="' + this.options.assets.flipMp3 + '" type="audio/mpeg"></audio>'
                    )[0];
                }
                if (this.options.backgroundMusic) {
                    this.backgroundMusic = jQuery(
                        '<audio autoplay><source src="' + this.options.backgroundMusic + '" type="audio/mpeg"></audio>'
                    )[0];
                }
            },

            initSwipe: function () {
                if (this.options.numPages == 1 || !this.options.touchSwipeEnabled) {
                    return;
                }

                var self = this;

                window.jQuery(this.bookLayer).swipe({
                    swipeStatus: function (e, phase, direction, distance, duration, fingerCount, _) {
                        if (phase == 'start') {
                            try {
                                self.currentPageInput.trigger('blur');
                            } catch (e) {}
                        }

                        if (
                            self.options.sideNavigationButtons &&
                            (e.target === self.arrowL[0] || e.target === self.arrowR[0])
                        ) {
                            return;
                        }

                        if ((phase == 'end' || phase == 'cancel') && duration < 200 && distance < 10) {
                            if (
                                self.tool == 'toolMove' ||
                                (self.options.viewMode == 'scroll' && !self.options.doubleClickZoomDisabled)
                            ) {
                                if (self.clickTimer == null) {
                                    self.clickTimer = setTimeout(function () {
                                        self.clickTimer = null;
                                    }, 300);
                                } else {
                                    clearTimeout(self.clickTimer);
                                    self.clickTimer = null;

                                    var t = self.options.zoomTime;
                                    if (self.zoom >= self.options.zoomMax) {
                                        self.zoomTo(self.options.zoomMin, t, e);
                                    } else {
                                        self.zoomTo(self.options.zoomMax, t, e);
                                    }
                                }
                            }
                        } else {
                            if (
                                ((direction == 'up' || direction == 'down') && phase == 'move') ||
                                self.zoom > 1 ||
                                self.tool == 'toolSelect' ||
                                self.options.pageDragDisabled
                            ) {
                                return;
                            }
                            self.Book.onSwipe(e, phase, direction, distance, duration, fingerCount);
                        }
                    },

                    pinchStatus: function (event, phase, direction, distance, duration, fingerCount, pinchZoom) {
                        if (phase == 'start') {
                            self.zoomStart = self.zoom;
                        }

                        if (fingerCount > 1 && phase == 'move') {
                            event.preventDefault();
                            if (event.scale) {
                                pinchZoom = event.scale;
                            }
                            self.zoomTo(self.zoomStart * pinchZoom, 0, event);
                        }
                    },

                    fingers: 2,
                    pinchThreshold: 0,
                    allowPageScroll: 'vertical',
                    preventDefaultEvents: false,
                });

                this.swipeEnabled = true;
            },

            toggleMenu: function () {
                if (this.menuShowing) {
                    this.menuShowing = false;
                    this.bookLayer.css('bottom', '0px');
                    this.menuBottom.fadeOut();
                    this.currentPageHolder.fadeOut();
                    jQuery('.flipbook-nav').fadeOut();
                    this.Book.onResize();
                } else {
                    this.menuShowing = true;
                    this.bookLayer.css('bottom', this.menuBottom.height() + 'px');
                    this.menuBottom.fadeIn();
                    this.currentPageHolder.fadeIn();
                    jQuery('.flipbook-nav').fadeIn();
                    this.Book.onResize();
                }
            },

            createIcon: function (btn, alt, transparent) {
                var o = this.options;
                var $icon;

                if (o.icons == 'material') {
                    $icon = jQuery(document.createElement('span'))
                        .attr('aria-hidden', 'true')
                        .addClass(alt ? btn.iconM_alt : btn.iconM)
                        .addClass('flipbook-icon flipbook-menu-btn skin-color');
                } else {
                    $icon = jQuery(document.createElement('span'))
                        .attr('aria-hidden', 'true')
                        .addClass(alt ? btn.iconFA_alt : btn.iconFA)
                        .addClass('flipbook-icon flipbook-menu-btn skin-color');
                }
                if (!transparent) {
                    $icon.addClass('skin-color-bg');
                }

                return $icon;
            },

            createButton: function (btn) {
                var o = this.options;
                var floating =
                    (btn.vAlign == 'top' && o.menu2Transparent) || (btn.vAlign != 'top' && o.menuTransparent);
                var bgColor = btn.background || (floating ? o.floatingBtnBackground : o.btnBackground);
                var bgColorHover =
                    btn.backgroundHover || (floating ? o.floatingBtnBackgroundHover : o.btnBackgroundHover);
                var color = btn.color || (floating ? o.floatingBtnColor : o.btnColor);
                var colorHover = btn.colorHover || (floating ? o.floatingBtnColorHover : o.btnColorHover);
                var textShadow = floating ? o.floatingBtnTextShadow : o.btnTextShadow;
                var radius = btn.radius || (floating ? o.floatingBtnRadius : o.btnRadius);
                var border = btn.border || (floating ? o.floatingBtnBorder : o.btnBorder);
                var margin = floating ? o.floatingBtnMargin : o.btnMargin;
                var paddingV = o.btnPaddingV + 2;
                var paddingH = o.btnPaddingH + 2;
                var $btn = jQuery(document.createElement('span'));
                var material = o.icons == 'material';
                var btnSize = material ? (btn.size || o.btnSize) + 8 : btn.size || o.btnSize;

                function addCSS($icon) {
                    $icon.css({
                        'font-size': btnSize + 'px',
                        'margin': margin + 'px',
                        'padding': paddingV + 'px ' + paddingH + 'px',
                        'border-radius': radius + 'px',
                        'box-shadow': o.btnShadow,
                        'border': border,
                        'color': color,
                        'background': bgColor,
                        'text-shadow': textShadow,
                    });

                    if (color) {
                        $icon.removeClass('skin-color');
                    }
                    if (bgColor) {
                        $icon.removeClass('skin-color-bg');
                    }
                }

                $btn.$icon = this.createIcon(btn).appendTo($btn);
                addCSS($btn.$icon);

                if (btn.iconAlt2) {
                    $btn.$iconAlt = this.createIcon(btn, true).appendTo($btn).hide();
                    addCSS($btn.$iconAlt);
                }

                $btn.icon = btn.iconFA;
                $btn.iconAlt = btn.iconFA_alt;
                if (material) {
                    $btn.icon = btn.iconM;
                    $btn.iconAlt = btn.iconM_alt;
                    btn.icon = btn.iconM;
                    btn.iconAlt = btn.iconM_alt;
                }

                if (btn.onclick) {
                    $btn.bind('tap click', function (_) {
                        btn.onclick();
                    });
                }

                if (colorHover || bgColorHover) {
                    $btn.mouseenter(function () {
                        Array.from(this.children).forEach(function (child) {
                            child.style.color = colorHover;
                            child.style.background = bgColorHover;
                        });
                    }).mouseleave(function () {
                        Array.from(this.children).forEach(function (child) {
                            child.style.color = color;
                            child.style.background = bgColor;
                        });
                    });
                }

                var menu;
                var cssClass = '';

                if (btn.vAlign == 'top') {
                    if (o.menu2Floating) {
                        menu = this.menuTC;
                    } else if (btn.hAlign == 'left') {
                        menu = this.menuTL;
                    } else if (btn.hAlign == 'right') {
                        menu = this.menuTR;
                    } else {
                        menu = this.menuTC;
                    }
                } else {
                    if (o.menuFloating) {
                        menu = this.menuBC;
                    } else if (btn.hAlign == 'left') {
                        menu = this.menuBL;
                    } else if (btn.hAlign == 'right') {
                        menu = this.menuBR;
                    } else {
                        menu = this.menuBC;
                    }
                }

                $btn.attr('data-name', btn.name)
                    .appendTo(menu)
                    .attr('title', btn.title)
                    .addClass(cssClass)
                    .css('order', btn.order);

                return $btn;
            },

            createMenu: function () {
                if (this.menuBottom) {
                    return;
                }

                var o = this.options;

                var menuBottomClass = o.menuFloating ? 'flipbook-menu-floating' : 'flipbook-menu-fixed';
                var menuTopClass = o.menu2Floating ? 'flipbook-menu-floating' : 'flipbook-menu-fixed';

                var self = this;
                this.menuBottom = jQuery(document.createElement('div'))
                    .addClass('flipbook-menuBottom')
                    .addClass(menuBottomClass)
                    .appendTo(this.wrapper)
                    .css({
                        'background': o.menuBackground,
                        'box-shadow': o.menuShadow,
                        'margin': o.menuMargin + 'px',
                        'padding': o.menuPadding + 'px',
                    });

                if (!o.menuTransparent && !o.menuBackground) {
                    this.menuBottom.addClass('skin-color-bg');
                }

                if (o.hideMenu) {
                    this.menuBottom.hide();
                }

                this.menuTop = jQuery(document.createElement('div'))
                    .addClass('flipbook-menuTop')
                    .addClass(menuTopClass)
                    .appendTo(this.wrapper)
                    .css({
                        'background': o.menu2Background,
                        'box-shadow': o.menu2Shadow,
                        'margin': o.menu2Margin + 'px',
                        'padding': o.menu2Padding + 'px',
                    });

                if (!o.menu2Transparent && !o.menu2Background) {
                    this.menuTop.addClass('skin-color-bg');
                }

                if (o.viewMode == 'swipe') {
                    o.btnSound.enabled = false;
                }

                this.menuBL = jQuery(document.createElement('div'))
                    .addClass('flipbook-menu flipbook-menu-left')
                    .appendTo(this.menuBottom);

                this.menuBC = jQuery(document.createElement('div'))
                    .addClass('flipbook-menu flipbook-menu-center')
                    .appendTo(this.menuBottom);

                this.menuBR = jQuery(document.createElement('div'))
                    .addClass('flipbook-menu flipbook-menu-right')
                    .appendTo(this.menuBottom);

                this.menuTL = jQuery(document.createElement('div'))
                    .addClass('flipbook-menu flipbook-menu-left')
                    .appendTo(this.menuTop);

                this.menuTC = jQuery(document.createElement('div'))
                    .addClass('flipbook-menu flipbook-menu-center')
                    .appendTo(this.menuTop);

                this.menuTR = jQuery(document.createElement('div'))
                    .addClass('flipbook-menu flipbook-menu-right')
                    .appendTo(this.menuTop);

                if (o.isMobile) {
                    if (typeof o.btnTocIfMobile != 'undefined') {
                        o.btnToc.hideOnMobile = !o.btnTocIfMobile;
                    }
                    if (typeof o.btnThumbsIfMobile != 'undefined') {
                        o.btnThumbs.hideOnMobile = !o.btnThumbsIfMobile;
                    }
                    if (typeof o.btnShareIfMobile != 'undefined') {
                        o.btnShare.hideOnMobile = !o.btnShareIfMobile;
                    }
                    if (typeof o.btnDownloadPagesIfMobile != 'undefined') {
                        o.btnDownloadPages.hideOnMobile = !o.btnDownloadPagesIfMobile;
                    }
                    if (typeof o.btnDownloadPdfIfMobile != 'undefined') {
                        o.btnDownloadPdf.hideOnMobile = !o.btnDownloadPdfIfMobile;
                    }
                    if (typeof o.btnSoundIfMobile != 'undefined') {
                        o.btnSound.hideOnMobile = !o.btnSoundIfMobile;
                    }
                    if (typeof o.btnExpandIfMobile != 'undefined') {
                        o.btnExpand.hideOnMobile = !o.btnExpandIfMobile;
                    }
                    if (typeof o.btnPrintIfMobile != 'undefined') {
                        o.btnPrint.hideOnMobile = !o.btnPrintIfMobile;
                    }
                }

                if (o.sideNavigationButtons) {
                    this.btnNext = jQuery('<div class="flipbook-nav"><div class="flipbook-arrow-wrapper"></div></div>')
                        .appendTo(this.bookLayer)
                        .bind('tap click', function (e) {
                            if (self.btnNext.disabled) {
                                return;
                            }
                            self.btnNext.disabled = true;
                            setTimeout(function () {
                                self.btnNext.disabled = false;
                            }, 300);

                            e.stopPropagation();
                            e.preventDefault();
                            self.nextPage();
                        });

                    this.arrowR = this.createIcon(o.btnNext)
                        .appendTo(this.btnNext.first())
                        .addClass('flipbook-right-arrow')
                        .css({
                            'width': o.sideBtnSize + 'px',
                            'height': o.sideBtnSize + 'px',
                            'font-size': o.sideBtnSize + 'px',
                            'border-radius': o.sideBtnRadius + 'px',
                            'margin-top': String(-o.sideBtnSize / 2) + 'px',
                            'margin-right': o.sideBtnMargin + 'px',
                            'padding': o.sideBtnPaddingV + 'px ' + o.sideBtnPaddingH + 'px',
                            'text-shadow': o.sideBtnTextShadow,
                            'box-shadow': o.sideBtnShadow,
                            'border': o.sideBtnBorder,
                            'color': o.sideBtnColor,
                            'background': o.sideBtnBackground,
                            'box-sizing': 'initial',
                        });

                    if (o.sideBtnColor) {
                        this.arrowR.removeClass('skin-color');
                    }
                    if (o.sideBtnBackground) {
                        this.arrowR.removeClass('skin-color-bg');
                    }

                    this.btnPrev = jQuery('<div class="flipbook-nav"><div class="flipbook-arrow-wrapper"></div></div>')
                        .appendTo(self.bookLayer)
                        .bind('tap click', function (e) {
                            if (self.btnPrev.disabled) {
                                return;
                            }
                            self.btnPrev.disabled = true;
                            setTimeout(function () {
                                self.btnPrev.disabled = false;
                            }, 300);

                            e.stopPropagation();
                            e.preventDefault();
                            self.prevPage();
                        });

                    this.arrowL = this.createIcon(o.btnPrev)
                        .appendTo(this.btnPrev.first())
                        .addClass('flipbook-left-arrow')
                        .css({
                            'width': o.sideBtnSize + 'px',
                            'height': o.sideBtnSize + 'px',
                            'font-size': o.sideBtnSize + 'px',
                            'border-radius': o.sideBtnRadius + 'px',
                            'margin-top': String(-o.sideBtnSize / 2) + 'px',
                            'margin-left': o.sideBtnMargin + 'px',
                            'padding': o.sideBtnPaddingV + 'px ' + o.sideBtnPaddingH + 'px',
                            'text-shadow': o.sideBtnTextShadow,
                            'box-shadow': o.sideBtnShadow,
                            'border': o.sideBtnBorder,
                            'color': o.sideBtnColor,
                            'background': o.sideBtnBackground,
                            'box-sizing': 'initial',
                        });

                    if (o.sideBtnColor) {
                        this.arrowL.removeClass('skin-color');
                    }
                    if (o.sideBtnBackground) {
                        this.arrowL.removeClass('skin-color-bg');
                    }

                    if (o.btnFirst.enabled) {
                        this.btnFirst = jQuery(
                            '<div class="flipbook-nav"><div class="flipbook-arrow-wrapper"></div></div>'
                        )
                            .appendTo(this.bookLayer)
                            .bind('tap click', function (e) {
                                if (self.btnFirst.disabled) {
                                    return;
                                }
                                self.btnFirst.disabled = true;
                                setTimeout(function () {
                                    self.btnFirst.disabled = false;
                                }, 300);

                                e.stopPropagation();
                                e.preventDefault();
                                self.firstPage();
                            });

                        this.arrowFirst = this.createIcon(o.btnFirst)
                            .appendTo(this.btnFirst.first())
                            .addClass('flipbook-first-arrow')
                            .css({
                                'width': o.sideBtnSize + 'px',
                                'height': o.sideBtnSize * 0.66 + 'px',
                                'font-size': o.sideBtnSize * 0.66 + 'px',
                                'border-radius': o.sideBtnRadius + 'px',
                                'margin-top':
                                    String(o.sideBtnSize / 2 + o.sideBtnMargin + 2 * o.sideBtnPaddingV) + 'px',
                                'margin-left': o.sideBtnMargin + 'px',
                                'padding': o.sideBtnPaddingV + 'px ' + o.sideBtnPaddingH + 'px',
                                'text-shadow': o.sideBtnTextShadow,
                                'box-shadow': o.sideBtnShadow,
                                'border': o.sideBtnBorder,
                                'color': o.sideBtnColor,
                                'background': o.sideBtnBackground,
                                'box-sizing': 'initial',
                            });
                        if (o.sideBtnColor) {
                            this.arrowFirst.removeClass('skin-color');
                        }
                        if (o.sideBtnBackground) {
                            this.arrowFirst.removeClass('skin-color-bg');
                        }
                    }

                    if (o.btnLast.enabled) {
                        this.btnLast = jQuery(
                            '<div class="flipbook-nav"><div class="flipbook-arrow-wrapper"></div></div>'
                        )
                            .appendTo(self.bookLayer)
                            .bind('tap click', function (e) {
                                if (self.btnLast.disabled) {
                                    return;
                                }
                                self.btnLast.disabled = true;
                                setTimeout(function () {
                                    self.btnLast.disabled = false;
                                }, 300);

                                e.stopPropagation();
                                e.preventDefault();
                                self.lastPage();
                            });

                        this.arrowLast = this.createIcon(o.btnLast)
                            .appendTo(this.btnLast.first())
                            .addClass('flipbook-last-arrow')
                            .css({
                                'width': o.sideBtnSize + 'px',
                                'height': o.sideBtnSize * 0.66 + 'px',
                                'font-size': o.sideBtnSize * 0.66 + 'px',
                                'border-radius': o.sideBtnRadius + 'px',
                                'margin-top':
                                    String(o.sideBtnSize / 2 + o.sideBtnMargin + 2 * o.sideBtnPaddingV) + 'px',
                                'margin-right': o.sideBtnMargin + 'px',
                                'padding': o.sideBtnPaddingV + 'px ' + o.sideBtnPaddingH + 'px',
                                'text-shadow': o.sideBtnTextShadow,
                                'box-shadow': o.sideBtnShadow,
                                'border': o.sideBtnBorder,
                                'color': o.sideBtnColor,
                                'background': o.sideBtnBackground,
                                'box-sizing': 'initial',
                            });

                        if (o.sideBtnColor) {
                            this.arrowLast.removeClass('skin-color');
                        }
                        if (o.sideBtnBackground) {
                            this.arrowLast.removeClass('skin-color-bg');
                        }
                    }

                    if (!o.menuNavigationButtons) {
                        if (o.btnOrder.indexOf('btnFirst') >= 0) {
                            o.btnOrder.splice(o.btnOrder.indexOf('btnFirst'), 1);
                        }
                        if (o.btnOrder.indexOf('btnPrev') >= 0) {
                            o.btnOrder.splice(o.btnOrder.indexOf('btnPrev'), 1);
                        }
                        if (o.btnOrder.indexOf('btnNext') >= 0) {
                            o.btnOrder.splice(o.btnOrder.indexOf('btnNext'), 1);
                        }
                        if (o.btnOrder.indexOf('btnLast') >= 0) {
                            o.btnOrder.splice(o.btnOrder.indexOf('btnLast'), 1);
                        }
                    }
                }

                if (o.pdfMode && !o.btnDownloadPdf.url) {
                    o.btnDownloadPdf.url = o.pdfUrl;
                }

                if (!o.pdfTextLayer && o.btnSelect) {
                    o.btnSelect.enabled = false;
                }
                if (!o.pdfTextLayer && o.btnSearch) {
                    o.btnSearch.enabled = false;
                }

                if (o.viewMode == 'scroll') {
                    o.btnSelect.enabled = false;
                }

                for (var i = 0; i < o.btnOrder.length; i++) {
                    var btnName = o.btnOrder[i];
                    var btn = o[btnName];

                    if (o.isMobile && btn.hideOnMobile) {
                        btn.enabled = false;
                    }

                    if (btn.enabled) {
                        btn.name = btnName;
                        if (btn.name == 'currentPage') {
                            this.createCurrentPage();
                        } else if (btn.name == 'search') {
                            
                            this.$search = jQuery(
                                '<div class="flipbook-findbar">' +
                                    '<div>' +
                                    '<input class="toolbarField" title="Find" autocapitalize="none" placeholder="' +
                                    o.strings.findInDocument +
                                    '...">' +
                                    '</div>' +
                                    '<div class="flipbook-find-info skin-color"/>' +
                                    '</div>'
                            ).appendTo(this.menuTL);

                            this.$search.find('input').on('change', function () {
                                self.toggleSearch(true);
                                self.thumbs.$findInput.val(this.value).trigger('keyup');
                                this.value = '';
                            });

                            this.menuTL[0].style.flexDirection = 'column';
                            this.menuTL[0].style.alignItems = 'flex-start';
                            
                        } else if (btnName == 'btnClose') {
                            this.btnClose = this.createButton(btn).bind('touchend click', function (e) {
                                e.stopPropagation();
                                e.preventDefault();
                                self.onButtonClick(this, e);
                            });
                        } else {
                            
                            this[btnName] = this.createButton(btn).bind('touchend click', function (e) {
                                e.stopPropagation();
                                e.preventDefault();
                                self.onButtonClick(this, e);
                            });
                            
                        }
                    }
                }

                if (o.buttons) {
                    o.buttons.forEach((newButton) => {
                        self.createButton(newButton).index(1);
                    });
                }
            },

            onButtonClick: function (btn, _) {
                var name = jQuery(btn).attr('data-name');
                var o = this.options;

                switch (name) {
                    case 'btnFirst':
                        this.firstPage();
                        break;
                    case 'btnPrev':
                        this.prevPage();
                        break;
                    case 'btnNext':
                        this.nextPage();
                        break;
                    case 'btnLast':
                        this.lastPage();
                        break;
                    case 'btnZoomIn':
                        this.zoomIn();
                        break;
                    case 'btnZoomOut':
                        this.zoomOut();
                        break;
                    case 'btnAutoplay':
                        if (!this.autoplay) {
                            this.nextPage();
                        }
                        this.toggleAutoplay();
                        break;
                    case 'btnSearch':
                        this.toggleSearch();
                        break;
                    case 'btnBookmark':
                        this.toggleBookmark();
                        break;
                    case 'btnRotateLeft':
                        if (this.Book.rotateLeft) {
                            this.Book.rotateLeft();
                        }
                        break;
                    case 'btnRotateRight':
                        if (this.Book.rotateRight) {
                            this.Book.rotateRight();
                        }
                        break;
                    case 'btnToc':
                        this.toggleToc();
                        break;
                    case 'btnThumbs':
                        this.toggleThumbs();
                        break;
                    case 'btnShare':
                        this.toggleShareMenu();
                        break;
                    case 'btnNotes':
                        this.toggleNotesMenu();
                        break;
                    case 'btnDownloadPages':
                        if (o.downloadMenu) {
                            this.toggleDownloadMenu();
                        } else {
                            var link = document.createElement('a');
                            link.href = o.btnDownloadPages.url;
                            link.download = o.btnDownloadPages.name;
                            link.dispatchEvent(new MouseEvent('click'));
                        }

                        break;

                    case 'btnPrint':
                        if (o.printMenu) {
                            this.togglePrintMenu();
                        } else {
                            this.togglePrintWindow();
                        }

                        break;

                    case 'btnDownloadPdf':
                        if (o.btnDownloadPdf.forceDownload) {
                            var path = o.btnDownloadPdf.url;
                            var save = document.createElement('a');
                            save.href = path;
                            var filename = save.href.split('/').pop().split('#')[0].split('?')[0];
                            save.download = filename;
                            document.body.appendChild(save);
                            save.click();
                            document.body.removeChild(save);
                        } else {
                            var target =
                                o.btnDownloadPdf.openInNewWindow ||
                                typeof (o.btnDownloadPdf.openInNewWindow == 'undefined')
                                    ? '_blank'
                                    : '_self';
                            window.open(o.btnDownloadPdf.url, target);
                        }

                        this.sendGAEvent({
                            event: `Flipbook : ${this.options.name}`,
                            action: `PDF Download`,
                            label: o.btnDownloadPdf.url || o.pdfUrl,
                        });

                        break;

                    case 'btnSound':
                        this.toggleSound();
                        break;
                    case 'btnSelect':
                        this.toggleTool();
                        break;
                    case 'btnExpand':
                        this.toggleExpand();
                        break;
                    case 'btnClose':
                        this.lightbox.closeLightbox();
                        break;
                }
            },

            handleFsChange: function (browserFullscreen) {
                if (!this.Book || !this.Book.enabled) {
                    return;
                }

                var $el = jQuery(this.fullscreenElement);

                var currentFullscreenElement =
                    document.fullscreenElement ||
                    document.webkitFullscreenElement ||
                    document.mozFullScreenElement ||
                    document.msFullscreenElement;
                if (currentFullscreenElement === this.fullscreenElement || this.isFullscreen) {
                    if (browserFullscreen) {
                        $el.addClass('flipbook-browser-fullscreen');
                        this.fullscreenElement.parentNodeOld = this.fullscreenElement.parentNode;
                        if (!this.options.lightBox) {
                            $el.appendTo(jQuery('body'));
                        }
                    }

                    this.fullscreenActive = true;

                    if (this.options.onfullscreenenter) {
                        this.options.onfullscreenenter.call(this);
                    }
                    document.body.classList.add('flipbook-fullscreen');
                } else {
                    if (browserFullscreen) {
                        $el.removeClass('flipbook-browser-fullscreen');
                        if (!this.options.lightBox) {
                            $el.appendTo(jQuery(this.fullscreenElement.parentNodeOld));
                        }
                    }

                    this.fullscreenActive = false;

                    if (this.options.onfullscreenexit) {
                        this.options.onfullscreenexit.call(this);
                    }
                    document.body.classList.remove('flipbook-fullscreen');
                }

                this.triggerResizeOnce();
                this.toggleIcon(this.btnExpand, !this.fullscreenActive);
            },

            createLogo: function () {
                var o = this.options;
                if (!o.logoImg) {
                    return;
                }
                if (o.isMobile && o.logoHideOnMobile) {
                    return;
                }

                var $logo = jQuery('<img>').attr('src', o.logoImg).attr('style', o.logoCSS).appendTo(this.wrapper);

                if (o.logoAlignH == 'right') {
                    $logo.css('right', '0');
                }
                if (o.logoAlignV == 'bottom') {
                    $logo.css('bottom', '0');
                }

                if (o.logoUrl) {
                    $logo.css('cursor', 'pointer').bind('touchend click', function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        window.open(o.logoUrl, o.logoUrlTarget || '_blank');
                    });
                }
            },

            setLoadingProgress: function (percent) {
                if (this.disposed) {
                    return;
                }

                if (this.$fillPreloader) {
                    this.setFillPreloaderProgress(percent);
                } else {
                    if (percent > 0 && percent < 1) {
                        jQuery(this.preloader).stop(true, true).show();
                    } else {
                        jQuery(this.preloader).stop(true, true).hide();
                    }
                }
            },

            setFillPreloaderProgress: function (percent) {
                if (!this.$fillPreloader) {
                    return;
                }

                if (percent > 0 && percent < 1) {
                    this.fillPreloaderProgress = this.fillPreloaderProgress || 0;

                    if (percent < this.fillPreloaderProgress) {
                        return;
                    } else {
                        this.fillPreloaderProgress = percent;
                    }
                    var img = this.$fillPreloaderImg[0];
                    img.style.clip = 'rect(0px,' + img.width * percent + 'px,' + img.height + 'px,0px)';
                    this.$fillPreloader.show();
                } else {
                    this.$fillPreloader.hide();
                }
            },

            playFlipSound: function () {
                if (this.options.sound && this.Book.enabled && typeof this.flipSound.play != 'undefined') {
                    this.flipSound.currentTime = 0;

                    var self = this;

                    setTimeout(function () {
                        self.flipSound.play().then(
                            //success
                            function () {},
                            //fail
                            function () {}
                        );
                    }, 70);
                }
            },

            playBgMusic: function () {
                if (this.options.sound && this.backgroundMusic && this.backgroundMusic.play) {
                    var self = this;
                    this.backgroundMusic.play().then(
                        function () {},
                        function (_) {
                            setTimeout(function () {
                                self.playBgMusic();
                            }, 100);
                        }
                    );
                }
            },

            onMouseWheel: function (e) {
                if ('wheelDeltaX' in e) {
                    wheelDeltaX = e.wheelDeltaX / 12;
                    wheelDeltaY = e.wheelDeltaY / 12;
                } else if ('wheelDelta' in e) {
                    wheelDeltaX = wheelDeltaY = e.wheelDelta / 12;
                } else if ('detail' in e) {
                    wheelDeltaX = wheelDeltaY = -e.detail * 3;
                } else {
                    return;
                }
                if (wheelDeltaX > 0) {
                    this.zoomIn(e);
                } else {
                    this.zoomOut(e);
                }
            },

            zoomTo: function (val, time, e) {
                this.zoom = val;

                var x;
                var y;

                if (typeof e == 'undefined') {
                    x = this.wrapperW / 2;
                    y = this.wrapperH / 2;
                } else {
                    if (e.touches && e.touches[0]) {
                        x = e.touches[0].pageX;
                        y = e.touches[0].pageY;
                    } else if (e.changedTouches && e.changedTouches[0]) {
                        x = e.changedTouches[0].pageX;
                        y = e.changedTouches[0].pageY;
                    } else {
                        x = e.pageX;
                        y = e.pageY;
                    }
                    x = x - this.wrapper.offset().left;
                    y = y - this.wrapper.offset().top;
                }

                const zoomMin = this.getZoomMin();

                if (this.zoom < zoomMin) {
                    this.zoom = zoomMin;
                }
                if (this.zoom > this.options.zoomMax) {
                    this.zoom = this.options.zoomMax;
                }

                if (this.options.zoomMax2 && this.zoom > this.options.zoomMax2) {
                    this.zoom = this.options.zoomMax2;
                }

                this.Book.zoomTo(this.zoom, time, x, y);

                this.onZoom(this.zoom);
            },

            zoomOut: function (e) {
                var newZoom = this.zoom - this.options.zoomStep * 0.1;
                if (newZoom < 1 && this.zoom > 1) {
                    newZoom = 1;
                }
                const zoomMin = this.getZoomMin();
                newZoom = newZoom < zoomMin ? zoomMin : newZoom;

                if (this.zoom == newZoom) {
                    return;
                }

                this.zoom = newZoom;

                var t = this.options.zoomTime;

                this.zoomTo(this.zoom, t, e);
            },

            zoomIn: function (e) {
                var newZoom = this.zoom + this.options.zoomStep * 0.1;
                if (newZoom > 1 && this.zoom < 1) {
                    newZoom = 1;
                }

                if (newZoom > this.options.zoomMax) {
                    newZoom = this.options.zoomMax;
                }

                if (this.zoom == newZoom) {
                    return;
                }

                this.zoom = newZoom;

                this.zoomTo(this.zoom, this.options.zoomTime, e);
            },

            getZoomMin: function () {
                return this.options.viewMode == 'scroll' ? this.options.zoomMin2 : this.options.zoomMin;
            },

            nextPage: function () {
                if (this.Book) {
                    this.Book.nextPage();
                }
            },

            prevPage: function () {
                if (this.Book) {
                    this.Book.prevPage();
                }
            },

            firstPage: function () {
                this.goToPage(1);
            },

            lastPage: function () {
                this.goToPage(this.options.pages.length);
            },

            goToPage: function (pageNumber, instant) {
                if (!this.options.cover) {
                    pageNumber++;
                }

                if (pageNumber < 1) {
                    pageNumber = 1;
                } else if (pageNumber > this.options.numPages && !this.options.rightToLeft) {
                    pageNumber = this.options.numPages;
                }

                if (this.Book) {
                    this.Book.goToPage(pageNumber, instant);
                }
            },

            moveBook: function (direction) {
                if (this.Book && this.Book.move) {
                    this.Book.move(direction);
                }
            },

            onZoom: function (newZoom) {
                this.zoom = newZoom;
                const zoomMin = this.getZoomMin();
                this.enableButton(this.btnZoomIn, newZoom < this.options.zoomMax);
                this.enableButton(this.btnZoomOut, newZoom > zoomMin);
                this.enableSwipe(newZoom <= 1);
            },

            enableSwipe: function (val) {
                this.swipeEnabled = val;
            },

            createCurrentPage: function () {
                var self = this;
                var o = this.options;
                var menu;
                var cssClass = 'flipbook-currentPageHolder ';

                if (o.currentPage.vAlign == 'top') {
                    if (o.currentPage.hAlign == 'left') {
                        menu = this.menuTL;
                    } else if (o.currentPage.hAlign == 'right') {
                        menu = this.menuTR;
                    } else {
                        menu = this.menuTC;
                    }
                } else {
                    if (o.currentPage.hAlign == 'left') {
                        menu = this.menuBL;
                    } else if (o.currentPage.hAlign == 'right') {
                        menu = this.menuBR;
                    } else {
                        menu = this.menuBC;
                    }
                }

                var floating =
                    (o.currentPage.vAlign == 'top' && o.menu2Transparent) ||
                    (o.currentPage.vAlign != 'top' && o.menuTransparent);
                var bgColor = floating ? o.floatingBtnBackground : '';
                var color = floating ? o.floatingBtnColor : o.btnColor;
                var textShadiw = floating ? o.floatingBtnTextShadow : '';
                var radius = floating ? o.floatingBtnRadius : o.btnRadius;
                var currentPageHolder = jQuery('<div>').appendTo(menu);

                currentPageHolder.css('margin', o.currentPage.marginV + 'px ' + o.currentPage.marginH + 'px');

                if (!floating) {
                    cssClass += 'skin-color ';
                }

                currentPageHolder.addClass(cssClass).css({
                    'color': color,
                    'background': bgColor,
                    'text-shadow': textShadiw,
                    'border-radius': radius + 'px',
                });

                if (o.currentPage.order) {
                    currentPageHolder.css('order', o.currentPage.order);
                }

                this.currentPageHolder = currentPageHolder;
                this.currentPage = jQuery(document.createElement('div'))
                    .addClass('flipbook-currentPageNumber')
                    .appendTo(currentPageHolder);

                var $form = jQuery('<form>')
                    .appendTo(currentPageHolder)
                    .submit(function (_) {
                        var value = parseInt(self.currentPageInput.val());
                        if (self.options.rightToLeft) {
                            value = o.pages.length - value + 1;
                            value -= self.options.pageNumberOffset;
                        } else {
                            value = value > o.pages.length ? o.pages.length : value;
                            value += self.options.pageNumberOffset;
                        }
                        self.goToPage(value);
                        self.currentPageInput.trigger('blur');
                        return false;
                    });

                this.currentPageInput = jQuery('<input type="text" maxlength="4">')
                    .addClass('flipbook-currentPageInput')
                    .css({
                        margin: o.currentPage.marginV + 'px ' + o.currentPage.marginH + 'px',
                        color: color,
                    })
                    .appendTo($form)
                    .val('')
                    .focus(function () {
                        self.currentPageInput.val('');
                        self.currentPage.addClass('flipbook-color-transparent');
                    })
                    .blur(function () {
                        self.currentPageInput.val('');
                        self.currentPage.removeClass('flipbook-color-transparent');
                    });

                if (!floating) {
                    this.currentPageInput.addClass('skin-color');
                }
            },

            createMenuHeader: function (elem, title, _) {
                var self = this;

                var header = jQuery('<div>').addClass('flipbook-menu-header skin-clor flipbook-font').appendTo(elem);
                jQuery('<span>').text(title).addClass('flipbook-menu-title skin-color').appendTo(header);
                var btnClose = jQuery('<span>')
                    .appendTo(header)
                    .addClass('flipbook-btn-close')
                    .bind('touchend click', function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        self.closeMenus();
                    });

                this.createIcon(this.options.btnClose, null, true).appendTo(btnClose);
            },

            createToc: function () {
                
                var self = this;
                var tocArray = this.options.tableOfContent;

                if ((!tocArray || !tocArray.length) && this.pdfService && !this.pdfService.outlineLoaded) {
                    self.pdfService.loadOutline(function (outline) {
                        self.options.tableOfContent = outline;
                        self.createToc();
                    });
                    return;
                }

                this.tocHolder = jQuery('<div>')
                    .addClass('flipbook-tocHolder flipbook-side-menu skin-color-bg')
                    .appendTo(this.wrapper)
                    .css(this.options.sideMenuPosition, '0')
                    .hide();

                this.createMenuHeader(this.tocHolder, this.strings.tableOfContent, this.toggleToc);

                this.toc = jQuery('<div>').addClass('flipbook-toc').appendTo(this.tocHolder);

                this.tocScroller = jQuery('<div>').addClass('flipbook-toc-scroller').appendTo(this.toc);

                this.tocScroll = new FLIPBOOK.IScroll(self.toc[0], {
                    bounce: false,
                    mouseWheel: true,
                    scrollbars: true,
                    interactiveScrollbars: true,
                });

                if (tocArray && tocArray.length > 0) {
                    for (var i = 0; i < tocArray.length; i++) {
                        this.createTocItem(tocArray[i]);
                    }
                } else {
                    var arr = this.options.pages;
                    // eslint-disable-next-line no-redeclare
                    for (var i = 0; i < arr.length; i++) {
                        var title = arr[i].title;
                        if (title == '' || typeof title == 'undefined') {
                            continue;
                        }
                        var page = String(i + 1);
                        var item = { title: title, page: page };

                        this.createTocItem(item);
                    }
                }

                this.initColors();
                this.tocScroll.refresh();
                this.tocCreated = true;
                this.toggleToc();
                
            },

            goToDest: function (destArray) {
                
                var self = this;
                self.pdfService.pdfDocument.getPageIndex(destArray[0]).then(function (index) {
                    var targetPage = index + 1;

                    if (self.options.doublePage) {
                        targetPage = 2 * targetPage - 1;
                    }

                    targetPage = self.options.rightToLeft ? self.options.pages.length - targetPage + 1 : targetPage;

                    setTimeout(function () {
                        self.goToPage(targetPage);
                    }, 200);
                });
                
            },

            
            createTocItem: function (item, parent, level) {
                var self = this;
                parent = parent || this.tocScroller;
                var rtl = this.options.rightToLeft;

                var tocItem = jQuery(document.createElement('a'))
                    .attr('class', 'flipbook-tocItem')
                    .addClass('skin-color')
                    .css('direction', rtl ? 'rtl' : 'ltr')
                    .appendTo(parent)
                    .bind('touchend click', function (e) {
                        e.stopPropagation();
                        e.preventDefault();

                        if (self.tocScroll.moved) {
                            return;
                        }

                        if (self.options.tableOfContentCloseOnClick) {
                            self.toggleToc(false);
                        }

                        if (!item.page && item.dest) {
                            if (typeof item.dest === 'string') {
                                self.pdfService.pdfDocument.getDestination(item.dest).then(function (destArray) {
                                    self.goToDest(destArray);
                                });
                            } else {
                                self.goToDest(item.dest);
                            }
                        } else {
                            var targetPage = Number(item.page);

                            targetPage = self.options.rightToLeft
                                ? self.options.pages.length - targetPage + 1
                                : targetPage;

                            setTimeout(function () {
                                self.goToPage(targetPage);
                            }, 200);
                        }
                    });

                if (!level) {
                    level = 0;
                }

                tocItem.level = level;

                tocItem.css('padding', '8px 0');
                tocItem.css('margin-' + (rtl ? 'right' : 'left'), '10px');
                if (!level) {
                    tocItem.css('margin-right', '15px');
                    tocItem.css('padding-left', '10px');
                } else {
                    tocItem.css('margin-top', '8px');
                    tocItem.css('padding-bottom', '0');
                }

                var expandBtn = jQuery(document.createElement('span'))
                    .appendTo(tocItem)
                    .css('width', '20px')
                    .css('display', 'inline-block')
                    .css('cursor', 'auto')
                    .bind('touchend click', function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        for (var i = 0; i < tocItem.items.length; i++) {
                            tocItem.items[i].toggle();
                        }
                        $icon.toggle();
                        $icon2.toggle();
                        self.tocScroll.refresh();
                    });

                var $icon = jQuery('<span>')
                    .attr('aria-hidden', 'true')
                    .appendTo(expandBtn)
                    .addClass('flipbook-icon-angle-' + (rtl ? 'left' : 'right') + ' skin-color')
                    .hide();

                var $icon2 = jQuery('<span>')
                    .attr('aria-hidden', 'true')
                    .appendTo(expandBtn)
                    .addClass('flipbook-icon-angle-down skin-color')
                    .hide();

                jQuery(document.createElement('span'))
                    .appendTo(tocItem)
                    .addClass('title')
                    .text(item.title)
                    .css('width', String(170 - tocItem.level * 10) + 'px');

                if (!item.pageHidden) {
                    var pageNumber = item.page;
                    if (pageNumber) {
                        jQuery(document.createElement('span'))
                            .appendTo(tocItem)
                            .width('25px')
                            .css('display', 'inline-block')
                            .css('text-align', 'right')
                            .text(pageNumber);
                    }
                }

                if (item.items && item.items.length) {
                    tocItem.items = [];
                    for (var i = 0; i < item.items.length; i++) {
                        var subItem = this.createTocItem(item.items[i], tocItem, tocItem.level + 1);
                        tocItem.items.push(subItem);
                        subItem.hide();
                    }
                    $icon.show();
                }

                return tocItem;
            },
            

            enablePrev: function (val) {
                this.enableButton(this.btnPrev, val);
                this.enableButton(this.btnFirst, val);
                this.Book.enablePrev(val);
            },

            enableNext: function (val) {
                this.enableButton(this.btnNext, val);
                this.enableButton(this.btnLast, val);
                this.Book.enableNext(val);
            },

            enableButton: function (button, enabled) {
                if (typeof button == 'undefined') {
                    return;
                }
                if (enabled) {
                    button.css('opacity', '1');
                    button.css('pointer-events', 'auto');
                } else {
                    button.css('opacity', '0.2');
                    button.css('pointer-events', 'none');
                }
                button.enabled = enabled;
            },

            resize: function () {
                var o = this.options;

                if (!this.wrapperH) {
                    var clone = this.elem[0].cloneNode(true);
                    document.body.appendChild(clone);
                    var $clone = jQuery(clone);
                    this.wrapperW = $clone.width();
                    this.wrapperH = $clone.height();
                    if (!o.menuOverBook && this.menuShowing && this.menuBottom) {
                        var menuClone = this.menuBottom[0].cloneNode(true);
                        document.body.appendChild(menuClone);
                        this.wrapperH -= jQuery(menuClone).height();
                        document.body.removeChild(menuClone);
                    }

                    document.body.removeChild(clone);
                }

                if (!this.Book || !this.Book.enabled) {
                    return;
                }

                if (this.menuShowing) {
                    if (!o.menuOverBook && this.menuBottom) {
                        this.bookLayer.css('bottom', this.menuBottom.outerHeight() + 'px');
                    } else {
                        this.bookLayer.css('bottom', '0px');
                    }

                    if (!o.menu2OverBook && this.menuTop) {
                        this.bookLayer.css('top', this.menuTop.outerHeight() + 'px');
                    } else {
                        this.bookLayer.css('top', '0px');
                    }
                }

                if (this.tocShowing || this.thumbsShowing || this.searchShowing || this.bookmarkShowing) {
                    if (!o.sideMenuOverBook) {
                        this.bookLayer.css(this.options.sideMenuPosition, '250px');
                    }
                    if (!this.options.sideMenuOverMenu) {
                        this.wrapper.find('.flipbook-side-menu').css('bottom', this.menuBottom.outerHeight() + 'px');
                    }
                    if (!this.options.sideMenuOverMenu2) {
                        this.wrapper.find('.flipbook-side-menu').css('top', this.menuTop.outerHeight() + 'px');
                    }
                } else {
                    this.bookLayer.css(this.options.sideMenuPosition, '0px');
                }

                this.wrapperW = this.bookLayer.width();
                this.wrapperH = this.bookLayer.height();

                var wrapperRatio = this.wrapperW / this.wrapperH;
                var pageRatio = this.pageW / this.pageH;
                var bookRatio = 2 * pageRatio;

                if (o.viewMode == 'scroll') {
                    o.zoomMax = (2 * ((o.zoomSize * o.pageWidth) / o.pageHeight)) / this.wrapperW;
                } else if (
                    o.responsiveView &&
                    this.wrapperW <= o.responsiveViewTreshold &&
                    wrapperRatio < 2 * pageRatio &&
                    wrapperRatio < o.responsiveViewRatio
                ) {
                    if (wrapperRatio > pageRatio) {
                        o.zoomMax = o.zoomSize / this.wrapperH;
                    } else {
                        o.zoomMax = (o.zoomSize / this.wrapperH) * (pageRatio / wrapperRatio);
                    }
                } else {
                    if (wrapperRatio > bookRatio) {
                        o.zoomMax = o.zoomSize / this.wrapperH;
                    } else {
                        o.zoomMax = (o.zoomSize / this.wrapperH) * (bookRatio / wrapperRatio);
                    }
                }

                if (o.zoomMax < o.zoomMin) {
                    o.zoomMax = o.zoomMin;
                }

                this.Book.onResize();

                if (this.options.zoomReset) {
                    this.Book.zoomTo(this.options.zoomMin);
                }
            },

            pdfResize: function () {
                var self = this;
                self.Book.onZoom();
            },

            createThumbs: function () {
                
                this.thumbs = new FLIPBOOK.Thumbnails(this);
                
            },

            toggleThumbs: function (value) {
                
                if (!this.thumbs) {
                    this.createThumbs();
                }

                if (typeof value != 'undefined') {
                    this.thumbsShowing = !value;
                }

                if (!this.thumbsShowing) {
                    this.closeMenus();
                    this.thumbs.show();
                    this.thumbsShowing = true;
                } else {
                    this.thumbs.hide();
                    this.thumbsShowing = false;
                }

                this.resize();
                
            },

            toggleToc: function (value) {
                
                if (!this.tocCreated) {
                    this.createToc();
                    return;
                }

                if (!this.tocShowing || value) {
                    this.closeMenus();
                    this.tocShowing = true;
                    this.tocHolder.show();
                    this.tocScroll.refresh();
                } else {
                    this.tocHolder.hide();
                    this.tocShowing = false;
                }

                this.resize();
                
            },

            toggleSearch: function (value) {
                
                if (!this.thumbs) {
                    this.createThumbs();
                }

                if (typeof value != 'undefined') {
                    this.searchShowing = !value;
                }

                if (!this.searchShowing) {
                    this.closeMenus();
                    this.thumbs.show();
                    this.thumbs.showSearch();
                    this.searchShowing = true;
                } else {
                    this.thumbs.hide();
                    this.searchShowing = false;
                    this.unmark();
                }

                this.resize();
                
            },

            toggleBookmark: function (value) {
                
                if (!this.thumbs) {
                    this.createThumbs();
                }

                if (typeof value != 'undefined') {
                    this.bookmarkShowing = !value;
                }

                if (!this.bookmarkShowing) {
                    this.closeMenus();
                    this.thumbs.show();
                    this.thumbs.showBookmarks();
                    this.bookmarkShowing = true;
                } else {
                    this.thumbs.hide();
                    this.bookmarkShowing = false;
                }

                this.resize();
                
            },

            closeMenus: function () {
                if (this.thumbsShowing) {
                    this.toggleThumbs();
                }
                if (this.tocShowing) {
                    this.toggleToc();
                }
                if (this.searchShowing) {
                    this.toggleSearch();
                }
                if (this.bookmarkShowing) {
                    this.toggleBookmark();
                }

                if (this.printMenuShowing) {
                    this.togglePrintMenu();
                }
                if (this.dlMenuShowing) {
                    this.toggleDownloadMenu();
                }
                if (this.shareMenuShowing) {
                    this.toggleShareMenu();
                }
                if (this.notesMenuShowing) {
                    this.toggleNotesMenu();
                }
                if (this.passwordMenuShowing) {
                    this.togglePasswordMenu();
                }
            },

            togglePrintMenu: function () {
                
                var self = this;

                if (!this.printMenu) {
                    this.printMenu = jQuery('<div class="flipbook-sub-menu flipbook-font">').appendTo(this.wrapper);

                    var center = jQuery('<div class="flipbook-sub-menu-center">').appendTo(this.printMenu);
                    var content = jQuery('<div class="flipbook-sub-menu-content skin-color-bg">').appendTo(center);

                    this.createMenuHeader(content, this.strings.print, this.togglePrintMenu);

                    // current
                    jQuery(
                        '<a><div class="c-p skin-color flipbook-btn">' + this.strings.printCurrentPage + '</div></a>'
                    )
                        .appendTo(content)
                        .bind('touchend click', function (_) {
                            self.printPage(self.cPage[0], this);
                        });

                    // left
                    jQuery('<a><div class="c-l-p skin-color flipbook-btn">' + this.strings.printLeftPage + '</div></a>')
                        .appendTo(this.printMenu)
                        .appendTo(content)
                        .bind('touchend click', function (_) {
                            self.printPage(self.cPage[0], this);
                        });

                    // right
                    jQuery(
                        '<a><div class="c-r-p skin-color flipbook-btn">' + this.strings.printRightPage + '</div></a>'
                    )
                        .appendTo(this.printMenu)
                        .appendTo(content)
                        .bind('touchend click', function (_) {
                            self.printPage(self.cPage[1], this);
                        });

                    // all
                    jQuery('<a><div class="skin-color flipbook-btn">' + this.strings.printAllPages + '</div></a>')
                        .appendTo(content)
                        .bind('touchend click', function (_) {
                            self.togglePrintWindow();
                        });

                    this.closeMenus();
                    this.printMenuShowing = true;
                    this.initColors();
                    this.updateCurrentPage();
                } else if (!this.printMenuShowing) {
                    this.closeMenus();
                    this.printMenu.show();
                    this.printMenuShowing = true;
                    this.updateCurrentPage();
                } else {
                    this.printMenu.hide();
                    this.printMenuShowing = false;
                }
                
            },

            toggleDownloadMenu: function () {
                
                var self = this;

                if (!this.dlMenu) {
                    this.dlMenu = jQuery('<div class="flipbook-sub-menu flipbook-font">').appendTo(this.wrapper);

                    var center = jQuery('<div class="flipbook-sub-menu-center">').appendTo(this.dlMenu);
                    var content = jQuery('<div class="flipbook-sub-menu-content skin-color-bg">').appendTo(center);

                    this.createMenuHeader(content, this.strings.download, this.toggleDownloadMenu);

                    // current
                    jQuery(
                        '<a><div class="c-p skin-color flipbook-btn">' + this.strings.downloadCurrentPage + '</div></a>'
                    )
                        .appendTo(content)
                        .bind('touchend click', function (_) {
                            self.downloadPage(self.cPage[0], this);
                        });

                    // left
                    jQuery(
                        '<a><div class="c-l-p skin-color flipbook-btn">' + this.strings.downloadLeftPage + '</div></a>'
                    )
                        .appendTo(content)
                        .bind('touchend click', function (_) {
                            self.downloadPage(self.cPage[0], this);
                        });

                    // right
                    jQuery(
                        '<a><div class="c-r-p skin-color flipbook-btn">' + this.strings.downloadRightPage + '</div></a>'
                    )
                        .appendTo(content)
                        .bind('touchend click', function (_) {
                            self.downloadPage(self.cPage[1], this);
                        });

                    // all
                    jQuery('<a><div class="skin-color flipbook-btn">' + this.strings.downloadAllPages + '</div></a>')
                        .appendTo(content)
                        .bind('touchend click', function (_) {
                            var link = document.createElement('a');
                            link.href = self.options.btnDownloadPages.url;
                            var filename = link.href.split('/').pop().split('#')[0].split('?')[0];
                            link.download = filename;
                            link.dispatchEvent(new MouseEvent('click'));
                        });

                    this.closeMenus();
                    this.dlMenuShowing = true;
                    this.initColors();
                    this.updateCurrentPage();
                } else if (!this.dlMenuShowing) {
                    this.dlMenu.show();
                    this.closeMenus();
                    this.dlMenuShowing = true;
                    this.updateCurrentPage();
                } else {
                    this.dlMenu.hide();
                    this.dlMenuShowing = false;
                }
                
            },

            toggleShareMenu: function () {
                
                if (!this.shareMenu) {
                    this.shareMenu = jQuery(document.createElement('div'))
                        .appendTo(this.wrapper)
                        .addClass('flipbook-sub-menu flipbook-font');

                    var center = jQuery(document.createElement('div'))
                        .appendTo(this.shareMenu)
                        .addClass('flipbook-sub-menu-center');
                    var content = jQuery(document.createElement('div'))
                        .appendTo(center)
                        .addClass('flipbook-sub-menu-content skin-color-bg');

                    this.createMenuHeader(content, this.options.strings.share, this.toggleShareMenu);

                    var o = this.options;

                    var $shareButtons = jQuery('<div class="flipbook-share">' + '<ul>' + '</ul>' + '</div>').appendTo(
                        content
                    );

                    var networks = [
                        'facebook',
                        'twitter',
                        'pinterest',
                        'linkedin',
                        'email',
                        'whatsapp',
                        'digg',
                        'reddit',
                    ];

                    var $ul = $shareButtons.find('ul');

                    var left = window.screen.width / 2 - 300;
                    var top = window.screen.height / 2 - 300;

                    networks.forEach(function (network) {
                        if (o[network].enabled) {
                            jQuery(
                                '<li data-network="' +
                                    network +
                                    '"><i class="' +
                                    o[network].icon +
                                    ' skin-color flipbook-color-' +
                                    o.skin +
                                    '"></i></li>'
                            )
                                .appendTo($ul)
                                .bind('tap click', function (e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    var network = this.dataset.network;
                                    var text = encodeURIComponent(
                                        o.shareTitle || o[network].description || 'Check out this flipbook'
                                    );
                                    var url = encodeURIComponent(o.shareUrl || window.location.href);
                                    var image = encodeURIComponent(o.shareImage || '');
                                    var shareUrl;

                                    switch (network) {
                                        case 'facebook':
                                            shareUrl = 'https://www.facebook.com/sharer.php?u=' + url + '&t=' + text;
                                            break;
                                        case 'twitter':
                                            shareUrl = 'https://twitter.com/intent/tweet?text=' + text + '&url=' + url;
                                            break;
                                        case 'linkedin':
                                            shareUrl =
                                                'https://www.linkedin.com/shareArticle?mini=true&url=' +
                                                url +
                                                '&title=' +
                                                text;
                                            break;
                                        case 'pinterest':
                                            shareUrl =
                                                'https://www.pinterest.com/pin/create/button/?url=' +
                                                url +
                                                '&media=' +
                                                image +
                                                '&description=' +
                                                text;
                                            break;
                                        case 'email':
                                            shareUrl = 'mailto:?subject=' + text + '&body=' + url;
                                            break;
                                        case 'digg':
                                            shareUrl = 'http://digg.com/submit?url=' + url + '&title=' + text;
                                            break;
                                        case 'reddit':
                                            shareUrl = 'http://reddit.com/submit?url=' + url + '&title=' + text;
                                            break;
                                        case 'whatsapp':
                                            if (o.isMobile) {
                                                shareUrl = 'whatsapp://send?text=' + text + '%20' + url;
                                            } else {
                                                shareUrl = 'https://wa.me?text=' + text + '%20' + url;
                                            }
                                            break;
                                    }

                                    window.open(
                                        shareUrl,
                                        'Share',
                                        'toolbar=no, location=no, directories=no, status=no, ' +
                                            'menubar=no, scrollbars=no, resizable=no, copyhistory=no, ' +
                                            'width=600, height=600, top=' +
                                            top +
                                            ', left=' +
                                            left
                                    );
                                });
                        }
                    });

                    this.closeMenus();
                    this.shareMenuShowing = true;
                    this.initColors();
                } else if (!this.shareMenuShowing) {
                    this.shareMenu.show();

                    this.closeMenus();
                    this.shareMenuShowing = true;
                } else {
                    this.shareMenu.hide();
                    this.shareMenuShowing = false;
                }
                
            },

            toggleNotesMenu: function () {
                
                if (!this.notesMenu) {
                    this.notesMenu = jQuery(document.createElement('div'))
                        .appendTo(this.wrapper)
                        .addClass('flipbook-sub-menu flipbook-font');
                    var center = jQuery('<div class="flipbook-sub-menu-center">').appendTo(this.notesMenu);
                    var content = jQuery('<div class="flipbook-sub-menu-content skin-color-bg">').appendTo(center);
                    this.createMenuHeader(content, this.options.strings.notes, this.toggleNotesMenu);
                    this.closeMenus();
                    this.notesMenuShowing = true;
                    this.initColors();

                    const self = this;
                    this.options.noteTypes.forEach(function (type) {
                        const row = document.createElement('div');
                        row.innerHTML =
                            '<span>' +
                            type.title +
                            '</span>' +
                            '<span aria-hidden="true" class="flipbook-icon-comment flipbook-icon flipbook-menu-btn" ' +
                            'style="font-size: 14px; margin: 2px; padding: 12px; ' +
                            'opacity: var(--flipbook-link-opacity);color:' +
                            type.color +
                            '"></span>';
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.dataset.id = type.id;
                        checkbox.checked = type.enabled;
                        checkbox.onchange = function () {
                            type.enabled = this.checked;
                            self.updateNoteSettings(type);
                        };
                        row.appendChild(checkbox);
                        content[0].appendChild(row);
                    });
                } else if (!this.notesMenuShowing) {
                    this.notesMenu.show();

                    this.closeMenus();
                    this.notesMenuShowing = true;
                } else {
                    this.notesMenu.hide();
                    this.notesMenuShowing = false;
                }
                
            },

            updateNoteSettings: function (noteType) {
                this.options.noteTypes.forEach(function (type) {
                    if (type.id == noteType.id) {
                        type.enabled = noteType.enabled;
                    }
                });
                this.noteService.updateNoteVisibility();
            },

            bookmarkPage: function (index) {
                
                var arr = this.getBookmarkedPages();
                if (arr.indexOf(String(index)) < 0) {
                    arr.push(index);
                }
                this.setBookmarkedPages(arr);

                this.thumbs.showBookmarkedThumbs();

                if (!this.bookmarkShowing) {
                    this.toggleBookmark();
                }
                
            },

            removeBookmark: function (index) {
                
                var arr = this.getBookmarkedPages();
                if (arr.indexOf(String(index)) > -1) {
                    arr.splice(arr.indexOf(String(index)), 1);
                }
                this.setBookmarkedPages(arr);

                this.thumbs.showBookmarkedThumbs();

                if (!this.bookmarkShowing) {
                    this.toggleBookmark();
                }
                
            },

            isBookmarked: function (index) {
                var arr = this.getBookmarkedPages();
                return arr.indexOf(String(index)) > 0;
            },

            getBookmarkedPages: function () {
                var str = localStorage.getItem(this.options.name + '_flipbook_bookmarks');
                if (str) {
                    return str.split(';');
                } else {
                    return [];
                }
            },

            setBookmarkedPages: function (arr) {
                localStorage.setItem(this.options.name + '_flipbook_bookmarks', arr.join(';'));
            },

            printPage: function (index, _) {
                
                var url;
                var page = this.options.pages[index];
                var size = this.options.pageTextureSize;
                var self = this;

                if (page) {
                    if (page.print) {
                        url = page.print;
                    } else if (page.images && page.images[size]) {
                        const c = document.createElement('canvas');
                        const ctx = c.getContext('2d');
                        const image = page.images[size];
                        c.width = image.width;
                        c.height = image.height;

                        ctx.drawImage(image, 0, 0, image.width, image.height);
                        url = c.toDataURL();

                        c.width = c.height = 1;
                        ctx.clearRect(0, 0, 1, 1);
                    } else if (page.src) {
                        url = page.src;
                    }
                }

                if (url) {
                    this.togglePrintWindow(url);
                } else {
                    this.loadPage(index, size, function () {
                        self.printPage(index);
                    });
                }
                
            },

            downloadPage: function (index) {
                
                var url;
                var page = this.options.pages[index];
                var size = this.options.pageTextureSize;

                if (page && page.download) {
                    url = page.download;
                } else if (page && page.src) {
                    url = page.src;
                } else if (page && page.images && page.images[size]) {
                    const c = document.createElement('canvas');
                    const ctx = c.getContext('2d');
                    const image = page.images[size];
                    c.width = image.width;
                    c.height = image.height;

                    ctx.drawImage(image, 0, 0, image.width, image.height);
                    url = c.toDataURL();

                    c.width = c.height = 1;
                    ctx.clearRect(0, 0, 1, 1);
                }

                if (url) {
                    var link = document.createElement('a');
                    link.href = url;
                    link.download = 'page' + String(index + 1);

                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else {
                    var self = this;
                    this.loadPage(index, this.options.pageTextureSize, function () {
                        self.downloadPage(index);
                    });
                }
                
            },

            printFile: function (url) {
                
                var printIframe = document.createElement('iframe');
                printIframe.style.display = 'none';
                printIframe.src = url;
                document.body.appendChild(printIframe);
                printIframe.contentWindow.onload = function () {
                    var self = this;
                    setTimeout(function () {
                        self.print();
                    }, 100);
                };
                
            },

            togglePrintWindow: function (url) {
                
                var self = this;
                var printContent = '';

                if (url) {
                    printContent = url;
                } else if (self.options.printPdfUrl) {
                    self.printFile(self.options.printPdfUrl);
                    return;
                } else if (self.options.pdfUrl) {
                    self.printFile(self.options.pdfUrl);
                    return;
                }

                function printme() {
                    var link = 'about:blank';
                    var pw = window.open(link, '_new');
                    pw.document.open();
                    if (url) {
                        printContent = '<img src="' + url + '"/>\n';
                    } else {
                        for (var i = 0; i < self.options.pages.length; i++) {
                            if (self.options.pages[i].src) {
                                printContent += '<img src="' + self.options.pages[i].src.toString() + '"/>\n';
                            }
                        }
                    }

                    var printHtml = printWindowHtml(printContent);
                    pw.document.write(printHtml);
                    pw.document.close();
                }

                function printWindowHtml(printContent) {
                    return (
                        '<html>\n' +
                        '<head>\n' +
                        '<title>Temporary Printing Window</title>\n' +
                        '<script>\n' +
                        'function step1() {\n' +
                        "  setTimeout('step2()', 10);\n" +
                        '}\n' +
                        'function step2() {\n' +
                        "  window.addEventListener('afterprint', function(){\n" +
                        '       debugger;\n' +
                        '       window.close();\n' +
                        '  });\n' +
                        '  window.print();\n' +
                        '}\n' +
                        '</scr' +
                        'ipt>\n' +
                        '<style>img {' +
                        'display:block;' +
                        'max-width:100%;' +
                        'page-break-after: always;' +
                        '}' +
                        '@media print header{' +
                        'display: none;' +
                        '}</style>\n' +
                        '</head>\n' +
                        "<body onLoad='step1()'>\n" +
                        printContent +
                        '</body>\n' +
                        '</html>\n'
                    );
                }

                printme();
                
            },

            thumbsVertical: function () {
                if (!this.thumbsCreated) {
                    return;
                }
                this.thumbScroll.hScroll = false;
                this.thumbScroll.vScroll = true;
                this.thumbScroll.refresh();
            },

            toggleExpand: function (_) {
                
                if (window.screenfull.enabled) {
                    window.screenfull.toggle(this.fullscreenElement);
                } else {
                    this.isFullscreen = !this.isFullscreen;
                    this.handleFsChange(true);
                }
                
            },

            expand: function () {},

            toggleAutoplay: function (value) {
                
                var self = this;
                this.autoplay = value || !this.autoplay;

                if (this.autoplay) {
                    this.autoplayTimer = setInterval(function () {
                        if (self.autoplay) {
                            var autoplayStartPage = self.options.autoplayStartPage || 1;

                            if (self.options.rightToLeft) {
                                if (self.Book.prevEnabled) {
                                    self.prevPage();
                                } else if (self.options.autoplayLoop) {
                                    self.goToPage(self.options.pages.length - autoplayStartPage + 1);
                                } else {
                                    self.toggleAutoplay(false);
                                }
                            } else {
                                if (self.Book.nextEnabled) {
                                    self.nextPage();
                                } else if (self.options.autoplayLoop) {
                                    self.goToPage(autoplayStartPage);
                                } else {
                                    self.toggleAutoplay(false);
                                }
                            }
                        }
                    }, self.options.autoplayInterval);
                } else {
                    clearInterval(self.autoplayTimer);
                }

                this.toggleIcon(this.btnAutoplay, !this.autoplay);
                
            },

            triggerResizeOnce: function () {
                setTimeout(function () {
                    jQuery(window).trigger('resize');
                }, 100);
                setTimeout(function () {
                    jQuery(window).trigger('resize');
                }, 500);
            },

            triggerResize: function () {
                setTimeout(function () {
                    jQuery(window).trigger('resize');
                }, 100);
                setTimeout(function () {
                    jQuery(window).trigger('resize');
                }, 500);
                setTimeout(function () {
                    jQuery(window).trigger('resize');
                }, 2000);
            },

            initEasing: function () {
                window.jQuery.extend(window.jQuery.easing, {
                    def: 'easeOutQuad',
                    swing: function (x, t, b, c, d) {
                        return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
                    },
                    easeInQuad: function (x, t, b, c, d) {
                        return c * (t /= d) * t + b;
                    },
                    easeOutQuad: function (x, t, b, c, d) {
                        return -c * (t /= d) * (t - 2) + b;
                    },
                    easeInOutQuad: function (x, t, b, c, d) {
                        if ((t /= d / 2) < 1) {
                            return (c / 2) * t * t + b;
                        }
                        return (-c / 2) * (--t * (t - 2) - 1) + b;
                    },
                    easeInCubic: function (x, t, b, c, d) {
                        return c * (t /= d) * t * t + b;
                    },
                    easeOutCubic: function (x, t, b, c, d) {
                        return c * ((t = t / d - 1) * t * t + 1) + b;
                    },
                    easeInOutCubic: function (x, t, b, c, d) {
                        if ((t /= d / 2) < 1) {
                            return (c / 2) * t * t * t + b;
                        }
                        return (c / 2) * ((t -= 2) * t * t + 2) + b;
                    },
                    easeInQuart: function (x, t, b, c, d) {
                        return c * (t /= d) * t * t * t + b;
                    },
                    easeOutQuart: function (x, t, b, c, d) {
                        return -c * ((t = t / d - 1) * t * t * t - 1) + b;
                    },
                    easeInOutQuart: function (x, t, b, c, d) {
                        if ((t /= d / 2) < 1) {
                            return (c / 2) * t * t * t * t + b;
                        }
                        return (-c / 2) * ((t -= 2) * t * t * t - 2) + b;
                    },
                    easeInQuint: function (x, t, b, c, d) {
                        return c * (t /= d) * t * t * t * t + b;
                    },
                    easeOutQuint: function (x, t, b, c, d) {
                        return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
                    },
                    easeInOutQuint: function (x, t, b, c, d) {
                        if ((t /= d / 2) < 1) {
                            return (c / 2) * t * t * t * t * t + b;
                        }
                        return (c / 2) * ((t -= 2) * t * t * t * t + 2) + b;
                    },
                    easeInSine: function (x, t, b, c, d) {
                        return -c * Math.cos((t / d) * (Math.PI / 2)) + c + b;
                    },
                    easeOutSine: function (x, t, b, c, d) {
                        return c * Math.sin((t / d) * (Math.PI / 2)) + b;
                    },
                    easeInOutSine: function (x, t, b, c, d) {
                        return (-c / 2) * (Math.cos((Math.PI * t) / d) - 1) + b;
                    },
                    easeInExpo: function (x, t, b, c, d) {
                        return t == 0 ? b : c * Math.pow(2, 10 * (t / d - 1)) + b;
                    },
                    easeOutExpo: function (x, t, b, c, d) {
                        return t == d ? b + c : c * (-Math.pow(2, (-10 * t) / d) + 1) + b;
                    },
                    easeInOutExpo: function (x, t, b, c, d) {
                        if (t == 0) {
                            return b;
                        }
                        if (t == d) {
                            return b + c;
                        }
                        if ((t /= d / 2) < 1) {
                            return (c / 2) * Math.pow(2, 10 * (t - 1)) + b;
                        }
                        return (c / 2) * (-Math.pow(2, -10 * --t) + 2) + b;
                    },
                    easeInCirc: function (x, t, b, c, d) {
                        return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b;
                    },
                    easeOutCirc: function (x, t, b, c, d) {
                        return c * Math.sqrt(1 - (t = t / d - 1) * t) + b;
                    },
                    easeInOutCirc: function (x, t, b, c, d) {
                        if ((t /= d / 2) < 1) {
                            return (-c / 2) * (Math.sqrt(1 - t * t) - 1) + b;
                        }
                        return (c / 2) * (Math.sqrt(1 - (t -= 2) * t) + 1) + b;
                    },
                    easeInElastic: function (x, t, b, c, d) {
                        var s = 1.70158;
                        var p = 0;
                        var a = c;
                        if (t == 0) {
                            return b;
                        }
                        if ((t /= d) == 1) {
                            return b + c;
                        }
                        if (!p) {
                            p = d * 0.3;
                        }
                        if (a < Math.abs(c)) {
                            a = c;
                            s = p / 4;
                        } else {
                            s = (p / (2 * Math.PI)) * Math.asin(c / a);
                        }
                        return -(a * Math.pow(2, 10 * (t -= 1)) * Math.sin(((t * d - s) * (2 * Math.PI)) / p)) + b;
                    },
                    easeOutElastic: function (x, t, b, c, d) {
                        var s = 1.70158;
                        var p = 0;
                        var a = c;
                        if (t == 0) {
                            return b;
                        }
                        if ((t /= d) == 1) {
                            return b + c;
                        }
                        if (!p) {
                            p = d * 0.3;
                        }
                        if (a < Math.abs(c)) {
                            a = c;
                            s = p / 4;
                        } else {
                            s = (p / (2 * Math.PI)) * Math.asin(c / a);
                        }
                        return a * Math.pow(2, -10 * t) * Math.sin(((t * d - s) * (2 * Math.PI)) / p) + c + b;
                    },
                    easeInOutElastic: function (x, t, b, c, d) {
                        var s = 1.70158;
                        var p = 0;
                        var a = c;
                        if (t == 0) {
                            return b;
                        }
                        if ((t /= d / 2) == 2) {
                            return b + c;
                        }
                        if (!p) {
                            p = d * (0.3 * 1.5);
                        }
                        if (a < Math.abs(c)) {
                            a = c;
                            s = p / 4;
                        } else {
                            s = (p / (2 * Math.PI)) * Math.asin(c / a);
                        }
                        if (t < 1) {
                            return (
                                -0.5 * (a * Math.pow(2, 10 * (t -= 1)) * Math.sin(((t * d - s) * (2 * Math.PI)) / p)) +
                                b
                            );
                        }
                        return (
                            a * Math.pow(2, -10 * (t -= 1)) * Math.sin(((t * d - s) * (2 * Math.PI)) / p) * 0.5 + c + b
                        );
                    },
                    easeInBack: function (x, t, b, c, d, s) {
                        if (s == undefined) {
                            s = 1.70158;
                        }
                        return c * (t /= d) * t * ((s + 1) * t - s) + b;
                    },
                    easeOutBack: function (x, t, b, c, d, s) {
                        if (s == undefined) {
                            s = 1.70158;
                        }
                        return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b;
                    },
                    easeInOutBack: function (x, t, b, c, d, s) {
                        if (s == undefined) {
                            s = 1.70158;
                        }
                        if ((t /= d / 2) < 1) {
                            return (c / 2) * (t * t * (((s *= 1.525) + 1) * t - s)) + b;
                        }
                        return (c / 2) * ((t -= 2) * t * (((s *= 1.525) + 1) * t + s) + 2) + b;
                    },
                    easeInBounce: function (x, t, b, c, d) {
                        return c - jQuery.easing.easeOutBounce(x, d - t, 0, c, d) + b;
                    },
                    easeOutBounce: function (x, t, b, c, d) {
                        if ((t /= d) < 1 / 2.75) {
                            return c * (7.5625 * t * t) + b;
                        } else if (t < 2 / 2.75) {
                            return c * (7.5625 * (t -= 1.5 / 2.75) * t + 0.75) + b;
                        } else if (t < 2.5 / 2.75) {
                            return c * (7.5625 * (t -= 2.25 / 2.75) * t + 0.9375) + b;
                        } else {
                            return c * (7.5625 * (t -= 2.625 / 2.75) * t + 0.984375) + b;
                        }
                    },
                    easeInOutBounce: function (x, t, b, c, d) {
                        if (t < d / 2) {
                            return jQuery.easing.easeInBounce(x, t * 2, 0, c, d) * 0.5 + b;
                        }
                        return jQuery.easing.easeOutBounce(x, t * 2 - d, 0, c, d) * 0.5 + c * 0.5 + b;
                    },
                });
            },
        };

        {
            FLIPBOOK.Book = function () {};

            FLIPBOOK.Book.prototype = {
                rightIndex: 0,

                goToPage: function () {},

                getRightIndex: function () {},

                canFlipNext: function () {
                    if (this.flippedright > 0) {
                        if (this.view == 1) {
                            return this.isFocusedLeft && this.isFocusedLeft();
                        } else if (this.flippedright == 1 && !this.options.rightToLeft && !this.options.backCover) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                    return false;
                },

                canFlipPrev: function () {
                    if (this.flippedleft > 0) {
                        if (this.view == 1) {
                            return this.isFocusedRight && this.isFocusedRight();
                        } else if (this.flippedleft == 1 && this.options.rightToLeft && !this.options.backCover) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                    return false;
                },

                getCurrentPageNumber: function () {
                    var ri = this.rightIndex % 2 == 1 ? this.rightIndex + 1 : this.rightIndex;
                    if (this.options.rightToLeft) {
                        ri = this.options.pages.length - ri;
                        return this.isFocusedRight() ? ri : ri + 1;
                    } else {
                        return this.isFocusedLeft() ? ri : ri + 1;
                    }
                },
            };
        }

        {
            FLIPBOOK.Notes = function (main) {
                const self = this;
                this.main = main;
                this.notes = Object.values(main.options.notes || []);

                this.textSelectionRect = document.createElement('span');
                this.textSelectionRect.className = 'flipbook-add-note-rect hover';
                const btn = document.createElement('span');
                btn.className = 'add-note-btn';
                btn.innerText = main.options.strings.addNote;
                btn.onclick = function () {
                    self.hideButton();
                    self.createNote();
                };
                btn.onmousedown = function () {};
                this.noteButton = btn;
                this.textSelectionRect.appendChild(btn);
                this.hideButton();

                this.notePopup = document.createElement('div');
                this.notePopup.className = 'flipbook-note-display';
                this.notePopup.innerHTML =
                    '<div class="note-content"><textarea role="textbox" maxlength="500" placeholder="' +
                    main.options.strings.typeInYourNote +
                    '" tabindex="0" class="note-article"></textarea></div> ' +
                    '<div  aria-hidden="true" class="note-footer"> ' +
                    '<span title="Delete Note" class="icon icon-trash-can note-button note-delete-button">' +
                    '<svg version="1.1" viewBox="0 0 24 24" class="svg-icon svg-fill" focusable="false">' +
                    '<path pid="0" d="M15.976 17.862c0 .607-.414 1.138-.885 1.138H8.893c-.47 ' +
                    '0-.869-.513-.869-1.12L8.002 8H16l-.023 9.862zM20 6h-5V4.466C15 3.66 14.853 3 14.013 ' +
                    '3h-3.858C9.315 3 9 3.659 9 4.466V6H4v2h2v10c0 1.843 1.153 3 2.893 3h6.198C16.84 21 18 ' +
                    '19.852 18 18V8h2V6z"></path>' +
                    '<path pid="1" d="M13 18h1V9h-1zM10 18h1V9h-1z"></path></svg></span></div>';
                this.notePopup.onmouseup = function (e) {
                    e.stopPropagation();
                };
                this.noteDelete = this.notePopup.getElementsByClassName('note-delete-button')[0];
                this.noteDelete.onclick = function () {
                    self.deleteNote();
                };
                this.noteInput = this.notePopup.querySelectorAll('textarea')[0];
                this.noteInput.onchange = function () {
                    const noteId = this.dataset.note;
                    const noteText = this.value;
                    self.getNoteById(noteId).text = noteText;
                    self.main.trigger('r3d-update-note', {
                        note: self.getNoteById(noteId),
                    });
                };

                this.updateNoteVisibility();
            };

            FLIPBOOK.Notes.prototype = {
                initPageNotes: function (page) {
                    const self = this;
                    this.notes.forEach(function (note) {
                        if (note.page == page.index + 1) {
                            self.addPageNote(note, page);
                        }
                    });
                    this.addPageNoteListeners(page);
                },

                getNodeColor: function (note) {
                    let result = 'green';
                    this.main.options.noteTypes.forEach(function (type) {
                        if (type.id == note.type) {
                            result = type.color;
                        }
                    });
                    return result;
                },

                updateNoteVisibility: function () {
                    let root = document.documentElement;
                    this.main.options.noteTypes.forEach(function (type) {
                        root.style.setProperty(`--note-${type.id}-opacity`, type.enabled ? '1' : '0');
                        root.style.setProperty(`--note-${type.id}-pointer-events`, type.enabled ? 'auto' : 'none');
                    });
                },

                addPageNote: function (note) {
                    const pageNumber = note.page;
                    const page = this.main.options.pages[pageNumber - 1];
                    const color = this.getNodeColor(note) || 'yellow';
                    if (note.selectedText && page.htmlContentInitialized) {
                        if (!note.id) {
                            note.id = Date.now() + Math.floor(Math.random() * 1000);
                        }
                        const $htmlContent = jQuery(page.htmlContent);
                        const $textLayer = $htmlContent.find('.flipbook-textLayer');
                        const uniqueClass = `flipbook-page-note 
                                                     note-id-${note.id} 
                                                     note-page-${pageNumber} 
                                                     note-type-${note.type} 
                                                     mark-${color} 
                                                     flipbook-note-${note.id}`;
                        $textLayer.mark(note.selectedText, {
                            acrossElements: true,
                            separateWordSearch: false,
                            className: 'mark-note ' + uniqueClass,
                        });
                        const self = this;
                        $textLayer.find(`.note-id-${note.id}`).each(function (index, el) {
                            el.dataset.note = note.id;
                            el.onclick = function () {
                                self.showNote(this, page, this.dataset.note);
                                self.hideButton();
                            };
                            el.style.opacity = 'var(--note-' + note.type + '-opacity)';
                            el.style.pointerEvents = 'var(--note-' + note.type + '-pointer-events)';
                        });
                    }
                },

                showButton: function () {
                    this.noteButton.style.display = 'block';
                },

                hideButton: function () {
                    this.noteButton.style.display = 'none';
                },

                showNote(target, page, id) {
                    const pageRect = page.htmlContent.getBoundingClientRect();
                    const targetRect = target.getBoundingClientRect();

                    const note = this.getNoteById(id);
                    const $htmlContent = jQuery(page.htmlContent);
                    $htmlContent[0].appendChild(this.notePopup);

                    const main = this.main;
                    const scale = (main.Book.sc * main.wrapperH) / 1000;
                    const noteTop = (targetRect.y / main.zoom - pageRect.y / main.zoom) / scale;

                    if (noteTop < 150) {
                        this.notePopup.style.top = noteTop + 40 + 'px';
                    } else {
                        this.notePopup.style.top = noteTop - 140 + 'px';
                    }

                    this.notePopup.style.left =
                        (targetRect.x / main.zoom + (0.5 * targetRect.width) / main.zoom - pageRect.x / main.zoom) /
                            scale +
                        'px';

                    this.noteInput.value = note.text || '';

                    this.noteInput.dataset.note = note.id;
                    this.activeNote = note;
                    if (note.readonly) {
                        this.disableNoteEdit();
                    } else {
                        this.enableNoteEdit();
                    }
                },

                enableNoteEdit: function () {
                    this.noteDelete.style.display = 'block';
                    this.noteInput.readOnly = false;
                },

                disableNoteEdit: function () {
                    this.noteDelete.style.display = 'none';
                    this.noteInput.readOnly = true;
                },

                hideNote: function () {
                    if (this.notePopup.parentNode) {
                        this.notePopup.parentNode.removeChild(this.notePopup);
                    }
                    this.activeNote = null;
                },

                createNote: function () {
                    this.textSelectionRect.appendChild(this.notePopup);
                    this.notePopup.style.left = '50%';
                    if (this.textSelectionRect.offsetTop < 150) {
                        this.notePopup.style.top = '40px';
                    } else {
                        this.notePopup.style.top = '-140px';
                    }
                    this.noteInput.value = '';
                    this.noteInput.focus();
                    const note = {
                        selectedText: this.selectedTextString,
                        page: this.selectedTextPageNumber,
                        type: 1,
                    };
                    this.notes.push(note);
                    this.addPageNote(note);
                    this.noteInput.dataset.note = note.id;
                    this.addPageNoteListeners(this.main.options.pages[note.page - 1]);
                    this.activeNote = note;
                    this.enableNoteEdit();
                    this.main.trigger('r3d-update-note', { note: note });
                },

                deleteNote: function () {
                    const page = this.main.options.pages[this.activeNote.page - 1];
                    const $htmlContent = jQuery(page.htmlContent);
                    const $textLayer = $htmlContent.find('.flipbook-textLayer');
                    $textLayer.unmark({
                        className: `flipbook-note-${this.activeNote.id}`,
                    });
                    const index = this.notes.indexOf(this.activeNote);
                    if (index > -1) {
                        this.notes.splice(index, 1);
                    }
                    this.hideNote();
                    this.main.trigger('r3d-delete-note', {
                        note: this.activeNote,
                    });
                },

                getNoteById: function (id) {
                    let toReturn = null;
                    this.notes.forEach(function (note) {
                        if (Number(note.id) == Number(id)) {
                            toReturn = note;
                        }
                    });
                    return toReturn;
                },

                removeTextRect: function () {
                    if (this.textSelectionRect.parentNode) {
                        this.textSelectionRect.parentNode.removeChild(this.textSelectionRect);
                    }
                },

                addPageNoteListeners: function (page) {
                    const self = this;

                    if (!page.textLayerDiv || page.notesInitialized) {
                        return;
                    }

                    page.textLayerDiv.addEventListener('mouseup', function (e) {
                        if (e.target.classList.contains('add-note-btn')) {
                            return;
                        }

                        self.hideNote();
                        self.showButton();

                        self.selectedText = window.getSelection();
                        if (self.selectedText.toString()) {
                            self.selectedTextString = self.selectedText.toString();
                            self.selectedTextPageNumber = Number(this.dataset.pageNumber);
                            self.selectedTextRange = self.selectedText.getRangeAt(0);

                            const rect = self.selectedTextRange.getBoundingClientRect();
                            const pageRect = this.getBoundingClientRect();
                            const main = self.main;
                            let scale = (main.Book.sc * main.wrapperH) / 1000;
                            self.textSelectionRect.style.top =
                                (rect.y / main.zoom - pageRect.y / main.zoom) / scale + 'px';
                            self.textSelectionRect.style.left =
                                (rect.x / main.zoom - pageRect.x / main.zoom) / scale + 'px';
                            self.textSelectionRect.style.width = rect.width / main.zoom / scale + 'px';
                            self.textSelectionRect.style.height = rect.height / main.zoom / scale + 'px';
                            this.appendChild(self.textSelectionRect);
                        } else {
                            self.removeTextRect();
                        }
                    });

                    page.textLayerDiv.addEventListener('mousemove', function (e) {
                        if (self.selectedTextRange && self.selectedText.toString()) {
                            const textSelectionRect = self.textSelectionRect.getBoundingClientRect();
                            const btnRect = self.textSelectionRect.firstChild.getBoundingClientRect();
                            if (
                                e.clientX >= textSelectionRect.left &&
                                e.clientX <= textSelectionRect.right &&
                                e.clientY >= btnRect.top &&
                                e.clientY <= textSelectionRect.bottom
                            ) {
                                self.showButton();
                            } else {
                                self.hideButton();
                            }
                        }
                    });

                    page.notesInitialized = true;
                },
            };
        }

        {
            FLIPBOOK.Tooltip = function () {
                this.domElement = document.createElement('div');
                this.domElement.style.display = 'none';
                this.domElement.className = 'flipbook-tooltip flipbook-noselect';
                const self = this;
                this.currentPosition = { x: 0, y: 0 };
                document.addEventListener('scroll', function () {
                    self.position();
                });
            };

            FLIPBOOK.Tooltip.prototype = {
                show: function (params) {
                    if (!this.showing) {
                        this.domElement.style.display = 'block';
                        this.showing = true;

                        if (params.text) {
                            this.domElement.innerText = params.text;
                        }
                        if (params.parent) {
                            params.parent.appendChild(this.domElement);
                        }
                        if (params.onClick) {
                            this.domElement.style.cursor = 'pointer';
                            this.domElement.onclick = params.onClick;
                        } else {
                            this.domElement.style.cursor = 'auto';
                            this.domElement.removeAttribute('onclick');
                        }
                        this.currentPosition = params.position;
                        this.position();
                    }
                },
                hide: function () {
                    if (this.showing) {
                        this.domElement.style.display = 'none';
                        this.showing = false;
                    }
                },
                position: function () {
                    const wrapperRect = this.domElement.parentNode.getBoundingClientRect();
                    this.domElement.style.top = this.currentPosition.y - wrapperRect.top - scrollY + 'px';
                    this.domElement.style.left = this.currentPosition.x - wrapperRect.left - scrollX + 'px';
                },
            };
        }

        
        {
            FLIPBOOK.Thumbnails = function (main) {
                var self = this;
                var options = main.options;
                var wrapper = main.wrapper;

                this.main = main;
                this.options = options;
                this.wrapper = wrapper;
                this.active = null;

                jQuery(main).bind('pagechange', function () {
                    self.updateWrapperHeight();
                });

                this.thumbHolder = jQuery(document.createElement('div'))
                    .addClass('flipbook-thumbHolder flipbook-side-menu skin-color-bg')
                    .appendTo(wrapper)
                    .css(this.options.sideMenuPosition, '0')
                    .hide();

                this.thumbsWrapper = jQuery(document.createElement('div'))
                    .appendTo(this.thumbHolder)
                    .addClass('flipbook-thumbsWrapper');

                this.thumbsScroller = jQuery(document.createElement('div'))
                    .appendTo(this.thumbsWrapper)
                    .addClass('flipbook-thumbsScroller');

                main.createMenuHeader(this.thumbHolder, main.strings.thumbnails, main.toggleThumbs);

                this.bookmark = jQuery('<div>').addClass('flipbook-font').appendTo(this.thumbHolder).hide();

                // current
                jQuery(
                    '<a><div class="c-p skin-color flipbook-btn">' + options.strings.bookmarkCurrentPage + '</div></a>'
                )
                    .appendTo(this.bookmark)
                    .bind('touchend click', function (e) {
                        main.bookmarkPage(main.cPage[0], this);
                        e.preventDefault();
                        e.stopPropagation();
                    });

                // left
                jQuery(
                    '<a><div class="c-l-p skin-color flipbook-btn">' + options.strings.bookmarkLeftPage + '</div></a>'
                )
                    .appendTo(this.bookmark)
                    .bind('touchend click', function (e) {
                        main.bookmarkPage(main.cPage[0], this);
                        e.preventDefault();
                        e.stopPropagation();
                    });

                // right
                jQuery(
                    '<a><div class="c-r-p skin-color flipbook-btn">' + options.strings.bookmarkRightPage + '</div></a>'
                )
                    .appendTo(this.bookmark)
                    .bind('touchend click', function (e) {
                        main.bookmarkPage(main.cPage[1], this);
                        e.preventDefault();
                        e.stopPropagation();
                    });

                this.search = jQuery('<div>').addClass('flipbook-search').appendTo(this.thumbHolder).hide();

                this.$searchBar = jQuery(
                    '<div class="flipbook-findbar" id="findbar" deluminate_imagetype="png">' +
                        '<div id="findbarInputContainer">' +
                        '<input id="findInput" class="toolbarField" title="Find" autocapitalize="none" placeholder="' +
                        options.strings.findInDocument +
                        '...">' +
                        '</div>' +
                        '<div class="flipbook-find-info skin-color"/>' +
                        '</div>'
                ).appendTo(this.search);

                var searchTimeout = 0;

                this.$findInput = this.$searchBar.find('#findInput').on('keyup', function () {
                    var str = this.value;

                    clearTimeout(searchTimeout); // <- STRANGE TECH: TIMEOUT CLEARED

                    searchTimeout = setTimeout(
                        // <- STRANGE TECH: TIMEOUT SET
                        function (str) {
                            if (str != '') {
                                var main = self.main;
                                var pdfService = main.pdfService;
                                var options = main.options;
                                var matchesFound = 0;

                                self.hideAllThumbs();
                                self.clearSearchResults();
                                self.pagesFound = 0;
                                self.$findInfo.hide();
                                main.unmark();
                                main.searchingString = str;

                                self.$findInfo.show().text(options.strings.noMatches);

                                if (pdfService) {
                                    for (var i = 0; i < pdfService.pdfInfo.numPages; i++) {
                                        pdfService.findInPage(str, i, function (matches, htmlContent, index, pageText) {
                                            if (matches.length > 0) {
                                                self.pagesFound++;
                                                matchesFound += matches.length;
                                                self.$findInfo
                                                    .show()
                                                    .text(matchesFound + ' ' + options.strings.matchesFound);
                                                self.main.mark(str);
                                                self.showSearchResults(matches, index, pageText);
                                            }
                                        });
                                    }
                                } else {
                                    options.pagesOriginal.forEach((_, index) => {
                                        var pi = index;
                                        if (options.doublePage) {
                                            pi *= 2;
                                        }
                                        if (options.doublePage && pi == options.pagesOriginal.length * 2 - 2) {
                                            pi--;
                                        }
                                        main.loadPageHTML(pi, function (htmlContent, index) {
                                            var matches = htmlContent.innerText
                                                .toUpperCase()
                                                .search(main.searchingString.toUpperCase());
                                            if (matches > 0) {
                                                if (options.doublePage) {
                                                    index /= 2;
                                                }
                                                self.showThumb(index);
                                                self.pagesFound++;
                                                self.$findInfo
                                                    .show()
                                                    .text(
                                                        self.pagesFound +
                                                            ' ' +
                                                            options.strings.pagesFoundContaining +
                                                            ' "' +
                                                            str +
                                                            '"'
                                                    );
                                                self.main.mark(str);
                                            }
                                            if (self.pagesFound == 0) {
                                                self.$findInfo.show().text(options.strings.noMatches);
                                            }
                                        });
                                    });
                                }
                            } else {
                                self.hideAllThumbs();
                                self.clearSearchResults();
                                self.$findInfo.hide();
                                self.main.unmark();
                                self.main.searchingString = str;
                            }
                        },
                        700,
                        str
                    );
                });

                this.$findInfo = this.$searchBar.find('.flipbook-find-info');

                this.thumbs = [];

                var arr2 = options.pages;

                var arr = [];

                if (options.doublePage) {
                    for (var i = 0; i < arr2.length; i++) {
                        if (i == 0 || i % 2 != 0) {
                            arr.push(arr2[i]);
                        }
                    }
                } else {
                    arr = arr2;
                }

                if (options.pdfMode) {
                    this.loadThumbsFromPdf(arr);
                }

                var h = options.thumbSize;
                var w = (options.thumbSize * options.pageWidth) / options.pageHeight;

                arr.forEach((item, i) => {
                    var th = item.thumb;

                    if (item.empty) {
                        return;
                    }

                    var $thumb = jQuery('<div>')
                        .addClass('flipbook-thumb')
                        .appendTo(self.thumbsScroller)
                        .attr('data-thumb-index', i)
                        .width(w)
                        .height(h);

                    var btnClose = jQuery('<span>')
                        .appendTo($thumb)
                        .addClass('thumb-btn-close')
                        .bind('touchend click', function (e) {
                            e.stopPropagation();
                            e.preventDefault();
                            main.removeBookmark(jQuery(this).parent().attr('data-thumb-index'));
                        });

                    jQuery('<span>')
                        .attr('aria-hidden', 'true')
                        .appendTo(btnClose)
                        .addClass('flipbook-icon-times skin-color');

                    this.thumbs.push($thumb);

                    var $thumbImg;
                    if (item.thumbCanvas) {
                        $thumbImg = jQuery(item.thumbCanvas);
                    } else if (th) {
                        $thumbImg = jQuery('<img/>').attr('src', th);
                        $thumbImg[0].onload = function () {
                            self.thumbScroll.refresh();
                        };
                    } else {
                        return;
                    }

                    $thumbImg.appendTo($thumb);
                    jQuery('<br/>').appendTo($thumb);

                    var hasBackCover = options.doublePage && options.pages.length % 2 == 0;
                    var isBackCover = hasBackCover && i == arr.length - 1;
                    var isCover = options.doublePage && i == 0;
                    var isDouble = options.doublePage && !isCover && !isBackCover;

                    if (isBackCover) {
                        $thumbImg
                            .height(h)
                            .width(w)
                            .attr('page-title', 2 * i);

                        jQuery(document.createElement('span'))
                            .text(String(2 * i))
                            .appendTo($thumb)
                            .addClass('skin-color')
                            .addClass('flipbook-thumb-num');
                    } else if (isDouble) {
                        $thumb.width(2 * w);

                        $thumbImg
                            .height(h)
                            .width(2 * w)
                            .attr('page-title', 2 * i + 1);

                        jQuery(document.createElement('span'))
                            .text(String(2 * i) + '-' + String(2 * i + 1))
                            .appendTo($thumb)
                            .addClass('skin-color')
                            .addClass('flipbook-thumb-num');
                    } else {
                        $thumbImg
                            .height(h)
                            .width(w)
                            .attr('page-title', i + 1);

                        var title = String(i + 1);
                        if (this.options.pages[i] && this.options.pages[i].title) {
                            title = this.options.pages[i].title;
                        }

                        jQuery(document.createElement('span'))
                            .text(title)
                            .appendTo($thumb)
                            .addClass('skin-color')
                            .addClass('flipbook-thumb-num');
                    }

                    $thumbImg.bind('touchend click', function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        if (!self.thumbScroll.moved) {
                            var clickedPage = Number(jQuery(this).attr('page-title'));
                            if (options.rightToLeft) {
                                clickedPage = options.pages.length - clickedPage + 1;
                            }

                            setTimeout(function () {
                                main.goToPage(clickedPage);
                            }, 200);

                            if (self.active != 'search' && options.thumbsCloseOnClick) {
                                main.toggleThumbs(false);
                            }
                        }
                    });
                });

                this.thumbScroll = new FLIPBOOK.IScroll(this.thumbsWrapper[0], {
                    bounce: false,
                    mouseWheel: true,
                    scrollbars: true,
                    interactiveScrollbars: true,
                });

                main.initColors();
            };

            
            FLIPBOOK.Thumbnails.prototype = {
                loadThumbsFromPdf: function (arr) {
                    var pdf = this.main.pdfDocument;
                    var info = pdf._pdfInfo;
                    var numPages = info.numPages;

                    for (var i = 0; i < numPages; i++) {
                        var c = document.createElement('canvas');
                        arr[i].thumbCanvas = c;
                    }

                    this.loadThumbFromPdf(0, arr);
                },

                loadVisibleThumbs: function () {},

                loadThumbFromPdf: function (i, arr) {
                    var self = this;

                    this.main.pdfDocument.getPage(i + 1).then(function (page) {
                        var v = page.getViewport({ scale: 1 });

                        var scale = self.options.thumbSize / v.height;

                        var viewport = page.getViewport({ scale: scale });

                        var c = arr[page._pageIndex].thumbCanvas;
                        var context = c.getContext('2d');
                        c.height = viewport.height;
                        c.width = viewport.width;

                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport,
                        };

                        page.cleanupAfterRender = true;

                        var renderTask = page.render(renderContext);
                        renderTask.promise.then(function () {
                            page.cleanup();
                            if (page._pageIndex + 1 < self.main.pdfDocument._pdfInfo.numPages) {
                                self.loadThumbFromPdf(page._pageIndex + 1, arr);
                            }
                        });
                        self.thumbScroll.refresh();
                    });
                },

                showAllThumbs: function () {
                    jQuery('.flipbook-thumb').show();
                    this.clearSearchResults();
                    this.thumbScroll.refresh();
                },

                hideAllThumbs: function () {
                    jQuery('.flipbook-thumb').hide();
                    this.thumbScroll.refresh();
                },

                clearSearchResults: function () {
                    jQuery('.flipbook-search-match').remove();
                    this.thumbScroll.refresh();
                },

                showSearchResults: function (matches, pageIndex, str) {
                    var self = this;

                    var num = matches.length;
                    var pageNumber = Number(pageIndex + 1);

                    jQuery(
                        '<div data-page="' +
                            pageNumber +
                            '" style="order: ' +
                            pageIndex +
                            '" class="flipbook-search-match"><div class="flipbook-search-match-title">' +
                            '<span style="float:left;"><strong>Page ' +
                            pageNumber +
                            '</strong></span><span style="float:right;">' +
                            num +
                            ' matches</span></div><div class="flipbook-search-match-text">' +
                            str +
                            '</div></div>'
                    )
                        .appendTo(self.thumbsScroller)
                        .bind('tap click', function (e) {
                            e.stopPropagation();
                            e.preventDefault();
                            self.main.goToPage(this.dataset.page);
                        });

                    this.updateWrapperHeight();
                    this.thumbScroll.refresh();
                },

                showThumb: function (index) {
                    if (this.thumbs[index]) {
                        this.thumbs[index].show();
                    }
                    this.thumbScroll.refresh();
                },

                hideThumb: function (index) {
                    this.thumbs[index].hide();
                    this.thumbScroll.refresh();
                },

                showBookmarks: function () {
                    jQuery('.thumb-btn-close').show();
                    this.showBookmarkedThumbs();
                    this.clearSearchResults();
                    this.bookmark.show();
                    this.setTitle(this.options.strings.bookmarks);
                    this.main.updateCurrentPage();
                    this.active = 'bookmarks';
                    this.updateWrapperHeight();
                },

                showSearch: function () {
                    this.clearSearchResults();
                    this.hideAllThumbs();
                    this.search.show();
                    this.$findInfo.hide();
                    jQuery('.thumb-btn-close').hide();
                    this.setTitle(this.options.strings.search);
                    this.$findInput.val('').focus();
                    this.active = 'search';
                    this.updateWrapperHeight();
                },

                showBookmarkedThumbs: function () {
                    var arr = this.main.getBookmarkedPages();

                    this.hideAllThumbs();

                    for (var i = 0; i < arr.length; i++) {
                        var index = arr[i];
                        if (index) {
                            this.showThumb(index);
                        }
                    }

                    this.updateWrapperHeight();
                },

                updateWrapperHeight: function () {
                    var top = 50;
                    if (this.active == 'bookmarks') {
                        top += this.bookmark.height();
                    } else if (this.active == 'search') {
                        top += this.search.height();
                    }

                    this.thumbsWrapper.css('top', top + 'px');
                },

                show: function () {
                    this.setTitle(this.options.strings.thumbnails);
                    this.bookmark.hide();
                    this.search.hide();
                    this.thumbHolder.show();
                    this.main.thumbsVertical();

                    this.thumbsWrapper.css('top', '50px');
                    this.showAllThumbs();
                    jQuery('.thumb-btn-close').hide();
                    this.loadVisibleThumbs();
                    this.main.resize();
                    this.active = 'thumbs';
                },

                hide: function () {
                    this.thumbHolder.hide();

                    this.main.resize();
                    this.active = null;
                },

                setTitle: function (str) {
                    this.thumbHolder.find('.flipbook-menu-title').text(str);
                },
            };
        }
        

        {
            FLIPBOOK.Lightbox = function (context, content, options) {
                var self = this;
                this.context = context;
                this.options = options;

                this.$document = jQuery('document');
                this.$body = jQuery('body');
                this.$html = jQuery('html');
                this.$window = jQuery('window');

                context.$elem.bind('tap click', function (e) {
                    if (content.disposed) {
                        return;
                    }

                    self.openLightbox();
                    e.stopPropagation();

                    return false;
                });

                self.overlay = jQuery(document.createElement('div'))
                    .attr('style', options.lightboxCSS)
                    .addClass('flipbook-overlay')
                    .css('display', 'none')
                    .css('top', self.options.lightboxMarginV)
                    .css('bottom', self.options.lightboxMarginV)
                    .css('left', self.options.lightboxMarginH)
                    .css('right', self.options.lightboxMarginH)
                    .appendTo('body');

                if (self.options.lightboxCloseOnClick) {
                    jQuery('body').bind('tap click', function (e) {
                        var $target = jQuery(e.target);
                        if (
                            !$target.parents().hasClass('flipbook-overlay') ||
                            $target.hasClass('flipbook-bookLayer') ||
                            $target.hasClass('flipbook-carousel-slide')
                        ) {
                            self.closeLightbox();
                        }
                    });
                }

                if (options.lightboxBackground) {
                    self.overlay.css('background', options.lightboxBackground);
                }

                if (options.lightboxBackgroundColor) {
                    self.overlay.css('background', options.lightboxBackgroundColor);
                }

                if (options.lightboxBackgroundPattern) {
                    self.overlay.css('background', 'url(' + options.lightboxBackgroundPattern + ') repeat');
                }

                if (options.lightboxBackgroundImage) {
                    self.overlay.css('background', 'url(' + options.lightboxBackgroundImage + ') no-repeat');
                    self.overlay.css('background-size', 'cover');
                    self.overlay.css('background-position', 'center center');
                }

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        self.closeLightbox();
                    }
                });

                self.wrapper = jQuery(document.createElement('div')).css('height', 'auto').appendTo(self.overlay);

                self.wrapper
                    .attr('class', 'flipbook-wrapper-transparent')
                    .css('margin', '0px auto')
                    .css('padding', '0px')
                    .css('height', '100%')
                    .css('width', '100%');

                content.appendTo(self.wrapper);

                jQuery('<div/>').appendTo(self.wrapper).addClass('flipbook-lightbox-toolbar');
            };

            FLIPBOOK.Lightbox.prototype = {
                openLightbox: function () {
                    if (FLIPBOOK.lightboxOpened) {
                        return;
                    }

                    FLIPBOOK.lightboxOpened = true;
                    this.overlay.css('display', 'none');
                    this.overlay.fadeIn('slow');
                    this.$body.addClass('flipbook-overflow-hidden');
                    this.$html.addClass('flipbook-overflow-hidden');
                    this.$window.trigger('r3d-lightboxopen');
                    if (!this.options.deeplinkingEnabled) {
                        window.history.pushState(null, '', window.location.href);
                    }
                    if (this.context.options.password && !this.context.pdfinitStarted && this.context.initialized) {
                        this.context.initPdf();
                    }
                },

                closeLightbox: function (popState) {
                    if (!FLIPBOOK.lightboxOpened || !this.context.Book || !this.context.Book.enabled) {
                        return;
                    }

                    FLIPBOOK.lightboxOpened = false;
                    this.overlay.fadeOut('fast');
                    this.$body.removeClass('flipbook-overflow-hidden');
                    this.$html.removeClass('flipbook-overflow-hidden');
                    this.$window.trigger('r3d-lightboxclose');
                    this.context.trigger('lightboxclose');
                    jQuery(this.context.fullscreenElement).removeClass('flipbook-browser-fullscreen');

                    this.context.lightboxEnd();

                    if (!popState && !this.options.deeplinkingEnabled) {
                        history.back();
                    }
                },
            };
        }
    })(jQuery, window, document);
}

{
    FLIPBOOK.onPageLinkClick = function (link) {
        var id = link.dataset.bookid;
        var page = link.dataset.page;
        if (page) {
            FLIPBOOK.books[id].goToPage(Number(page));
        }
        var _url = link.dataset.url;
        if (_url) {
            window.open(_url, '_blank');
        }
    };
}

FLIPBOOK.easings = {
    easeInQuad: function (t) {
        return t * t;
    },
    easeOutQuad: function (t) {
        return t * (2 - t);
    },
    easeInOutQuad: function (t) {
        return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
    },
    easeInSine: function (t) {
        return 1 - Math.cos((t * Math.PI) / 2);
    },
    easeOutSine: function (t) {
        return Math.sin((t * Math.PI) / 2);
    },
    easeInOutSine: function (t) {
        return -(Math.cos(Math.PI * t) - 1) / 2;
    },
};

FLIPBOOK.animate = function ({ from, to, delay, duration, easing = 'easeOutQuad', step, complete }) {
    const startTime = performance.now();
    function animationFrame(time) {
        const elapsed = time - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const now = from + (to - from) * FLIPBOOK.easings[easing](progress);

        step(now);

        if (progress < 1) {
            requestAnimationFrame(animationFrame);
        } else {
            complete();
        }
    }

    if (delay) {
        setTimeout(() => {
            requestAnimationFrame(animationFrame);
        }, delay);
    } else {
        requestAnimationFrame(animationFrame);
    }
};
