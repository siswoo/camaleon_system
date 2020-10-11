// @link WebViewerInstance: https://www.pdftron.com/api/web/WebViewerInstance.html

// @link WebViewerInstance.enableElements: https://www.pdftron.com/api/web/WebViewerInstance.html#enableElements__anchor
// @link WebViewerInstance.enableFeatures: https://www.pdftron.com/api/web/WebViewerInstance.html#enableFeatures__anchor
// @link WebViewerInstance.selectThumbnailPages: https://www.pdftron.com/api/web/WebViewerInstance.html#selectThumbnailPages__anchor

// @link CoreControls: https://www.pdftron.com/api/web/CoreControls.html
// @link CoreControls.initPDFWorkerTransports: https://www.pdftron.com/api/web/CoreControls.html#.initPDFWorkerTransports__anchor

const viewers = [
  {
    initialDoc: 'https://pdftron.s3.amazonaws.com/downloads/pl/demo-annotated.pdf',
    domElement: 'leftPanel',
  },
  {
    initialDoc: 'https://pdftron.s3.amazonaws.com/downloads/pl/report.docx',
    domElement: 'rightPanel',
  },
];
let workerTransportPromise;

CoreControls.setWorkerPath('../../../lib/core');
CoreControls.getDefaultBackendType().then(pdfType => {
  workerTransportPromise = CoreControls.initPDFWorkerTransports(pdfType, {});

  initializeWebViewer(viewers[0]);
  initializeWebViewer(viewers[1]);
});

const initializeWebViewer = viewer => {
  WebViewer(
    {
      path: '../../../lib',
      // since there are two instance of WebViewer, use "workerTransportPromise" so viewers can share resources
      workerTransportPromise: {
        pdf: workerTransportPromise,
      },

      // set "useDownloader" to false to the either file is loaded
      useDownloader: false,

      // can load a office documents as PDFDocument by setting "loadAsPDF"
      loadAsPDF: true,

      initialDoc: viewer.initialDoc,
    },
    document.getElementById(`${viewer.domElement}`)
  ).then(instance => {
    const { docViewer } = instance;
    instance.enableFeatures(['ThumbnailMultiselect', 'MultipleViewerMerging']);
    instance.enableElements(['documentControl']);

    docViewer.on('documentLoaded', () => {
      instance.openElements(['thumbnailsPanel']);

      // select some pages
      instance.selectThumbnailPages([1]);
    });

    document.getElementById(`${viewer.domElement}`).addEventListener('documentMerged', data => {
      // can use "documentMerged" event to track what is being merged into a document
      console.log(`From: ${data.detail.filename} pages: ${data.detail.pages}`);
    });

    // set up controls on the left side bar
    document.getElementById(`${viewer.domElement}-select`).onchange = e => {
      instance.loadDocument(e.target.value);
    };

    document.getElementById(`${viewer.domElement}-file-picker`).onchange = e => {
      const file = e.target.files[0];

      if (file) {
        instance.loadDocument(file);
      }
    };

    document.getElementById(`${viewer.domElement}-url-form`).onsubmit = e => {
      e.preventDefault();
      instance.loadDocument(document.getElementById(`${viewer.domElement}-url`).value);
    };
  });
};
