<?php
include "../koneksi.php";
$nis = $_POST['nis']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
// echo implode(",", $nis);
// die;
$query = "DELETE FROM tb_jr WHERE id_jr IN(".implode(",", $nis).")"; // Buat variabel $query untuk menampung query delete

// Eksekusi/Jalankan query dari variabel $query
mysqli_query($connect, $query) or die (mysqli_error($connect));
header("location: data_jp.php"); // Redirect ke halaman index.php

?>