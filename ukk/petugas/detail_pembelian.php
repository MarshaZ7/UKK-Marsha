<?php
include "header.php";
include "navbar.php";
?>
<div class="container">
		<?php 
		include '../koneksi.php';
		$PelangganID = $_GET['PelangganID'];
		$no = 1;
		$data = mysqli_query($koneksi,"SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
		while($d = mysqli_fetch_array($data)){
			?>
			<?php if ($d['PelangganID'] == $PelangganID) { ?>
				<table class="table3">
					<tr class="tr3">
						<td class="td3">ID Pelanggan</td>
						<td class="td3">: <?php echo $d['PelangganID']; ?></td>
					</tr>
					<tr class="tr3">
						<td class="td3">Nama Pelanggan</td>
						<td class="td3">: <?php echo $d['NamaPelanggan']; ?></td>
					</tr>
					<tr class="tr3">
						<td class="td3">No. Telepon</td>
						<td class="td3">: <?php echo $d['NomorTelepon']; ?></td>
					</tr>
					<tr class="tr3">
						<td class="td3">Alamat</td>
						<td class="td3">: <?php echo $d['Alamat']; ?></td>
					</tr>
					<tr class="tr3">
						<td class="td3">Total Pembelian</td>
						<td class="td3">: Rp. <?php echo $d['TotalHarga']; ?></td>
					</tr>
				</table>

<div class="form-detail">
<form  method="post" action="tambah_detail_penjualan.php">
	<input  type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" hidden>
		<input  type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
			<button class="btn" type="submit">Tambah Barang</button>
</form></div><br>

<table class="table">
	<thead>
		<tr class="tr">
			<th class="th">No</th>
			<th class="th">Nama Produk</th>
			<th class="th">Jumlah Beli</th>
			<th class="th">Total Harga</th>
			<th class="th">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			include '../koneksi.php';
			$no = 1;
			$detailpenjualan = mysqli_query($koneksi,"SELECT * FROM detailpenjualan");
			while($d_detailpenjualan = mysqli_fetch_array($detailpenjualan)){
		?>
		<?php 
		if ($d_detailpenjualan['PenjualanID'] == $d['PenjualanID']) { ?>
			<tr class="tr">
				<td class="td"><?php echo $no++; ?></td>
				<td class="td">				
				<form  action="simpan_barang_beli.php" method="post">											
					<input  type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
					<input  type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
					<select name="ProdukID" class="form-control" onchange="this.form.submit()">
					<option>--- Pilih Produk ---</option>
				<?php 
				include '../koneksi.php';
				$no = 1;
				$produk = mysqli_query($koneksi,"SELECT * FROM produk");
				while($d_produk = mysqli_fetch_array($produk)){
				?>
					<option value="<?php echo $d_produk['ProdukID']; ?>" <?php if ($d_produk['ProdukID']==$d_detailpenjualan['ProdukID']) { echo "selected"; } ?>><?php echo $d_produk['NamaProduk']; ?></option>
				<?php } ?>
					</select>				
				</form>
				</td>
				<td class="td">
				<form class="detail" method="post" action="hitung_subtotal.php">
				<?php 
				include '../koneksi.php';
				$produk = mysqli_query($koneksi,"SELECT * FROM produk");
				while($d_produk = mysqli_fetch_array($produk)){
				?>
				<?php 
				if ($d_produk['ProdukID']==$d_detailpenjualan['ProdukID']) { ?>
					<input type="text" name="Harga" value="<?php echo $d_produk['Harga']; ?>" hidden>
					<input type="text" name="ProdukID" value="<?php echo $d_produk['ProdukID']; ?>" hidden>
					<input type="text" name="Stok" value="<?php echo $d_produk['Stok']; ?>" hidden>
				<?php 
				}
				}
				?>				
					<input type="number" name="JumlahProduk" value="<?php echo $d_detailpenjualan['JumlahProduk']; ?>" class="form-control">										
				</td>
				<td class="td"><?php echo $d_detailpenjualan['Subtotal']; ?></td>
				<td class="td">
					<input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
					<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
					<button class="btn" type="submit" >Proses</button>
				</form>
				<form method="post" action="hapus_detail_pembelian.php">
					<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
					<input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
					<button class="btn hapus" type="submit" >Hapus</button>
				</form>
				</td>
				</tr>
				<?php } else {
				?>
				<?php 
				}
				} 
				?>
					</tbody>
				</table>

				<form method="post" action="simpan_total_harga.php">
					<?php 
					include '../koneksi.php';
					$detailpenjualan = mysqli_query($koneksi, "SELECT SUM(Subtotal) AS TotalHarga FROM detailpenjualan WHERE 	PenjualanID='$d[PenjualanID]'"); 
					$row = mysqli_fetch_assoc($detailpenjualan); 
					$sum = $row['TotalHarga'];
					?>	
					<b><label>Total Harga</label></b>
						<input type="text" class="form-control" name="TotalHarga" value="<?php echo $sum; ?>">
						<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
						<input type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" hidden>											
						<button class="btn add" type="submit">Simpan</button>						
				</form>
			<?php } else { ?>
				<?php 
			} 
		} 
		?>
	</div>
</div>
