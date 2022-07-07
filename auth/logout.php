<?php
  
  require_once "../koneksi.php";
  $_SESSION['id_user']='';
  $_SESSION['username']='';
  $_SESSION['hak_akses']='';
  $_SESSION['password']='';
  $_SESSION['nip']='';

  unset($_SESSION['id_user']);
  unset($_SESSION['username']);
  unset($_SESSION['hak_akses']);
  unset($_SESSION['password']);
  unset($_SESSION['nip']);
  session_unset();
  session_destroy();
  header('location:log2.php');
?>