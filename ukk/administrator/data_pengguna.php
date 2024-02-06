<?php
include "header.php";
include "navbar.php";
?>
<div class="container">
	<div class="menu">
	<button class="btn add" onclick="openModal('tambah-data-modal')">Tambah Pengguna</button>		
		<?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan']=="simpan"){?>
				<div class="alert alert-success" role="alert">
					Data Berhasil Di Simpan
				</div>
			<?php } ?>
			<?php if($_GET['pesan']=="update"){?>
				<div class="alert alert-success" role="alert">
					Data Berhasil Di Update
				</div>
			<?php } ?>
			<?php if($_GET['pesan']=="hapus"){?>
				<div class="alert alert-success" role="alert">
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
					<th>Nama Petugas</th>
					<th>Username</th>
					<th>Akses Petugas</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				include '../koneksi.php';
				$no = 1;
				$data = mysqli_query($koneksi,"select * from petugas");
				while($d = mysqli_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['nama_petugas']; ?></td>
						<td><?php echo $d['username']; ?></td>
						<td>
							<?php 
							if ($d['level'] == '1') { ?>
								Administrator
							<?php } else { ?>
								Petugas
							<?php } ?>
						</td>
						<td>
						<button class="btn" onclick="openModal('edit-data-modal<?php echo $d['id_petugas']; ?>')">Edit</button>								
							
								<button class="btn hapus" onclick="openModal('hapus-data-modal<?php echo $d['id_petugas']; ?>')">Hapus</button>
							
						</td>
					</tr>

	<!-- Modal Edit Data-->
	<div class="modal" id="edit-data-modal<?php echo $d['id_petugas']; ?>">						
		<div class="modal-content">
			<div class="modal-header">
			<h2>Edit Data</h2>
			<span class="close" onclick="closeModal('edit-data-modal<?php echo $d['id_petugas']; ?>')">&times;</span></div>								
		<form action="proses_update_petugas.php" method="post">			
				<div class="item-form">
				<label>Nama Petugas</label>
				<input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
				<input type="text" name="nama_petugas" class="form-control" value="<?php echo $d['nama_petugas']; ?>">								

				<label>Username</label>
				<input type="text" name="username" class="form-control" value="<?php echo $d['username']; ?>">								

				<label>Password</label>
				<input type="text" name="password" class="form-control">
				<small class="text-danger text-sm">* Kosongkan kalau tidak merubah password</small>				
				
				<label>Akses Petugas</label>
				<select name="level" class="form-control">
				<option>--- Pilih Akses ---</option>
				<option value="1" <?php if ($d['level'] == '1') { echo "selected";} ?>>Administrator</option>
				<option value="2" <?php if ($d['level'] == '2') { echo "selected";} ?>>Petugas</option>
				</select><br>																
				<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</div>
	</form>
	</div>
</div>

<!-- Modal Hapus Data-->
<div class="modal" id="hapus-data-modal<?php echo $d['id_petugas']; ?>">
	<div class="modal-content">
		<div class="modal-header">
		<h2>Hapus Data</h1>
		<span class="close" onclick="closeModal('hapus-data-modal<?php echo $d['id_petugas']; ?>')">&times;</span></div>
		<form method="post" action="proses_hapus_petugas.php">
			<div class="modal-body">
			<div class="item-form">
			<input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
			Apakah anda yakin akan menghapus data <b><?php echo $d['nama_petugas']; ?></b><br>
			<button type="submit" class="btn btn-primary">Hapus</button>
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
			<form action="proses_simpan_petugas.php" method="post">
				<div class="modal-body">				
					<div class="item-form">
					<label>Nama Petugas</label>
					<input type="text" name="nama_petugas" class="form-control">
										
					<label>Username</label>
					<input type="text" name="username" class="form-control">
										
					<label>Password</label>
					<input type="text" name="password" class="form-control">					

					<label>Akses Petugas</label>
					<select name="level" class="form-control">
						<option>--- Akses Petugas ---</option>
						<option value="1">Administrator</option>
						<option value="2">Petugas</option>
					</select><br>										
				<button type="submit" class="btn btn-primary">Simpan</button>
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
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
