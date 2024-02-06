<!DOCTYPE HTML>
<html>
<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
            <h2>LOGIN</h2></div>
            <?php 
				if(isset($_GET['pesan'])){
					if($_GET['pesan']=="gagal"){
						echo "<div class='alert'>
                        Username atau password salah.</div>";
					}
				}
				?>  
        <form method="post" action="proses_login.php">
            <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required>
        <label>Password</label>
    <input type="password" name="password" placeholder="Masukkan password" required>
    <button type="submit">Login</button>
</form>
</div>
</div>

