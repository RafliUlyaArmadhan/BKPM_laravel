<!DOCTYPE html>
<html>
<head>
    <title>Dropzone File Upload in Laravel</title>

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Dropzone CSS & JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Dropzone File Upload in Laravel</h1><br>

                <!-- Form Upload -->
                <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data"
                    class="dropzone" id="file-upload">
                    @csrf
                    <div>
                        <h3 class="text-center">Upload PDF atau Gambar</h3>
                    </div>
                </form>

                <button type="button" id="upload-button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>

    <!-- Dropzone Config -->
    <script type="text/javascript">
        Dropzone.options.fileUpload = {
            maxFilesize: 2, // Maksimal 2MB
            acceptedFiles: ".jpg,.jpeg,.png,.gif,.pdf", // Bisa upload PDF & gambar
            addRemoveLinks: true, // Bisa menghapus file sebelum upload
            autoProcessQueue: false, // Harus klik tombol upload manual
            init: function () {
                var myDropzone = this;

                // Aksi ketika tombol Upload ditekan
                $("#upload-button").click(function (e) {
                    e.preventDefault();
                    myDropzone.processQueue();
                });

                this.on("sending", function (file, xhr, formData) {
                    var data = $('#file-upload').serializeArray();
                    $.each(data, function (key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                this.on("success", function (file, response) {
                    alert("File berhasil diunggah: " + response.file_url);
                });

                this.on("error", function (file, response) {
                    alert("Gagal mengunggah file: " + response);
                });
            }
        };
    </script>

</body>
</html>
