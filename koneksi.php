<?php
$host     = "localhost";
$username = "root";
$password = "root";
$dbname   = "db_pegawai";

$koneksi = mysqli_connect($host, $username, $password, $dbname);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>