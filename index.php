<?php 
	session_start();
	include 'config/koneksi.php';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = mysqli_query($con, "SELECT * FROM user WHERE username='$_POST[username]' and password='$_POST[password]'");
		$cek = mysqli_num_rows($sql);
		if($cek>0){
		  $data = mysqli_fetch_assoc($sql);
		  if ($data['akses'] == "Administrator") {
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $data['nama'];
			echo "<script>alert('Selamat datang');document.location.href='page/admin/'</script>";
		  }else if ($data['akses'] == "Peserta Didik"){
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $data['nama'];
			echo "<script>alert('Selamat datang');document.location.href='page/pesertadidik/'</script>";
		  }else if ($data['akses'] == "Guru"){
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $data['nama'];
			echo "<script>alert('Selamat datang');document.location.href='page/guru/'</script>";
		  }else if ($data['akses'] == "Orang Tua"){
			$_SESSION['username'] = $username;
			$_SESSION['nama'] =$data['nama'];
			echo "<script>alert('Selamat datang');document.location.href='page/ortu/'</script>";
		  }else{
			echo "<script>alert('Login gagal');document.location.href='index.php'</script>";
		  }
		}else{
		  echo "<script>alert('Gagal cek username & password !');document.location.href='index.php'</script>";
		}
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Act Mot | Login</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="shortcut icon" href="image/logo-wk.png" />
</head>
<style>
	.login {
		margin-right: 40%;
		margin-left: 40%;
	}
	body {
		background-color: #199FB1;
		font-family: 'Quicksand', sans-serif;
	}
	h3 {
		margin-left: 25%;
		margin-top: 15%;
		color: white;
		text-align: center;
		margin-right: 26%;
	}
</style>
<body>
	<h3>STUDENT MONITORING ACTIVITY<br> SMK WIKRAMA BOGOR</h3>
	<br>
	<div class="login">
	<form method="post">
		<div class="form-group">
			<input type="text" name="username" class="form-control form-control-user" placeholder="Username" autocomplete="true">
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control form-control-user" placeholder="Password">
		</div>
		<input type="submit" value="Login" name="login" class="btn btn-primary btn-user btn-block" style="margin-right: 35%;">
	</form>
	</div>
</body>
</html>