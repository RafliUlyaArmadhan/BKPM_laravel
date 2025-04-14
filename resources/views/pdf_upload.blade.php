<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropzone PDF Upload in Laravel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Dropzone CSS & JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Dropzone PDF Upload in Laravel</h1>
                
                <!-- Form Dropzone -->
                <form action="{{ route('pdf.store') }}" method="post" 
                      class="dropzone" id="pdf-upload" enctype="multipart/form-data">
                    @csrf
                </form>

                <!-- Tombol Upload -->
                <div class="text-center mt-3">
                    <button type="button" id="submit-all" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#pdf-upload", {
        paramName: "file",
        maxFilesize: 2, 
        acceptedFiles: ".pdf", 
        addRemoveLinks: true,
        autoProcessQueue: false, 
        parallelUploads: 10,
        init: function () {
            let dropzoneInstance = this;

            // Aksi ketika tombol upload diklik
            $("#submit-all").click(function (e) {
                e.preventDefault();
                dropzoneInstance.processQueue();
            });

            this.on("sending", function (file, xhr, formData) {
                // Tambahkan semua input form ke formData Dropzone yang akan dikirim
                let data = $("#pdf-upload").serializeArray();
                $.each(data, function (key, el) {
                    formData.append(el.name, el.value);
                });
            });

            this.on("success", function (file, response) {
                console.log("Upload berhasil:", response);
            });

            this.on("error", function (file, response) {
                console.error("Upload gagal:", response);
            });
        }
    });
    </script>

</body>
</html>