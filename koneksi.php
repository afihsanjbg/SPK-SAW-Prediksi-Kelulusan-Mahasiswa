<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "project_kuisioner";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>