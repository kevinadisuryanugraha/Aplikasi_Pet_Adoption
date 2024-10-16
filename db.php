<?php

function connect_db()
{
    $db = new SQLite3('db_adopsi_kucing.db');
    return $db;
}

function buat_table()
{
    $db = connect_db();
    $db->exec("CREATE TABLE IF NOT EXISTS adopsi (
    id_kucing INTEGER PRIMARY KEY AUTOINCREMENT,
    foto TEXT NOT NULL,
    jenis_kucing TEXT NOT NULL,
    usia INTEGER NOT NULL,
    alamat TEXT NOT NULL,
    deskripsi TEXT NOT NULL,
    created_by INTEGER NOT NULL,
    nomor_hp TEXT NOT NULL
    )");
}

buat_table();
