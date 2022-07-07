<?php
  include "../koneksi.php";
?>
<style>
  table{
        border-collapse: collapse;
    }

    table tr td{
        padding:3px;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>view user information - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="container bootdey flex-grow-1 container-p-y">

            <div class="media align-items-center py-3 mb-3">
              <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="d-block ui-w-100 rounded-circle">
              <div class="media-body ml-4">
                <?php
                $id = @$_GET['id'];
                $sql_2 = mysqli_query($connect, "SELECT *, a.nama, b.nip, a.indeks, (gol+gr+MK+TJ+JAB+TF+LL) AS tot,
                (Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl+Hari_Raya+POT_BINA_SEHAT+ARISAN_KARU+POT_ARTHA_MEDIKA+Lain2) as pot,
                ((Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+
					Farmasi_langsung)-(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)-(Hari_Raya+Kurban+POT_BINA_SEHAT+RUANGAN+ARISAN_KARU+POT_ARTHA_MEDIKA+Lain2)) as neto FROM tb_jam a 
                JOIN tb_user b ON a.nip=b.nip WHERE id_jam ='$id'") 
                or die (mysqli_error($connect));
                $data =mysqli_fetch_array($sql_2);
                ?>
                <h4 class="font-weight-bold mb-1"><?=($data['nama'])?><span class="text-muted font-weight-normal"></span></h4>
                <hr class="mb-0">
                <div class="text-muted mb-2">Rek    :   <?=($data['nip'])?></div>
                <div class="text-muted mb-2">Indeks : <?=($data['indeks'])?></div>
                <div class="text-muted mb-2">TGL    : <?=tgl_indo($data['tgl'])?></div>
              </div>
            </div>

            <div class="card md-1">
              <div class="card-body">
              <table class="table table-responsive table-hover table-sm">
    <thead align="center">
        <th>GR</th>
        <th>MK</th>
        <th>TJ</th>
        <th>JAB</th>
        <th>TF</th>
        <th>LL</th>
        <th>TOT</th>
        <th>IDKS</th>
    </thead>
    <tbody align="center">
        <td><?php echo $data['gr'] ?></td>
        <td><?php echo $data['MK'] ?></td>
        <td><?php echo $data['TJ'] ?></td>
        <td><?php echo $data['JAB'] ?></td>
        <td><?php echo $data['TF'] ?></td>
        <td><?php echo $data['LL'] ?></td>
        <td><?php echo $data['tot'] ?></td>
        <td><?php echo $data['tot'] ?></td>
    </tbody>
    </table>
            </div>
            </div>

            <div class="card md-1">
              <div class="card-body">
                <table class="table table-responsive table-borderless table-hover table-sm">
                  
                  
                  <tbody>
                    <tr>
                      <td>INDEKS PELAYANAN</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['Pelayanan_indeks'])?></td>
                    </tr>
                    <tr>
                      <td>INDEKS FARMASI</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['Farmasi_indeks'])?></td>
                    </tr>
                    <tr>
                      <td>JASA PELAYANAN</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['Pelayanan_langsung'])?></td>
                    </tr>
                    <tr>
                      <td>JASA FARMASI</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['Farmasi_langsung'])?></td>
                    </tr>
                    <tr>
                      <td><b>Potongan</td>
                      <td>:</td>
                      <td><b><?='Rp. '.number_format($data['pot'])?></td>
                    </tr>
                    <tr>
                      <td>indeks_p</td>
                      <td>:</td>
                      <td><?=($data['indeks_p'])?></td>
                    </tr>
                    <tr>
                      <td>indeks_f</td>
                      <td>:</td>
                      <td><?=($data['indeks_f'])?></td>
                    </tr>
                    <tr>
                      <td><b>Bersih</td>
                      <td><b>:</td>
                      <td><b><?='Rp. '.number_format($data['neto'])?></td>
                    </tr>
                   
                      <td><a target="_blank" href="printjam.php?id=<?=$data['id_jam']?>" class="btn btn-primary btn-sm">Print</a></td>
                    </tr>
                  </tbody>
                  <div class="pull-right">
                  <a onclick="history.back();" class="btn btn-primary btn-sm">Back</a>
                  </div>
                </table>
              </div>
              <hr class="border-light m-1">

<!-- ini adlah modal -->

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
 
</script>