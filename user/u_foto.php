<?php
    include_once "_header.php";
    include_once "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="col-lg-12">

<?php
    $id = @$_GET['id'];
    $sql_2 = mysqli_query($connect, "SELECT * FROM tb_user WHERE id_user ='$id'") 
    or die (mysqli_error($connect));
    $data =mysqli_fetch_array($sql_2);
?>

                <div class="card">
                
                    <div class="card-body">
                    <div>
                    <div>
                    <input type="button" class="btn btn-warning btn-xs" value="Kembali" onclick="history.back(-1)" />
                    </div>
                    <form action="u_proses.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="user">Username</label>
                    <input type="hidden" name="id" value = "<?=$data['id_user']?>" class="form-control">
                    <input type="text" name="user" id="user" value = "<?=$data['username']?>" class="form-control" required >
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="text" name="pass" id="pass" value="<?=$data['password']?>" class="form-control" required >
                </div>
                
                <div class="form-group">
                    <label for="nip">NIP/NIKA</label>
                    <input type="text" name="nip" id="nip" value="<?=$data['nip']?>" class="form-control" required >
                </div>
                
                <div class="form-group pull-right">
                    <input type="submit" name ="edit" value="Simpan" class="btn btn-success">
                </div>
                <div class="form-group">
					<label>Foto :</label>
					<input type="file" name="foto[]" required="required"  multiple />
					<p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
				</div>	
                    </form>
                    </div>
                </div>
<style type="text/css">
body{
margin-top:20px;
background: #FFF8DC;
}

.ui-w-100 {
width: 100px !important;
height: auto;
}

.card {
width:100%;
height:auto;
background-clip: padding-box;
box-shadow: 0 1px 4px rgba(24,28,33,0.012);
}

.user-view-table td:first-child {
width: 9rem;
}
.user-view-table td {
padding-right: 0;
padding-left: 0;
border: 0;
}

.text-light {
color: #babbbc !important;
}

.card .row-bordered>[class*=" col-"]::after {
border-color: rgba(24,28,33,0.075);
}    

.text-xlarge {
font-size: 170% !important;
}
</style>
</body>
</html>