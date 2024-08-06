(function () {

	// Function to get URL parameter value by name
	function getParameterByName(name) {
		var url = window.location.href;
		name = name.replace(/[[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	// Get the PDF URL parameter value
	var pdfUrlParam = getParameterByName('pdfUrl');

	// Get the conversion settings from URL parameters
	var imageQualityParam = getParameterByName('imageQuality');
	var pageHeightParam = getParameterByName('pageHeight');
	var thumbnailHeightParam = getParameterByName('thumbnailHeight');
	var imageTypeParam = getParameterByName('imageType');

	

	// Set the conversion settings
	var imageQualityInput = document.getElementById('imageQuality');
	var pageHeightInput = document.getElementById('pageHeight');
	var thumbnailHeightInput = document.getElementById('thumbnailHeight');
	var imageTypeInput = document.getElementById('imageType');
	
	const chunkSize = 25; // Set your desired chunk size
	var chunkCounter = 0; // Set your desired chunk size

	if (imageQualityParam) {
		imageQualityInput.value = imageQualityParam;
	}

	if (pageHeightParam) {
		pageHeightInput.value = pageHeightParam;
	}

	if (thumbnailHeightParam) {
		thumbnailHeightInput.value = thumbnailHeightParam;
	}

	if (imageTypeParam) {
		imageTypeInput.value = imageTypeParam;
	}


	var uploadContainer = document.getElementById('uploadContainer');
	var dropContainer = document.getElementById('dropContainer');
	var dropMessage = document.getElementById('dropMessage');
	var browseButton = document.getElementById('browseButton');
	var progressBar = document.getElementById('progressBar');
	var progressMessage = document.getElementById('progressMessage');
	var downloadContainer = document.getElementById('downloadContainer');
	var downloadButton = document.getElementById('downloadButton');
	var pdfData;

	var imageQualityInput = document.getElementById('imageQuality');
	var imageQualityValue = document.getElementById('imageQualityValue');
	var pageHeightInput = document.getElementById('pageHeight');
	var thumbnailHeightInput = document.getElementById('thumbnailHeight');
	var imageTypeInput = document.getElementById('imageType');

	var eventBus = new EventBus()

	var linkService = new PDFLinkService({
		eventBus: eventBus
	});

	// Set the PDF URL
	if (pdfUrlParam) {
		// Start the conversion process with the provided PDF URL
		convertFromUrl(pdfUrlParam);
	}

	imageQualityInput.addEventListener('input', function () {
		imageQualityValue.textContent = imageQualityInput.value;
	});

	browseButton.addEventListener('click', function (event) {
		event.preventDefault(); // Prevent default click behavior
		var fileInput = document.getElementById('pdfFile');
		fileInput.click();
	});

	document.getElementById('pdfFile').addEventListener('change', function (event) {
		handleFileUpload(event.target.files[0]);
	});

	dropContainer.addEventListener('dragenter', function (event) {
		event.preventDefault();
		dropContainer.classList.add('drag-over');
	});

	dropContainer.addEventListener('dragover', function (event) {
		event.preventDefault();
	});

	dropContainer.addEventListener('dragleave', function (event) {
		event.preventDefault();
		dropContainer.classList.remove('drag-over');
	});

	dropContainer.addEventListener('drop', function (event) {
		event.preventDefault();
		dropContainer.classList.remove('drag-over');
		handleFileUpload(event.dataTransfer.files[0]);
	});

	// Update the click event for the "Convert" button
	document.getElementById('convertButton').addEventListener('click', function () {
		var pdfUrl = document.getElementById('pdfUrlInput').value;
		if (pdfUrl) {
			convertFromUrl(pdfUrl);
		}
	});
	


	// Function to convert the PDF from URL
	async function convertFromUrl(pdfUrl) {
		resetUI();

		try {
			// Fetch the PDF file from the URL
			var response = await fetch(pdfUrl);
			
			if (!response.ok) {
                throw new Error(`Failed to fetch PDF. Status: ${response.status}`);
            }
    
            const contentLength = parseInt(response.headers.get('content-length'), 10);
            let loaded = 0;
    
            // Create an array to accumulate the loaded data
            const chunks = [];
    
            const reader = response.body.getReader();
    
            // Read chunks of data and update progress
            while (true) {
                const { done, value } = await reader.read();
    
                if (done) {
                    break;
                }
    
                loaded += value.length;
                var progress = Math.round((loaded / contentLength) * 100);
                progressBar.style.width = progress + '%';
            	progressMessage.textContent = 'Fetching your online album...'+progress+'%';
    
                // Append the chunk to the array
                chunks.push(value);
            }
    
            // Combine the loaded chunks into a single ArrayBuffer
            const pdfData = new Uint8Array(loaded);
            let offset = 0;
            chunks.forEach(chunk => {
                pdfData.set(chunk, offset);
                offset += chunk.length;
            });
    
            const fileName = pdfUrl.substring(pdfUrl.lastIndexOf('/') + 1);
            const file = new File([pdfData.buffer], fileName);
    
            // Handle the file upload
            handleFileUpload(file);
			
			
// 			var pdfData = await response.arrayBuffer();

// 			// Get the file name from the URL
// 			var fileName = pdfUrl.substring(pdfUrl.lastIndexOf('/') + 1);

// 			// Create a File object with the PDF data and name
// 			var file = new File([pdfData], fileName);

// 			// Handle the file upload
// 			handleFileUpload(file);
		} catch (error) {
			console.error('Error loading PDF:', error);
		}
	}

	// Rest of your existing code...


	function createBlobFromCanvas(canvas, type, quality) {
		return new Promise((resolve) => {
			if (typeof OffscreenCanvas !== 'undefined') {
				canvas.convertToBlob({ type: type, quality: quality }).then(resolve);
			} else {
				canvas.toBlob(resolve, type, quality);
			}
		});
	}

	async function handleFileUpload(file) {
		resetUI();

		var reader = new FileReader();

		reader.onloadstart = function () {
			progressBar.style.width = '0%';
			progressMessage.textContent = 'Loading your online album...';
		};

		reader.onprogress = function (event) {
			if (event.lengthComputable) {
				var progress = (event.loaded / event.total) * 100;
				// progressBar.style.width = progress + '%';
				progressMessage.textContent = 'Loading your online album...';
			}
		};

		reader.onload = async function (event) {
// 			progressBar.style.width = '100%';
			progressBar.classList.add('complete');
			progressMessage.textContent = 'Loading your online album...';
			pdfData = new Uint8Array(event.target.result);
			showDownloadButton(file);
		};

		reader.readAsArrayBuffer(file);
	}

	function createCanvas() {
		if (typeof OffscreenCanvas !== 'undefined') {
			return new OffscreenCanvas(1, 1);
		} else {
			return document.createElement('canvas');
		}
	}
	
	async function renderPdfInChunks(pdf, folder, folderName, numPages, zip, file, chunkSize) {
        let currentPage = 1;
    
        while (currentPage <= numPages) {
            const endPage = Math.min(currentPage + chunkSize - 1, numPages);
            chunkCounter = chunkCounter + 1;
    
            await renderPageChunk(pdf, folder, folderName, currentPage, endPage, zip, file, numPages);
    
            currentPage += chunkSize;
        }
    }
    
    async function renderPageChunk(pdf, folder, folderName, startPage, endPage, zip, file, numPages) {
        for (let currentPage = startPage; currentPage <= endPage; currentPage++) {
            // Existing code for rendering a single page
            const page = await pdf.getPage(currentPage);
            var canvas = await createCanvas();
            var context = canvas.getContext('2d');
    
            var viewport = page.getViewport({ scale: 1 });
            var imageHeight = pageHeightInput.value;
    
            	var canvas = createCanvas();
        		var context = canvas.getContext('2d');
        
        		var viewport = page.getViewport({ scale: 1 });
        
        		// Set the desired height for the image
        		var imageHeight = pageHeightInput.value;
        
        		// Calculate the scale factor based on the desired height
        		var imageScale = imageHeight / viewport.height;
        		var imageAspect = viewport.width / viewport.height;
        
        		// Calculate the actual width and height based on the scale factor
        		var imageWidth = imageHeight * imageAspect
        
        		// Set the canvas dimensions based on the actual width and height
        		canvas.width = imageWidth;
        		canvas.height = imageHeight;
        
        		// Update the viewport with the new scale
        		viewport = page.getViewport({ scale: imageScale });
        
        		await page.render({ canvasContext: context, viewport: viewport }).promise;
        
        		var type = imageTypeInput.value;
        		var extension = '.' + type.split('/')[1];
        
        		const quality = imageQualityInput.value;
        		var blobFullSize = await createBlobFromCanvas(canvas, type, quality);
        		folder.file(currentPage.toString() + extension, blobFullSize, { type: type });
        
        		// Create thumbnail image
        		var thumbnailCanvas = createCanvas();
        		var thumbnailContext = thumbnailCanvas.getContext('2d');
        
        		var thumbnailHeight = thumbnailHeightInput.value;
        		var thumbnailWidth = imageAspect * thumbnailHeight;
        		var thumbnailScale = thumbnailHeight / page.getViewport({ scale: 1 }).height;
        		thumbnailCanvas.width = thumbnailWidth;
        		thumbnailCanvas.height = thumbnailHeight;
        
        		viewport = page.getViewport({ scale: thumbnailScale });
        
        		await page.render({ canvasContext: thumbnailContext, viewport: viewport }).promise;
        
        		// Create thumbnail image blob
        		var blobThumbnail = await createBlobFromCanvas(thumbnailCanvas, type, quality);
        		folder.file('thumb' + currentPage.toString() + extension, blobThumbnail, { type: type });
        
        		// Create thumbnail element
        		var thumbnailElement = document.createElement('img');
        		thumbnailElement.src = URL.createObjectURL(blobThumbnail);
        		thumbnailElement.classList.add('thumbnail');
        
        		// Append thumbnail to the container
        		thumbnailsContainer.appendChild(thumbnailElement);
        
        
        		// create html content div
        		const htmlContent = document.createElement('div')
        
        		await loadAndRenderTextLayerAndAnnotations(pdf, page, htmlContent)
        
        		// Convert htmlContent to JSON with URI-encoded innerHTML
        		const htmlContentJSON = JSON.stringify({ data: encodeURIComponent(htmlContent.innerHTML) });
        
        		// Create a Blob from the JSON data
        		const jsonBlob = new Blob([htmlContentJSON], { type: 'application/json' });
        
        		// Add the JSON file to the folder in the zip
        		folder.file(currentPage.toString() + '.json', jsonBlob);
        	
        		var perPercentage = Math.round(((currentPage) / (numPages) * 100));
        		
        		
        		console.log(chunkCounter+" "+currentPage+" "+perPercentage);
        		
        
    
            progressBar.style.width = perPercentage + '%';
            progressMessage.textContent = 'Loading your online album...' + perPercentage + '%';
        }
    
        // Handle the completion of the chunk
        if (endPage === numPages) {
            // Generate the book or perform any final actions
            generateBook();
            // You may also handle the zip generation here if needed
        }
    }



	async function renderPage(pdf, page, folder, folderName, currentPage, numPages, zip, file ,chunkSize ) {
	    console.log(chunkSize);
	    await renderPdfInChunks(pdf, folder, folderName, numPages, zip, file, chunkSize);
	    return false;
	    
	    
	    
		var canvas = createCanvas();
		var context = canvas.getContext('2d');

		var viewport = page.getViewport({ scale: 1 });

		// Set the desired height for the image
		var imageHeight = pageHeightInput.value;

		// Calculate the scale factor based on the desired height
		var imageScale = imageHeight / viewport.height;
		var imageAspect = viewport.width / viewport.height;

		// Calculate the actual width and height based on the scale factor
		var imageWidth = imageHeight * imageAspect

		// Set the canvas dimensions based on the actual width and height
		canvas.width = imageWidth;
		canvas.height = imageHeight;

		// Update the viewport with the new scale
		viewport = page.getViewport({ scale: imageScale });

		await page.render({ canvasContext: context, viewport: viewport }).promise;

		var type = imageTypeInput.value;
		var extension = '.' + type.split('/')[1];

		const quality = imageQualityInput.value;
		var blobFullSize = await createBlobFromCanvas(canvas, type, quality);
		folder.file(currentPage.toString() + extension, blobFullSize, { type: type });

		// Create thumbnail image
		var thumbnailCanvas = createCanvas();
		var thumbnailContext = thumbnailCanvas.getContext('2d');

		var thumbnailHeight = thumbnailHeightInput.value;
		var thumbnailWidth = imageAspect * thumbnailHeight;
		var thumbnailScale = thumbnailHeight / page.getViewport({ scale: 1 }).height;
		thumbnailCanvas.width = thumbnailWidth;
		thumbnailCanvas.height = thumbnailHeight;

		viewport = page.getViewport({ scale: thumbnailScale });

		await page.render({ canvasContext: thumbnailContext, viewport: viewport }).promise;

		// Create thumbnail image blob
		var blobThumbnail = await createBlobFromCanvas(thumbnailCanvas, type, quality);
		folder.file('thumb' + currentPage.toString() + extension, blobThumbnail, { type: type });

		// Create thumbnail element
		var thumbnailElement = document.createElement('img');
		thumbnailElement.src = URL.createObjectURL(blobThumbnail);
		thumbnailElement.classList.add('thumbnail');

		// Append thumbnail to the container
		thumbnailsContainer.appendChild(thumbnailElement);


		// create html content div
		const htmlContent = document.createElement('div')

		await loadAndRenderTextLayerAndAnnotations(pdf, page, htmlContent)

		// Convert htmlContent to JSON with URI-encoded innerHTML
		const htmlContentJSON = JSON.stringify({ data: encodeURIComponent(htmlContent.innerHTML) });

		// Create a Blob from the JSON data
		const jsonBlob = new Blob([htmlContentJSON], { type: 'application/json' });

		// Add the JSON file to the folder in the zip
		folder.file(currentPage.toString() + '.json', jsonBlob);

		progressBar.style.width = ((currentPage / numPages) * 100) + '%';
		progressMessage.textContent = 'Loading your online album...' + Math.round(((currentPage / numPages) * 100)) + '%';

		currentPage++;

		if (currentPage <= numPages) {
			await pdf.getPage(currentPage).then((page) => renderPage(pdf, page, folder, folderName, currentPage, numPages, zip, file ,chunkSize ));
		} else {
// 			var content = await zip.generateAsync({ type: 'blob' }, function (metadata) {
// 				var progress = metadata.percent || 0;
// 				// progressBar.style.width = progress + '%';
// 				progressMessage.textContent = 'Loading your online album...100%';
// 			});
// 			var downloadURL = URL.createObjectURL(content);
// 			downloadButton.setAttribute('download', file.name.replace('.pdf', '') + '.zip');
// 			downloadButton.href = downloadURL;
// 			downloadContainer.style.display = 'block';
// 			progressMessage.textContent = 'Loading your online album...100%';
			
			generateBook();
			return false;
		}
	}



	async function showDownloadButton(file) {
		downloadContainer.style.display = 'none';

		var zip = new JSZip();
		var folderName = file.name.replace('.pdf', ''); // Get the folder name from the PDF file name
		var folder = zip.folder(folderName);

		var pdf = await pdfjsLib.getDocument(pdfData).promise;
		var numPages = pdf.numPages;
		var currentPage = 1;

		progressBar.style.width = '0%';
		progressMessage.textContent = 'Loading your online album...';

		await pdf.getPage(currentPage).then((page) => renderPage(pdf, page, folder, folderName, currentPage, numPages, zip, file, chunkSize));
	}

	async function loadAnnotationsAndTextContent(page) {
		const annotationsPromise = page.getAnnotations();
		const textContentPromise = page.getTextContent();

		const [annotations, textContent] = await Promise.all([annotationsPromise, textContentPromise]);

		return { annotations, textContent };
	}

	async function loadAndRenderTextLayerAndAnnotations(pdf, page, h) {
		const { annotations, textContent } = await loadAnnotationsAndTextContent(page);

		h.classList.add('flipbook-page-htmlContent');
		h.style.transformOrigin = '0 0';

		const pagePromises = [];

		if (textContent) {
			const textLayerDiv = document.createElement('div');
			textLayerDiv.className = 'flipbook-textLayer';
			h.appendChild(textLayerDiv);

			const scale = 1000 / page.getViewport({ scale: 1 }).height;
			textLayerDiv.style.width = String(1000 * page.getViewport({ scale: 1 }).width / page.getViewport({ scale: 1 }).height) + "px";
			textLayerDiv.style.height = "1000px";

			const textLayer = new TextLayerBuilder({
				eventBus: eventBus,
				textLayerDiv: textLayerDiv,
				pageIndex: page._pageIndex,
				viewport: page.getViewport({ scale: scale })
			});

			const textLayerRenderPromise = new Promise(function (resolve) {
				textLayer.eventBus.on('textlayerrendered', function (e) {
					page.textlayerrendered = true;
					resolve();
				});
			});

			pagePromises.push(textLayerRenderPromise);

			textLayer.setTextContent(textContent);
			textLayer.render();
		}

		if (annotations.length > 0) {
			const div = document.createElement('div');
			div.className = 'annotationLayer';
			h.appendChild(div);

			const parameters = {
				viewport: page.getViewport({ scale: 1000 / page.getViewport({ scale: 1 }).height }).clone({ dontFlip: true }),
				div: div,
				annotations: annotations,
				page: page,
				linkService: linkService
			};

			pdfjsLib.AnnotationLayer.render(parameters);

			annotations.forEach(function (annotation) {
				const annotationSection = h.querySelector('[data-annotation-id="' + annotation.id + '"]');
				const dest = annotation.dest;
				if (dest && annotationSection) {
					const annotationLink = annotationSection.firstChild;
					if (annotationLink) {
						annotationLink.href = "#";
						const processAnnotaionDestPromise = processAnnotaionDest(pdf, dest, annotationLink);
						pagePromises.push(processAnnotaionDestPromise);
					}
				}
			});
		}

		return Promise.all(pagePromises)
	}

	function processAnnotaionDest(pdf, dest, annotationLink) {
		return new Promise(function (resolve, reject) {
			const getDestinationPromise = typeof dest === 'string' ? pdf.getDestination(dest) : Promise.resolve(dest);

			getDestinationPromise.then(function (destArray) {
				if (!Array.isArray(destArray)) {
					console.error('PDFLinkService.navigateTo: "' + destArray + '" is' + (' not a valid destination array, for dest="' + dest + '".'));
					return;
				}

				const destRef = destArray[0];

				const getPageIndexPromise = pdf.getPageIndex(destRef);
				getPageIndexPromise.then(function (pageIndex) {
					annotationLink.dataset.page = pageIndex + 1;
					resolve();
				});
			});
		});
	}


	function resetUI() {
		downloadContainer.style.display = 'none';
		progressBar.style.width = '0%';
		progressBar.classList.remove('complete');
		progressMessage.textContent = '';
	}
})();


