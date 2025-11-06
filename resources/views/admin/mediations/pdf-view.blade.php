<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF Viewer</title>
  <script src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>
  <style>
    html, body { height: 100%; margin: 0; }
    #adobe-dc-view { height: 100vh; width: 100%; }
  </style>
</head>
<body>
  <div id="adobe-dc-view"></div>

  <script>
    document.addEventListener("adobe_dc_view_sdk.ready", function() {
      const pdfUrl = @json($fileUrl);

      const adobeDCView = new AdobeDC.View({
        clientId: "{{ config('services.adobe_pdf.client_id') }}", // no fallback inside angle brackets
        divId: "adobe-dc-view"
      });

      adobeDCView.previewFile(
        {
          content: { location: { url: pdfUrl } },
          metaData: { fileName: pdfUrl.split('/').pop() }
        },
        { embedMode: "FULL_WINDOW" }
      );
    });
  </script>
</body>
</html>
