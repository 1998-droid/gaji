<?php
    include "../koneksi.php";

    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $username = trim(mysqli_real_escape_string($connect, $_POST['user']));
        $password = trim(mysqli_real_escape_string($connect, $_POST['pass']));
        $nip = trim(mysqli_real_escape_string($connect, $_POST['nip']));
       
            mysqli_query($connect, "UPDATE tb_user SET username='$username', password='$password', nip='$nip' WHERE id_user='$id'") 
            or die (mysqli_error($connect));
            echo "<script>window.location='../auth/logout';</script>";
    }
?>