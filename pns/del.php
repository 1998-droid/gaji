<?php
include "../koneksi.php";

mysqli_query($connect, "DELETE FROM tb_user WHERE id_user='$_GET[id]'") or die(mysql_error($connect));
echo "<script>window.location='data_user.php';</script>";

?>