<?php
// session_start();
	include "../koneksi.php";
	if($_SESSION['username']==''){
		header("location: ../auth");
	}
	if(!isset($_SESSION['username'])){
	   die("<b>Oops!</b> Access Failed.
		   <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		   <button type='button' onclick=location.href='./'>Back</button>");
   }
   if($_SESSION['hak_akses']!="jp"){
	   die("<b>Oops!</b> Access Failed.
		   <p>Anda Bukan Pegawai.</p>
		   <button type='button' onclick=location.href='./'>Back</button>");}
   
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>DEPARTEMEN KEUANGAN</title>

		<!-- Load File bootstrap.min.css yang ada difolder css -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!-- <link rel="stylesheet" type="text/css" href="../_asset/DataTables/datatables.min.css"/> -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.11.2/b-2.0.0/b-html5-2.0.0/r-2.2.9/sc-2.0.5/sp-1.4.0/datatables.min.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>
		
		<!-- <link href="../DataTables/datatables.min.css" rel="stylesheet">
		<script type="text/javascript" src="../DataTables/datatables.min.js"></script> -->
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		  <!-- <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> -->
		  <!-- <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> -->
		
		
		<!-- Style untuk Loading -->
		<style>
        #loading{
			background: whitesmoke;
			position: absolute;
			top: 140px;
			left: 82px;
			padding: 5px 10px;
			border: 1px solid #ccc;
		}
		</style>
	</head>
	<body>
	<script language="JavaScript" type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.11.2/b-2.0.0/b-html5-2.0.0/r-2.2.9/sc-2.0.5/sp-1.4.0/datatables.min.js"></script>
	<script type="text/javascript"  src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>



</script>
	
		<!-- Membuat Menu Header / Navbar -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#" style="color: white;"><b>KEUANGAN</b></a>
				</div>
				<p class="navbar-text navbar-right hidden-xs" style="color: white;padding-right: 10px;">
					Nama Petugas &nbsp;
					<a style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; 
					text-decoration: none;" href="../auth/logout.php"><?=($_SESSION['nip'])?></a> 
					<p class="navbar-text navbar-right hidden-xs" style="color: white;padding-right: 10px;">
					<a style="background: #FFA500; padding: 0 5px; border-radius: 4px; color: #f7f7f7; 
					text-decoration: none;" href="../pns/data_user.php">Lihat  Data User</a>
					<a style="background: #FFA500; padding: 0 5px; border-radius: 4px; color: #f7f7f7; 
					text-decoration: none;" href="../jp_bpjs">Data BPJS</a>
					<a style="background: #FFA500; padding: 0 5px; border-radius: 4px; color: #f7f7f7; 
					text-decoration: none;" href="../jp">Data JP UMUM</a>
					<a style="background: #FFA500; padding: 0 5px; border-radius: 4px; color: #f7f7f7; 
					text-decoration: none;" href="../jp_jr">Data JP Jasa Raharja</a>
					<a style="background: #FFA500; padding: 0 5px; border-radius: 4px; color: #f7f7f7; 
					text-decoration: none;" href="../jampersal">Data JP Jampersal</a>
					<!-- <a target="_blank" style="background: #00aced; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="../p3k">Data P3K</a> 
					<a target="_blank" style="background: #d34836; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="../thdsk">THDSK</a>
					<a target="_blank" style="background: #8A2BE2; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="../harkon">HARKON</a>
					<a target="_blank" style="background: #FF8C00; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="../harlok">HARLOK</a> -->
				</p>
			</div>
		</nav>