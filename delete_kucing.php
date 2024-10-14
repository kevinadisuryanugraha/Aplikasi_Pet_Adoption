<?php
session_start();
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_kucing = $_GET['id'];
    hapus_kucing($id_kucing);
    header("Location: halaman_utama.php");
    exit();
}
