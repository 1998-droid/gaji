<?php
    require_once "../koneksi.php";

    if (isset($_SESSION['username'])) {
        echo "<script>window.location='../user'</script>";
    } else {
?>

<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KEUANGAN</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <div class="container">
            <div align ="center" style ="margin-top: 200px;">
            
                <form action="logproses.php?op=in" method="post" class="navbar-form">
                    <div class="input-group">
                        <span class ="input-group-addon"><i class ="glyphicon glyphicon-user"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>

                    </div>
                    <div class="input-group">
                        <span class ="input-group-addon"><i class ="glyphicon glyphicon-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <input type="submit" name ="login" class="btn btn-primary" value="LOGIN">
                    </div>
                    <br></br>
                    <div class="row col-5">
                    
                    <div class="input-group">
                    <a href ="daftar.php" class= "btn btn-warning btn-sm">Daftar<i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                    </div>
                </form>
                </div>
        </div>
    </div>
    <div align ="center"  style ="margin-top: 190px;"><font color="black"><h1><b> Sistem Informasi Keuangan</b></h1></div>
    <script src="../js/jquery.min.js"></script>
    <!-- <script src="<?= ('../_asset/js/bootstrap.min.js')?>"></script> -->
</body>
</html>
<?php
    }
?>