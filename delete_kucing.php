<?php
session_start();
require_once 'functions.php';

if (isset($_GET['id'])) {
    $id_kucing = $_GET['id'];
    hapus_kucing($id_kucing);
    header("Location: index.php");
    exit();
}
