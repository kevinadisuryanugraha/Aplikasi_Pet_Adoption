<?php
require_once 'functions.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: halaman_utama.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nomor = $_POST['nomor'];

    $user = get_user_by_email($email);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['email'] = $user['email'];
        header("Location: halaman_utama.php");
        exit();
    } else {
        $result = tambah_user($nama, $email, $nomor);
        if ($result) {
            $new_user = get_user_by_email($email);
            $_SESSION['user_id'] = $new_user['id'];
            $_SESSION['nama'] = $new_user['nama'];
            $_SESSION['email'] = $new_user['email'];
            header("Location: halaman_utama.php");
            exit();
        } else {
            echo "Terjadi kesalahan saat menambahkan pengguna";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopsi Kucing</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 900px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card_1 {
            width: 50%;
            padding: 40px;
            background-color: white;
        }

        .card_1 h1,
        .card_1 h3 {
            margin-bottom: 20px;
            color: #333;
        }

        .card_1 form input[type="text"],
        .card_1 form input[type="email"],
        .card_1 form input[type="number"] {
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            width: 100%;
            font-size: 16px;
            transition: border 0.3s ease-in-out;
        }

        .card_1 form input[type="text"]:focus,
        .card_1 form input[type="email"]:focus,
        .card_1 form input[type="number"]:focus {
            border: 1px solid #007BFF;
            outline: none;
        }

        .card_1 form input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        .card_1 form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .card_2 {
            width: 50%;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card_2 img {
            max-width: 100%;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card_1">
                <form action="" method="POST">
                    <h1>Selamat Datang!</h1>
                    <h3>Masuk ke Akun Anda</h3>

                    <input type="text" name="nama" required placeholder="Nama Lengkap">
                    <input type="email" name="email" required placeholder="Alamat Email">
                    <input type="number" name="nomor" required placeholder="Nomor Telepon">
                    <input type="submit" value="Submit">
                </form>
            </div>

            <div class="card_2">
                <img src="cat.png" alt="Kucing Lucu">
            </div>
        </div>
    </div>
</body>

</html>