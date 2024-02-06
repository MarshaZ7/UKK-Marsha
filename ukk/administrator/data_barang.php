<?php
include "header.php";
include "navbar.php";
?>
<div class="container">	
<div class="menu">	
	<button class="btn add" id="myBtn" onclick="openModal('tambah-data-modal')">Tambah Barang</button>
		<?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan']=="simpan-modal"){?>
				<div class="alert alert-succes">
					Data Berhasil Di Simpan
				</div>
			<?php } ?>
			<?php if($_GET['pesan']=="update-modal"){?>
				<div class="alert alert-warning">
					Data Berhasil Di Update
				</div>
			<?php } ?>
			<?php if($_GET['pesan']=="hapus-modal"){?>
				<div class="alert alert-danger">
					Data Berhasil Di Hapus
				</div>
			<?php } ?>
			<?php 
		}
		?>
		
	<br><br>
		<table>
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Produk</th>
					<th>Harga</th>
					<th>Stok</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				include '../koneksi.php';
				$no = 1;
				$data = mysqli_query($koneksi,"select * from produk");
				while($d = mysqli_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['NamaProduk']; ?></td>
						<td>Rp. <?php echo $d['Harga']; ?></td>
						<td><?php echo $d['Stok']; ?></td>
						<td>
						<button class="btn" onclick="openModal('edit-data-modal<?php echo $d['ProdukID']; ?>')">Edit</button>
						<button class="btn hapus" onclick="openModal('hapus-data-modal<?php echo $d['ProdukID']; ?>')">Hapus</button>
						</td>
					</tr>

<!-- Modal Edit Data-->
<div class="modal" id="edit-data-modal<?php echo $d['ProdukID']; ?>">						
	<div class="modal-content">
		<div class="modal-header">
			<h2>Edit Data</h2>
			<span class="close" onclick="closeModal('edit-data-modal<?php echo $d['ProdukID']; ?>')">&times;</span></div>
		<form action="proses_update_barang.php" method="post">			
				<div class="item-form">
				<label>Nama Produk</label>
				<input type="hidden" name="ProdukID" value="<?php echo $d['ProdukID']; ?>">
				<input type="text" name="NamaProduk" class="form-control" value="<?php echo $d['NamaProduk']; ?>">																				

				<label>Harga Produk</label>
				<input type="number" name="Harga" class="form-control" value="<?php echo $d['Harga']; ?>">										
				<label>Stok Produk</label>
				<input type="number" name="Stok" class="form-control" value="<?php echo $d['Stok']; ?>"><br>
				<button class="btn" type="submit">Update</button>
			</div>		
		</form>
	</div>
</div>				

<!-- Modal Hapus Data-->					
<div class="modal" id="hapus-data-modal<?php echo $d['ProdukID']; ?>">						
	<div class="modal-content">
		<div class="modal-header">
			<h2>Hapus Data</h2>								
			<span class="close" onclick="closeModal('hapus-data-modal<?php echo $d['ProdukID']; ?>')">&times;</span></div>
		<form method="post" action="proses_hapus_barang.php">		
			<div class="item-form">
				<input type="hidden" name="ProdukID" value="<?php echo $d['ProdukID']; ?>">
				Apakah anda yakin akan menghapus data <b><?php echo $d['NamaProduk']; ?></b><br><br>
				<button class="btn hapus" type="submit" class="btn btn-primary">Hapus</button>
			</div>		
		</form>
	</div>
</div>					
		<?php } ?>
	</tbody>
</table>

		
<!-- Modal Tambah Data-->
<div class="modal" id="tambah-data-modal">		
		<div class="modal-content">
			<div class="modal-header">
			<h2>Tambah Data</h2>						
			<span class="close" onclick="closeModal('tambah-data-modal')">&times;</span></div>
			<form action="proses_simpan_barang.php" method="post">
				<div class="modal-body">				
					<div class="item-form">						
						<label>Nama Produk</label>
						<input type="text" name="NamaProduk" class="form-control">
						<label>Harga Produk</label>
						<input type="number" name="Harga" class="form-control">					
						<label>Stok Produk</label>
						<input type="number" name="Stok" class="form-control"><br>
					<button class="btn" type="submit">Simpan</button>				
				</div>
				</div>
				</form>
		</div>
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
<!-- <?php
include "footer.php";
?> -->