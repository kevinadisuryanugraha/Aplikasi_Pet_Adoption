<?php
session_start();
require_once 'functions.php';

if (isset($_GET['id'])) {
    $id_kucing = $_GET['id'];
    $db = connect_db();
    $query = "SELECT * FROM adopsi WHERE id_kucing = $id_kucing";
    $kucing = $db->querySingle($query, true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kucing</title>
    <link rel="stylesheet" href="css/detail.css">
</head>

<body>
    <div class="container">
        <h2>Detail Kucing</h2>
        <?php if ($kucing): ?>
            <div class="detail-container">
                <img src="uploads/kucing/<?php echo $kucing['foto']; ?>" alt="Foto Kucing">
                <p><strong>Jenis Kucing:</strong> <?php echo $kucing['jenis_kucing']; ?></p>
                <p><strong>Usia:</strong> <?php echo $kucing['usia']; ?> Tahun</p>
                <p><strong>Alamat:</strong> <?php echo $kucing['alamat']; ?></p>
                <p><strong>Deskripsi:</strong> <?php echo $kucing['deskripsi']; ?></p>
                <p><strong>Dibuat Oleh:</strong> <?php echo $kucing['created_by']; ?></p>
                <p>
                    <strong>Hubungi Pemilik:</strong>
                    <a href="https://wa.me/<?php echo $kucing['nomor_hp']; ?>" target="_blank">Hubungi via WhatsApp</a>
                </p>
            </div>
        <?php else: ?>
            <p>Kucing tidak ditemukan.</p>
        <?php endif; ?>
        <a class="back-link" href="index.php">Kembali ke Daftar Kucing</a>
    </div>
</body>

</html>