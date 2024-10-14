<?php
session_start();
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_kucing = $_GET['id'];
    $db = connect_db();
    $query = "SELECT * FROM adopsi WHERE id_kucing = $id_kucing";
    $kucing = $db->querySingle($query, true);

    $query_user = "SELECT nomor FROM users WHERE id = " . $kucing['created_by'];
    $user = $db->querySingle($query_user, true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kucing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(image.webp);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .detail-container {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
        }

        img {
            max-width: 50%;
            border-radius: 5px;
        }

        p {
            line-height: 1.6;
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #4cae4c;
        }

        .back-link {
            background-color: #007bff;
        }

        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
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
                <p>
                    <strong>Hubungi Pemilik:</strong>
                    <a href="https://wa.me/<?php echo $user['nomor']; ?>" target="_blank">Hubungi via WhatsApp</a>
                </p>
            </div>
        <?php else: ?>
            <p>Kucing tidak ditemukan.</p>
        <?php endif; ?>
        <a class="back-link" href="halaman_utama.php">Kembali ke Daftar Kucing</a>
    </div>
</body>

</html>