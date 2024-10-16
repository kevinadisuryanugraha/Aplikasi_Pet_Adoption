<?php
session_start();
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kucing = $_POST['id_kucing'];
    $foto = $_FILES['foto'];
    $jenis_kucing = $_POST['jenis_kucing'];
    $usia = $_POST['usia'];
    $alamat = $_POST['alamat'];
    $deskripsi = $_POST['deskripsi'];
    $created_by = $_POST['created_by'];
    $nomor_hp = $_POST['nomor_hp'];

    $result = edit_kucing($id_kucing, $foto, $jenis_kucing, $usia, $alamat, $deskripsi, $created_by, $nomor_hp);
    if ($result) {
        echo "<script>alert('Kucing Berhasil Diperbarui');
        window.location='index.php';
        </script>";
    } else {
        echo "Terjadi kesalahan saat memperbarui kucing.";
    }
}


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
    <title>Edit Kucing</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url(image.webp);
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #5a67d8;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        input[type="file"],
        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #5a67d8;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #5a67d8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #434190;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #5a67d8;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #434190;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border 0.3s ease-in-out;
        }

        textarea:focus {
            border-color: #5a67d8;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Kucing Adopsi</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_kucing" value="<?php echo $kucing['id_kucing']; ?>">
            <label for="foto">Foto Kucing:</label>
            <div class="custom-file-input">
                <input type="file" id="foto" name="foto" value="<?php echo $kucing['foto']; ?>" required autofocus>
            </div>

            <label for="jenis_kucing">Jenis Kucing:</label>
            <input type="text" id="jenis_kucing" name="jenis_kucing" value="<?php echo $kucing['jenis_kucing']; ?>" required>

            <label for="usia">Usia Kucing (Tahun):</label>
            <input type="number" id="usia" name="usia" value="<?php echo $kucing['usia']; ?>" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?php echo $kucing['alamat']; ?>" required>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required><?php echo $kucing['deskripsi']; ?></textarea>

            <label for="created_by">Dibuat oleh:</label>
            <input type="text" id="created_by" name="created_by" value="<?php echo $kucing['created_by']; ?>" required>

            <label for="nomor_hp">Masukkan Nomor HandPhone:</label>
            <input type="text" id="nomor_hp" name="nomor_hp" value="<?php echo $kucing['nomor_hp']; ?>" required>

            <input type="submit" value="Perbarui">
        </form>
        <a href="index.php">Kembali ke Daftar Kucing</a>
    </div>
</body>

</html>