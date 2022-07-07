<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../_asset/css.css">
    <link href="../css/2.png" rel="shortcut icon">
    </head>
    <body>
    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2><b><a href="log2.php" class="active"> LOGIN </a></b></h2>
    <!-- Icon -->
    <div class="fadeIn first">
      <img src="../_asset/img/money.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="dafpro.php" method="post">
      <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
      <input type="text" id="nip" class="fadeIn fourth" name="nip" placeholder="NIP/NIK" min="5" max="20" required>
      <input type="hidden" name="hak_akses" class="fadeIn third" value ="pegawai"  required>
      <input type="hidden" name="status" class="fadeIn third" value ="disable"  required>
      
      <input type="submit" class="fadeIn fiveth" value="Daftar">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <H5>RSUD MAJENANG &copy; 2021 - <script>document.write(new Date().getFullYear())</script></H5>
    </div>
  </div>
    </body>
</html>