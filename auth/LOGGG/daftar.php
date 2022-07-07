<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KEUANGAN</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
        <div class="box">
        <div align ="center"  style ="margin-top: 90px;"><font color="black"><h1><b>Pendaftaran Akun</b></h1></div>
            <div align ="center" style ="margin-top: 150px;">
            
                <form action="dafpro.php" method="post" class="navbar-form">
                    <div class="input-group">
                        <span class ="input-group-addon"><i class ="glyphicon glyphicon-user"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>

                    </div>
                    <div class="input-group">
                        <span class ="input-group-addon"><i class ="glyphicon glyphicon-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <input type="hidden" name="hak_akses" class="form-control" value ="pegawai"  required>
                        <input type="hidden" name="status" class="form-control" value ="disable"  required>
                    </div>
                    <div class="input-group">
                        <span class ="input-group-addon"><i class ="glyphicon glyphicon-credit-card"></i></span>
                        <input type="number" name="nip" class="form-control" placeholder="NIP/NIK" required >
                    </div>
                    <div class="input-group">
                        <input type="submit" name ="daftar" class="btn btn-primary" value="Daftar">
                    </div>
                    <br></br>
                    <div class="row col-5">
                    
                    <div class="input-group">
                    <a href ="log.php" class= "btn btn-warning btn-sm">Batal<i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                </form>
                <!-- <div align ="center"  style ="margin-top: 40px;"><font color="black"><h4><b>NIK = NOMER INDUK KARYAWAN</b></h4></div>
                    <div align ="center"  style ="margin-top: 40px;"><font color="black"><h4><b>NIP = NOMER INDUK PEGAWAI</b></h4></div>
                    <b><marquee align ="center"  behavior="" direction="left">UNTUK AKTIVASI AKUN BISA KE RUANGAN IT ATAU KIRIM Username DAN NIKA/NIP</marquee>
                    <marquee align ="center"  behavior="" direction="left">085726727514 TIO RAMDANI, S.Kom</marquee>
                </div>  -->
        </div>
    </div>
    
    <script src="../js/jquery.min.js"></script>
    <!-- <script src="<?= ('../_asset/js/bootstrap.min.js')?>"></script> -->
</body>
</html>