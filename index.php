<?php
require_once "koneksi.php";
if (isset($_SESSION['username'])) {
    echo "<script>window.location='user/look.php'</script>";
}
else {
    echo "<script>window.location='auth/log2.php'</script>";
}

?>