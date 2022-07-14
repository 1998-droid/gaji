<?php
    require_once "../koneksi.php";

    if (isset($_SESSION['username'])) {
        echo "<script>window.location='../user'</script>";
    } else {
?>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../_asset/css.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../css/2.png" rel="shortcut icon">

    <style>
        .main {
            text-align: center;
        }
         
        .marq {
            padding-top: 30px;
            padding-bottom: 30px;
        }
    </style>
    </head>
    <body>
    
    

    <div class="wrapper fadeInDown">
    <div class="main">
      <marquee class="marq"
         bgcolor="Green"
         behavior=alternate
         direction="left"
         loop="">
    Isi Nika jangan menggunakan titik atau koma
  </marquee>
</div>
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2><b><a href="daf2.php" class="active underline"> Daftar </a></b></h2>
    <!-- Icon -->
    <div class="fadeIn first">
      <img src="../_asset/img/money.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="logproses.php?op=in" method="post">
      <input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>
    <!-- Remind Passowrd -->
    <div id="formFooter">
      <H5>RSUD MAJENANG &copy; 2021 - <script>document.write(new Date().getFullYear())</script></H5>
    </div>

  </div>
  <script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 500);
</script>
    </body>
</html>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<?php
    }
?>