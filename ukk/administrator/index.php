<?php
include "header.php";
include "navbar.php";
?>
<div class="container">
<h2>Selamat Datang di halaman Admin</h2>
    <div class="card-container">        
    <div class="card">
        <div class="card-content">
        <h2 class="card-title">Data Barang</h2>
            <?php
			include '../koneksi.php';
			$data_produk = mysqli_query($koneksi,"SELECT * FROM produk");
			$jumlah_produk = mysqli_num_rows($data_produk);
			?>
            <h3><?php echo $jumlah_produk;?></h3>
            <a href="data_barang.php" class="btn">Detail</a>
    </div>
</div>
<div class="card">
        <div class="card-content">
        <h2 class="card-title">Data Pelanggan</h2>
        <?php
			include '../koneksi.php';
			$data_pembeli = mysqli_query($koneksi,"SELECT * FROM pelanggan");
			$jumlah_pembeli = mysqli_num_rows($data_pembeli);
			?>
            <h3><?php echo $jumlah_pembeli;?></h3>
            <a href="pembelian.php" class="btn">Detail</a>
    </div>
</div>
<div class="card">
        <div class="card-content">
        <h2 class="card-title">Data Pengguna</h2>
        <?php
			include '../koneksi.php';
			$data_pengguna = mysqli_query($koneksi,"SELECT * FROM petugas");
			$jumlah_pengguna = mysqli_num_rows($data_pengguna);
			?>
            <h3><?php echo $jumlah_pengguna;?></h3>
            <a href="data_pengguna.php" class="btn">Detail</a>
    </div>
</div>
</div>