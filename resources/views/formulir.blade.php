<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request dengan Input Laravel</title>
</head>
<body>

    <h2>Formulir Pegawai</h2>
    <form action="/formulir/proses" method="post">
        @csrf
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br/><br/>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required><br/><br/>

        <input type="submit" value="Simpan">
    </form>

</body>
</html>
