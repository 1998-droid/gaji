<?php
    include "../koneksi.php";

    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $username = trim(mysqli_real_escape_string($connect, $_POST['user']));
        $password = trim(mysqli_real_escape_string($connect, $_POST['pass']));
        $hak_akses = trim(mysqli_real_escape_string($connect, $_POST['hak_akses']));
        $nip = trim(mysqli_real_escape_string($connect, $_POST['nip']));
        $status = trim(mysqli_real_escape_string($connect, $_POST['status']));
       
            mysqli_query($connect, "UPDATE tb_user SET username='$username', password='$password', hak_akses='$hak_akses', nip='$nip'
            , status='$status' WHERE id_user='$id'") 
            or die (mysqli_error($connect));
            echo "<script>window.location='data_user.php';</script>";
    }
?>