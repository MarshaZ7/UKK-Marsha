<?php 
session_start();

	// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']==""){
	header("location:../login.php?pesan=gagal");
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">      
	<meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>Halaman Petugas</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="modal.css">
</head>
<body>
    