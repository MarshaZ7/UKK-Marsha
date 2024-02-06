<?php
include "header.php";
include "navbar.php";
?>
<div class="container">	
	<div class="menu">
	<button type="button" id="myBtn" onclick="openModal('tambah-data-modal')">Add Item</button>
		<?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan']=="simpan"){?>
				<div class="alert alert-succes">				
					Data Berhasil Di Simpan					
				</div>
			<?php } ?>
			<?php if($_GET['pesan']=="update"){?>
				<div class="alert alert-succes">									
					Data Berhasil Di Update				
				</div>
			<?php } ?>
			<?php if($_GET['pesan']=="hapus"){?>
				<div class="alert alert-succes">								
					Data Berhasil Di Hapus				
				</div>
			<?php } ?>
			<?php 
		}
		?>
		<br><br>
		<table class="table2">
			<thead>
				<tr>
					<th>No</th>
					<th>ID Pelanggan</th>
					<th>Nama Pelanggan</th>
					<th>No. Telepon</th>
					<th>Alamat</th>
					<th>Total Pembayaran</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				include '../koneksi.php';
				$no = 1;
				$data = mysqli_query($koneksi,"SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
				while($d = mysqli_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['PelangganID']; ?></td>
						<td><?php echo $d['NamaPelanggan']; ?></td>
						<td><?php echo $d['NomorTelepon']; ?></td>
						<td><?php echo $d['Alamat']; ?></td>
						<td>Rp. <?php echo $d['TotalHarga']; ?></td>
						<td>
							<a class="detail" href="detail_pembelian.php?PelangganID=<?php echo $d['PelangganID']; ?>">Detail</a>							
							<button onclick="openModal('edit-data-modal<?php echo $d['PelangganID']; ?>')">Edit</button>
							<button class="button-hapus" onclick="openModal('hapus-data-modal<?php echo $d['PelangganID']; ?>')">Hapus</button>
						</td>
					</tr>

<!-- Modal Edit Data-->
<div id="edit-data-modal<?php echo $d['PelangganID']; ?>" class="modal">	
	<div class="modal-content">
		<div class="modal-header">
		<h2>Edit Data</h2>
		<span class="close" onclick="closeModal('edit-data-modal<?php echo $d['PelangganID'];?>')">&times;</span></div>
		<form action="proses_update_pembelian.php" method="post">	
			<div class="item-form">				
			<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>											
			<label>Nama Pelanggan</label>
			<input type="text" name="NamaPelanggan" value="<?php echo $d['NamaPelanggan']; ?>">													
			<label>No. Telepon</label>
			<input type="text" name="NomorTelepon" value="<?php echo $d['NomorTelepon']; ?>">			
			<label>Alamat</label>
			<input type="text" name="Alamat" value="<?php echo $d['Alamat']; ?>"><br>
			<button type="submit" class="btn btn-primary">Simpan</button>
			</div>				
		</form>
	</div>
</div>

<!-- Modal Hapus Data-->
<div id="hapus-data-modal<?php echo $d['PelangganID']; ?>" class="modal">
	<div class="modal-content">
		<div class="modal-header">
			<h2>Hapus Data</h2>									
			<span class="close" onclick="closeModal('hapus-data-modal<?php echo $d['PelangganID']; ?>')">&times;</span></div>	
			<form method="post" action="proses_hapus_pembelian.php">			
				<div class="item-form">
				<input type="hidden" name="PelangganID" value="<?php echo $d['PelangganID']; ?>">
				Apakah anda yakin akan menghapus data <b><?php echo $d['NamaPelanggan']; ?></b><br><br>
				<button type="submit" class="btn btn-primary" id="konfirmasiHapus">Hapus</button>
				</div>
			</form>
	</div>
</div>
				<?php } ?>
			</tbody>
		</table>	

<!-- Modal Tambah Data-->
<div id="tambah-data-modal" class="modal">	
		<div class="modal-content">
			<div class="modal-header">
				<h2>Tambah Data</h2>
				<span class="close" onclick="closeModal('tambah-data-modal')">&times;</span></div>
			<form action="proses_pembelian.php" method="post">								
					<div class="item-form">						
						<label>ID Pelanggan</label>
						<input type="text" name="PelangganID" value="<?php echo date("dmHis") ?>" class="form-control" readonly>
										
						<label>Nama Pelanggan</label>
						<input type="text" name="NamaPelanggan" class="form-control">
										
						<label>No. Telepon</label>
						<input type="text" name="NomorTelepon" class="form-control">
					
						<label>Alamat</label>
						<input type="text" name="Alamat" class="form-control"><br>
						<input type="hidden" name="TanggalPenjualan" value="<?php echo date("Y-m-d") ?>" class="form-control">
				
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
function openModal(modalId) {
		    var modal = document.getElementById(modalId);
		    modal.style.display = "block";
		}

		function closeModal(modalId) {
		    var modal = document.getElementById(modalId);
		    modal.style.display = "none";
		}  

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target.className === "modal") {
		    event.target.style.display = "none";
		  }
		}
</script>
</div>
<!-- <?php
include "footer.php";
?> -->