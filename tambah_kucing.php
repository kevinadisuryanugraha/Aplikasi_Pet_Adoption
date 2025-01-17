<?php
session_start();
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_kucing = $_POST["jenis_kucing"];
    $usia = $_POST["usia"];
    $alamat = $_POST["alamat"];
    $deskripsi = $_POST["deskripsi"];
    $created_by = $_POST['created_by'];
    $nomor_hp = $_POST['nomor_hp'];

    $result = tambah_kucing($_FILES['foto'], $jenis_kucing, $usia, $alamat, $deskripsi, $created_by, $nomor_hp);

    if ($result) {

        echo "<script>alert('Kucing Berhasil Ditambahkan');
        window.location='index.php';
        </script>";
    } else {
        echo "Terjadi kesalahan saat menambahkan kucing";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kucing</title>
    <link rel="stylesheet" href="css/tambah.css">
</head>

<body>
    <div class="container">
        <h2>Tambah Kucing Adopsi</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="foto">Foto Kucing:</label>
            <input type="file" id="foto" name="foto" required autofocus>

            <label for="jenis_kucing">Jenis Kucing:</label>
            <input type="text" id="jenis_kucing" name="jenis_kucing" required>

            <label for="usia">Usia Kucing (Tahun):</label>
            <input type="number" id="usia" name="usia" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>

            <label for="created_by">Dibuat oleh:</label>
            <input type="text" id="created_by" name="created_by" required>

            <label for="nomor_hp">Masukkan Nomor HandPhone:</label>
            <input type="number" id="nomor_hp" name="nomor_hp" required>

            <input type="submit" value="Simpan">
        </form>
        <a href="index.php">Kembali ke Daftar Kucing</a>
    </div>
</body>

</html>i