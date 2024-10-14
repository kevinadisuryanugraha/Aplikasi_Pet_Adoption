<?php

function connect_db()
{
    $db = new SQLite3('adopsi_kucing.db');
    return $db;
}

function buat_table()
{
    $db = connect_db();
    $db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    nomor TEXT NOT NULL
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS adopsi (
    id_kucing INTEGER PRIMARY KEY AUTOINCREMENT,
    foto TEXT NOT NULL,
    jenis_kucing TEXT NOT NULL,
    usia INTEGER NOT NULL,
    alamat TEXT NOT NULL,
    deskripsi TEXT NOT NULL,
    created_by INTEGER NOT NULL,
    FOREIGN KEY(created_by) REFERENCES users(id)
    )");
}

buat_table();
