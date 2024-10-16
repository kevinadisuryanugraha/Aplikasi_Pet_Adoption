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
    <link rel="stylesheet" href="css/index.css">
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

</html>i