<?php
require_once 'db.php';

function tambah_kucing($foto, $jenis_kucing, $usia, $alamat, $deskripsi, $created_by, $nomor_hp)
{
    $db = connect_db();

    $target_dir = "uploads/kucing/";

    $file_name = basename($foto["name"]);

    $target_file = $target_dir . $file_name;

    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($foto["tmp_name"]);
    if ($check === false) {
        echo "File yang diupload bukan gambar.";
        return false;
    }

    if ($image_file_type != "jpg" && $image_file_type != "jpeg" && $image_file_type != "png") {
        echo "Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
        return false;
    }

    if ($foto["size"] > 2000000) {
        echo "Ukuran file terlalu besar. Maksimal 2MB.";
        return false;
    }

    if (move_uploaded_file($foto["tmp_name"], $target_file)) {

        $query = "INSERT INTO adopsi (foto, jenis_kucing, usia, alamat, deskripsi, created_by, nomor_hp) 
                  VALUES ('$file_name', '$jenis_kucing', $usia, '$alamat', '$deskripsi', '$created_by', '$nomor_hp')";
        $result = $db->exec($query);
        return $result;
    } else {
        echo "Terjadi kesalahan saat mengupload gambar.";
        return false;
    }
}

function get_all_kucing()
{
    $db = connect_db();
    $query = "SELECT * FROM adopsi";
    $result = $db->query($query);

    $kucing_list = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $kucing_list[] = $row;
    }

    return $kucing_list;
}

function ambil_kucing_by_id($id_kucing)
{
    $db = connect_db();
    $query = "SELECT * FROM adopsi WHERE created_by = $id_kucing";
    $result = $db->query($query);

    $kucing_list = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $kucing_list[] = $row;
    }

    return $kucing_list;
}

function edit_kucing($id_kucing, $foto, $jenis_kucing, $usia, $alamat, $deskripsi, $created_by, $nomor_hp)
{
    $db = connect_db();
    $id_kucing = (int)$id_kucing;

    if (!empty($foto["name"])) {
        $target_dir = "uploads/kucing/";
        $file_name = basename($foto["name"]);
        $target_file = $target_dir . $file_name;

        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($foto["tmp_name"]);
        if ($check === false) {
            echo "File yang diupload bukan gambar.";
            return false;
        }

        if ($image_file_type != "jpg" && $image_file_type != "jpeg" && $image_file_type != "png") {
            echo "Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
            return false;
        }

        if (move_uploaded_file($foto["tmp_name"], $target_file)) {
            $foto = $file_name; // Pastikan ini adalah nama file, bukan array
        } else {
            echo "Terjadi kesalahan saat mengupload gambar.";
            return false;
        }
    }

    $query = "UPDATE adopsi SET foto = '$foto', jenis_kucing = '$jenis_kucing', usia = $usia, alamat = '$alamat', deskripsi = '$deskripsi', created_by = '$created_by', nomor_hp = '$nomor_hp' WHERE id_kucing = $id_kucing";
    $result = $db->exec($query);
    return $result;
}


function hapus_kucing($id_kucing)
{
    $db = connect_db();
    $query = "DELETE FROM adopsi WHERE id_kucing = $id_kucing";
    $result = $db->exec($query);

    return $result;
}
