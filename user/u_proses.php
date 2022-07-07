<?php
include 'koneksi.php';
$id = $_POST['id'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$nip = $_POST['nip'];
 
$rand = rand();
$filename = $_FILES['foto']['name'];
$ukuran = $_FILES['foto']['size'];

 

	if($ukuran < 1044070){		
		$xx = $rand.'_'.$filename;
		move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/'.$rand.'_'.$filename);
		mysqli_query($connect, "UPDATE tb_user SET username='$user', password='$pass', nip='$nip', foto='$xx' where id_user='$id'");
		header("location:u_foto.php?alert=berhasil");
	}else{
		header("location:u_foto.php?alert=gagak_ukuran");
	}

?>