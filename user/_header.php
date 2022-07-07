<!DOCTYPE html>
<?php

 include_once ('../koneksi.php');
 if($_SESSION['username']==''){
     header("location: ../auth/log2.php");
 }
 if(!isset($_SESSION['username'])){
    die("<b>Oops!</b> Access Failed.
        <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
        <button type='button' onclick=location.href='./'>Back</button>");
}
if($_SESSION['hak_akses']!="pegawai"){
    die("<b>Oops!</b> Access Failed.
        <p>Anda Bukan Pegawai.</p>
        <button type='button' onclick=location.href='./'>Back</button>");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>view user information - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/b-2.0.1/b-html5-2.0.1/date-1.1.1/r-2.2.9/rr-1.2.8/sc-2.0.5/sb-1.2.2/datatables.min.css"/>
 


</head>
<body>
<script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../notif/js/notification.js"></script>
    
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/b-2.0.1/b-html5-2.0.1/date-1.1.1/r-2.2.9/rr-1.2.8/sc-2.0.5/sb-1.2.2/datatables.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script> 
    
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />