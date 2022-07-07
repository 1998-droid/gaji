<?php
                // session_start();
                    include "../koneksi.php";
                    $username = mysqli_real_escape_string($connect, $_POST['username']);
                    $password = mysqli_real_escape_string($connect,$_POST['password']);
                    $op = $_GET['op'];
                
                    if($op=="in"){
                        $sql = mysqli_query($connect, "SELECT * FROM tb_user WHERE username='$username' AND password='$password'") 
                        or die(mysqli_error($connect));
                        $qry = mysqli_fetch_array($sql);
                        if(mysqli_num_rows($sql)==1){
                            if ($qry['status']=="disable") {
                                ?>
                            <!-- <script language="JavaScript">
                                alert('Oops! belum aktif!!!!!!!!!!');
                                document.location='log2.php';
                            </script> -->

                            <script type='text/javascript'>
                            window.top.location='log2.php?pesan=fail';</script>

                            <?php
                                // header("location:log.php");
                            }
                            else if ($qry['status']=="enable") {
                            // $qry = mysqli_fetch_array($sql);
                            $_SESSION['id_user']    = $qry['id_user'];
                            $_SESSION['username']    = $qry['username'];
                            $_SESSION['hak_akses']    = $qry['hak_akses'];
                            $_SESSION['password']    = $qry['password'];
                            $_SESSION['nip']    = $qry['nip'];
                            $_SESSION['status']    = $qry['status'];
                           
                                    if($qry['hak_akses']=="pegawai"){
                                        header("location:../user");
                                    }
                                    else if($qry['hak_akses']=="petugas"){
                                        header("location:../pns");
                                    }else if($qry['hak_akses']=="jp"){
                                        header("location:../jp");
                                    }
                                }
                        }
                        else{
                            ?>
                            <script type='text/javascript'>
                            window.top.location='log2.php?pesan=gagal';</script>
                            <!-- <script language="JavaScript">
                                alert('Oops! Login Failed. Username & password tidak sesuai ...');
                                document.location='log2.php';
                            </script> -->
                            <?php
                        }
                    }
                    else if($op=="out"){
                        unset($_SESSION['id_user']);
                        unset($_SESSION['hak_akses']);
                        unset($_SESSION['password']);
                        unset($_SESSION['nip']);
                        unset($_SESSION['status']);
                        header("location:/.");
                    }
            ?>