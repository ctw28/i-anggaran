<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Button Example</title>
</head>

<body>

    <!-- Your page content goes here -->

    <button onclick="printSpecificURL()">Print</button>

    <script>
        function printSpecificURL() {
            // Create an invisible iframe
            var iframe = document.createElement('iframe');
            iframe.style.display = 'none';

            // Set the iframe source to the desired URL
            iframe.src = 'http://127.0.0.1:8000/sesi/4/cetak/daftar-nominal';

            // Append the iframe to the document
            document.body.appendChild(iframe);

            // Wait for the iframe to load (you may adjust the time based on your needs)
            setTimeout(function() {
                // Trigger the print operation
                iframe.contentWindow.print();

                // Remove the iframe from the document
                document.body.removeChild(iframe);
            }, 1000); // Adjust the time (in milliseconds) as needed
        }
    </script>

</body>

</html>