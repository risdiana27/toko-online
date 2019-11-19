<?php

	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$level = "customer";
	$status = "on";
	$nama_lengkap = $_POST['nama_lengkap'];
	$email = $_POST['email'];
	$no_telp = $_POST['no_telp'];
	$alamat = $_POST['alamat'];
	$password = $_POST['password'];
	$re_password = $_POST['re_password'];

	unset($_POST['password']);
	unset($_POST['re_password']);
	$dataForm = http_build_query($_POST);

	$query = mysqli_query($koneksi, "SELECT * FROM user where email='$email'");

	if(empty($nama_lengkap) || empty($email) || empty($no_telp) || empty($alamat) || empty($password)) {
		header("location: ".BASE_URL."index.php?page=register&notif=require&$dataForm");
	} elseif ($password != $re_password) {
		header("location: ".BASE_URL."index.php?page=register&notif=password&$dataForm");
	} elseif (mysqli_num_rows($query) == 1) {
		header("location: ".BASE_URL."index.php?page=register&notif=email&$dataForm");
	} 
	else {
		$password = md5($password);
		mysqli_query($koneksi, "INSERT INTO user (level, nama, email, phone, alamat, password, status)
										value ('$level', '$nama_lengkap', '$email', '$no_telp', '$alamat', '$password', '$status') ");
		header("location: ".BASE_URL."index.php?page=login");
	}
	
?>

