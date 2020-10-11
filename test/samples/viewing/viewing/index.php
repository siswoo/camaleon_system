<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../style.css" />
    <script src="../../../lib/webviewer.min.js"></script>
    <script src="../../old-browser-checker.js"></script>
    <script src="../../global.js"></script>
    <title>CamaleonMg</title>
    <script src="../../modernizr.custom.min.js"></script>
  </head>
  <body>
    <header>
      <div class="title sample">Sistema de Firmas CamaleonMG</div>
    </header>
    <aside>
      <h1>Controls</h1>
      <h2>Choose a file to view</h2>
      <select id="select" style="width: 100%">
        <option value="../../../resources/documentos/contrato_prestacion.pdf">Contrato Prestación de Servicios 2020</option>
        <option value="https://pdftron.s3.amazonaws.com/downloads/pl/demo-annotated.pdf">https://pdftron.s3.amazonaws.com/downloads/pl/demo-annotated.pdf</option>
        <option value="https://pdftron.s3.amazonaws.com/downloads/pl/report.docx">https://pdftron.s3.amazonaws.com/downloads/pl/report.docx</option>
        <!--
        <option value="https://pdftron.s3.amazonaws.com/downloads/pl/presentation.pptx">https://pdftron.s3.amazonaws.com/downloads/pl/presentation.pptx</option>
        <option value="../../../samples/files/demo-annotated.pdf">../../../samples/files/demo-annotated.pdf</option>
        <option value="../../../samples/files/encrypted-foobar12.pdf">../../../samples/files/encrypted-foobar12.pdf</option>
        -->
      </select>
      <h2>Or pass a url to a document</h2>
      <form id="url-form">
        <input id="url" type="text" style="width: 100%" />
        <input type="submit" value="Submit" />
      </form>
      <h2>Or choose your own</h2>
      <input id="file-picker" type="file" accept=".pdf,.jpg,.jpeg,.png,.docx,.xlsx,.pptx,.md" />
      <hr />

      <h1>Instructions</h1>
      <strong>This sample is using WebViewer client side rendering, so none of the files will be uploaded to any server.</strong>
      <p>Use the dropdown above to view local or remote documents. Out of the box, WebViewer client only can load the following file types:</p>
      <ul>
        <li>.pdf</li>
        <li>.jpg</li>
        <li>.jpeg</li>
        <li>.png</li>
        <li>.docx</li>
        <li>.xlsx</li>
        <li>.pptx</li>
        <li>.md</li>
        <li>.xod</li>
      </ul>

      <p>Visit <a href="https://www.pdftron.com/documentation/web/guides/file-format-support" target="_blank">here</a> for a full list of supported file formats.</p>
      <p>You can also open password-protected PDF. The password is `foobar12`.</p>
    </aside>
    <div id="viewer"></div>
    <script src="../../menu-button.js"></script>

    <!--ga-tag-->

    <script>
      Modernizr.addTest('async', function() {
        try {
          var result;
          eval('let a = () => {result = "success"}; let b = async () => {await a()}; b()');
          return result === 'success';
        } catch (e) {
          return false;
        }
      });

      // test for async and fall back to code compiled to ES5 if they are not supported
      ['viewing.js'].forEach(function(js) {
        var script = Modernizr.async ? js : js.replace('.js', '.ES5.js');
        var scriptTag = document.createElement('script');
        scriptTag.src = script;
        scriptTag.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(scriptTag);
      });
    </script>
  </body>
</html>
