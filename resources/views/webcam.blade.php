<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capture Webcam</title>
    <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.0.26/webcam.min.js"></script>
</head>

{{-- <body>
    <div id="my_camera"></div>
    <div id="result"></div>
    <input type="text" id="name" placeholder="Nama">
    <input type="text" id="class" placeholder="Kelas">
    <button id="captureBtn">Capture</button>
    <button id="saveBtn" style="display:none;">Simpan</button>
    <script>
        // Inisialisasi Tombol
        const toggleWebcamBtn = document.getElementById('toggle-webcam');
        const captureBtn = document.getElementById('capture-btn');
        const camera = document.getElementById('camera');
        let webcamActive = false;

        // Event Listener untuk Tombol On/Off Webcam
        toggleWebcamBtn.addEventListener('click', () => {
            if (webcamActive) {
                // Matikan Webcam
                Webcam.reset();
                camera.style.display = 'none';
                toggleWebcamBtn.textContent = 'Turn On Webcam';
                captureBtn.style.display = 'none';
                webcamActive = false;
            } else {
                // Aktifkan Webcam
                Webcam.set({
                    width: 640,
                    height: 480,
                    image_format: 'png',
                    png_quality: 90
                });
                Webcam.attach('#camera');
                camera.style.display = 'block';
                toggleWebcamBtn.textContent = 'Turn Off Webcam';
                captureBtn.style.display = 'block';
                webcamActive = true;
            }
        });

        // Event Listener untuk Tombol Capture
        captureBtn.addEventListener('click', () => {
            Webcam.snap(function(dataUri) {
                // Tampilkan Hasil Gambar
                document.getElementById('result').innerHTML = `<img src="${dataUri}" />`;
                console.log(dataUri);

                // Kirim ke Server
                fetch("{{ route('capture.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            image: dataUri
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                    })
                    .catch(error => console.error(error));
            });
        });
    </script>
</body> --}}

<body>
    <div id="my_camera"></div>
    <div id="result"></div>
    <input type="text" id="name" placeholder="Nama">
    <input type="text" id="class" placeholder="Kelas">
    <button id="toggleWebcamBtn">Turn On Webcam</button>
    <button id="captureBtn">Capture</button>
    <button id="saveBtn" style="display:none;">Simpan</button>

    <script type="text/javascript" src="webcam.min.js"></script>
    <script language="JavaScript">
        // Konfigurasi Webcam
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        let toggleWebcamBtn = document.getElementById('toggleWebcamBtn');
        let captureBtn = document.getElementById('captureBtn');
        let saveBtn = document.getElementById('saveBtn');
        let webcamActive = false;
        let dataUri = '';

        // Event Listener untuk Tombol On/Off Webcam
        toggleWebcamBtn.addEventListener('click', () => {
            if (webcamActive) {
                Webcam.reset();
                toggleWebcamBtn.textContent = 'Turn On Webcam';
                captureBtn.style.display = 'none';
                webcamActive = false;
            } else {
                Webcam.attach('#my_camera');
                toggleWebcamBtn.textContent = 'Turn Off Webcam';
                captureBtn.style.display = 'block';
                webcamActive = true;
            }
        });

        // Event Listener untuk Tombol Capture
        captureBtn.addEventListener('click', () => {
            Webcam.snap(function(uri) {
                dataUri = uri;
                // Tampilkan Hasil Gambar
                document.getElementById('result').innerHTML = `<img src="${dataUri}" />`;
                saveBtn.style.display = 'block';
            });
        });

        // Event Listener untuk Tombol Simpan
        saveBtn.addEventListener('click', () => {
            let name = document.getElementById('name').value;
            let className = document.getElementById('class').value;

            // Kirim ke Server
            fetch("{{ route('capture.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        image: dataUri,
                        name: name,
                        class: className
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => console.error(error));
        });
    </script>
</body>

</html>
