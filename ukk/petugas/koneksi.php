<?php
$server = "localhost"; // Ganti dengan nama server MySQL Anda
$user = "root"; // Ganti dengan nama pengguna MySQL Anda
$pw = ""; // Ganti dengan kata sandi MySQL Anda
$database = "dbkasir"; // Ganti dengan nama database yang ingin Anda gunakan

// Membuat koneksi
$conn = mysqli_connect($server, $user, $pw, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
