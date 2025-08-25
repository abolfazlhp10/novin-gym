<!DOCTYPE html>
<html>

<head>
    <title>Download PDF via API</title>
</head>

<body>
    <h3>Click the button to download the PDF</h3>
    <button id="downloadBtn">Download PDF</button>

    <script>
        document.getElementById('downloadBtn').addEventListener('click', function() {
            fetch('http://localhost:8000/api/V1/programs/7/download', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer 13|7jLonyrwiKPtgzzio8HijFzmjO8UdJbFBAgzzUila65baa86',
                        'Accept': 'application/pdf'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to download PDF');
                    }

                    // Extract filename from content-disposition
                    const disposition = response.headers.get('Content-Disposition');
                    if (disposition && disposition.includes('filename=')) {
                        filename = disposition.split('filename*=UTF-8\'\'')[1]?.split(';')[0] || 'download.pdf';
                        filename = decodeURIComponent(filename);
                    }


                    return response.blob().then(blob => ({
                        blob,
                        filename
                    }));
                })
                .then(({
                    blob,
                    filename
                }) => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                })
                .catch(error => {
                    console.error('Download error:', error);
                });
        });
    </script>
</body>

</html>
