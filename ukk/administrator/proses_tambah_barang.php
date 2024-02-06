<?php
// Include file koneksi.php
include 'koneksi.php';

// Memeriksa apakah form telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari form
    $namaproduk = $_POST['NamaProduk'];
    $harga = $_POST['Harga'];
    $stok = $_POST['Stok'];

    // Menyimpan data ke database
    $sql = "INSERT INTO produk (NamaProduk, Harga, Stok) VALUES ('$namaproduk', '$harga', '$stok')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location:data_barang.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
}
?>
