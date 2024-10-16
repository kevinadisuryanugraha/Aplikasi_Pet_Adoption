<?php
session_start();
require_once 'functions.php';

$kucing_list = get_all_kucing();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopsi Hewan Kucing</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-image: url(image.webp);
            color: #333;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #fff;
            background-color: #5a67d8;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .container .right {
            text-align: right;
        }

        .container .right a {
            text-decoration: none;
            color: #fff;
            background-color: #5a67d8;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .container .right a:hover {
            background-color: #5578e8;
        }

        .container table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container table thead {
            background-color: #5a67d8;
            color: #fff;
        }

        .container table thead th {
            padding: 12px 15px;
            text-align: left;
        }

        .container table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        .container table tbody tr:nth-child(even) {
            background-color: #f4f4f9;
        }

        .container .actions a {
            margin-right: 10px;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
            display: inline-block;
        }

        .container .edit {
            background-color: #2b6cb0;
        }

        .container .delete {
            background-color: #e53e3e;
        }

        .container .detail {
            background-color: #38a169;
        }

        .container .edit:hover {
            background-color: #2c5282;
            transform: scale(1.05);
        }

        .container .delete:hover {
            background-color: #c53030;
            transform: scale(1.05);
        }

        .container .detail:hover {
            background-color: #2f855a;
            transform: scale(1.05);
        }

        .container .no-data {
            text-align: center;
            padding: 15px;
            font-size: 16px;
        }

        .container .welcome {
            color: #fff;
            background-color: rgba(90, 104, 216, 0.7);
            padding: 5px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Website Adopsi Hewan Kucing</h2>
        <div class="right">
            <a href="tambah_kucing.php">Tambah Kucing</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto Kucing</th>
                    <th>Jenis Kucing</th>
                    <th>Usia</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kucing_list)): ?>
                    <tr>
                        <td colspan="6" class="no-data">Tidak ada List Adopsi Kucing</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($kucing_list as $index => $kucing): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><img src="uploads/kucing/<?php echo $kucing['foto']; ?>" alt="Foto Kucing" style="width: 100px;"></td>
                            <td><?php echo $kucing['jenis_kucing']; ?></td>
                            <td><?php echo $kucing['usia']; ?></td>
                            <td><?php echo $kucing['alamat']; ?></td>
                            <td class="actions">
                                <a href="detail_kucing.php?id=<?php echo $kucing['id_kucing']; ?>" class="detail">Detail</a>
                                <a href="edit_kucing.php?id=<?php echo $kucing['id_kucing']; ?>" class="edit">Edit</a>
                                <a href="delete_kucing.php?id=<?php echo $kucing['id_kucing']; ?>" class="delete" onclick="return confirm('Anda yakin ingin menghapusnya?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>