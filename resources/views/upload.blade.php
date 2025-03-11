<!DOCTYPE html>
<html>
<head>
    <title>Upload File Dengan Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="text-center my-5">Upload File Dengan Laravel</h2>
    <div class="col-lg-8 mx-auto my-5">

        <!-- Notifikasi Jika Upload Berhasil -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Peringatan Jika Ada Error -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Peringatan Jika Ada Validasi Error -->
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br/>
                @endforeach
            </div>
        @endif

        <form action="{{ route('upload.resize') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="file"><b>File Gambar</b></label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="keterangan"><b>Keterangan</b></label>
                <textarea class="form-control" name="keterangan" id="keterangan" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

    </div>
</div>

<!-- Tambahkan script untuk Bootstrap agar alert bisa ditutup -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
