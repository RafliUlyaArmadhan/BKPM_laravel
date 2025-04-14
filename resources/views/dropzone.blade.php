<!DOCTYPE html>
<html>

<head>
    <title>Dropzone Image Upload in Laravel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Dropzone Image Upload in Laravel</h1>
                <br>

                <!-- Alert sukses -->
                <div id="success-alert" class="alert alert-success" style="display: none;">
                    Upload berhasil! Halaman akan direfresh...
                </div>

                <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data"
                    class="dropzone" id="image-upload">
                    @csrf
                    <h3 class="text-center">Upload Multiple Images</h3>
                </form>

                <button type="button" id="upload-button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            // paramName: "file",
            maxFilesize: 10,
            parallelUploads: 10,
            uploadMultiple: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            // createImageThumbnails: true,
            autoProcessQueue: false, // Tidak otomatis upload
            // parallelUploads: 5, // Bisa upload beberapa file sekaligus
            init: function() {
                var myDropzone = this;

                // Tombol upload memproses antrian
                $("#upload-button").click(function(e) {
                    e.preventDefault();
                    myDropzone.processQueue();
                });

                // Event saat file sedang dikirim
                this.on("sending", function(file, xhr, formData) {
                    var data = $("#image-upload").serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                // Event saat semua file berhasil diupload
                this.on("successmultiple", function(files, response) {
                    $("#success-alert").fadeIn();
                    setTimeout(function() {
                        location.reload();
                    }, 2000); // Refresh halaman setelah 2 detik
                });

                // Event saat terjadi error
                this.on("error", function(file, response) {
                    alert("Terjadi kesalahan: " + response);
                });
            }
        };
    </script>
</body>

</html>