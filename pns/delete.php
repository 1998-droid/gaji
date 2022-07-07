<?php
include "../koneksi.php";
$nis = $_POST['nis']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
// echo implode(",", $nis);
// die;
$query = "DELETE FROM karyawan WHERE id_peg IN(".implode(",", $nis).")"; // Buat variabel $query untuk menampung query delete

// Eksekusi/Jalankan query dari variabel $query
mysqli_query($connect, $query) or die (mysqli_error($connect));
header("location: data.php"); // Redirect ke halaman index.php

?>