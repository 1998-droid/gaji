<?php
include "../koneksi.php";
$user = trim(mysqli_real_escape_string($connect, $_POST['username']));
$pass = trim(mysqli_real_escape_string($connect, $_POST['password']));
$hak_akses = trim(mysqli_real_escape_string($connect, $_POST['hak_akses']));
$status = trim(mysqli_real_escape_string($connect, $_POST['status']));
$rek = trim(mysqli_real_escape_string($connect, $_POST['nip']));
$sql_cek_rek = mysqli_query($connect, "SELECT * FROM tb_user WHERE  nip='$rek'") or die (mysqli_error($connect));
$sql_cek_username = mysqli_query($connect, "SELECT * FROM tb_user WHERE  username='$user'") or die (mysqli_error($connect));
$sql_cek_peg = mysqli_query($connect, "SELECT * FROM tb_user a JOIN tb_peg b ON a.nip=b.nip WHERE  a.nip='$rek'") or die (mysqli_error($connect));
if(mysqli_num_rows($sql_cek_rek)>0){
    echo "<script>window.location='daf2.php';alert('NIP/NIK dan nama Sudah Ada'); </script>";
}elseif(mysqli_num_rows($sql_cek_username)>0){
    echo "<script>window.location='daf2.php';alert('Username Sudah Ada'); </script>";
}elseif(mysqli_num_rows($sql_cek_peg)>0){
    echo "<script>window.location='daf2.php';alert('Anda Bukan Pegawai RSUD'); </script>";
}
else{
mysqli_query($connect, "INSERT INTO tb_user(username, password, hak_akses, status, nip) VALUES ('$user', '$pass', '$hak_akses', '$status','$rek')") 
or die (mysqli_error($connect));
echo "<script>window.location='log2.php';</script>";}
?>