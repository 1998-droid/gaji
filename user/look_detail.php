<?php
  include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>view user information - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/b-2.0.1/b-html5-2.0.1/b-print-2.0.1/date-1.1.1/r-2.2.9/rr-1.2.8/sc-2.0.5/sb-1.2.2/datatables.min.css"/>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/b-2.0.1/b-html5-2.0.1/b-print-2.0.1/date-1.1.1/r-2.2.9/rr-1.2.8/sc-2.0.5/sb-1.2.2/datatables.min.js"></script>
<div class="container bootdey flex-grow-1 container-p-y">

            <div class="media align-items-center py-3 mb-3">
              <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="d-block ui-w-100 rounded-circle">
              <div class="media-body ml-4">
                <?php
                $id = @$_GET['id'];
                $sql_2 = mysqli_query($connect, "SELECT *, b.id_peg, b.nama, b.gaji, b.nip, b.tgl, a.password FROM tb_user a JOIN karyawan b ON
                 a.nip=b.nip WHERE id_peg ='$id'")
                or die (mysqli_error($connect));
                $data =mysqli_fetch_array($sql_2);
                ?>
                <h4 class="font-weight-bold mb-0"><?=($data['nama'])?> <span class="text-muted font-weight-normal"></span></h4>
                <hr class="mb-0">
                <div class="text-muted mb-0">Nip : <?=($data['nip'])?></div>
                <div class="text-muted mb-0">Gaji : <?=number_format($data['gaji'])?></div>
                <div class="text-muted mb-0">TGL : <?=date('j M y', strtotime($data['tgl']))?></div>
              </div>
            </div>

              <div class="card">
              <div class="card-body">
                <table class="table table-responsive table-borderless table-hover table-sm" id="gaji">
                  <tbody>
                  
                    <tr>
                      <td>DANSOS</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['dansos'])?></td>
                    </tr>
                    <tr>
                      <td>IURAN WAJIB KORPRI</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['iw_korpkab'])?></td>
                    </tr>
                    <tr>
                      <td>DAPENS KORPRI</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['dapens_korp'])?></td>
                    </tr>
                    <tr>
                      <td>SIMPI ARMED</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['simpi_armed'])?></td>
                    </tr>
                    <tr>
                      <td>DPLK</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['dplk'])?></td>
                    </tr>
                    <tr>
                      <td>IW. KORPRI UNIT</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['iw_korp_unit'])?></td>
                    </tr>
                    <tr>
                      <td>BAZNAZ INFAQ</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['baznaz_infaq'])?></td>
                    </tr>
                    <tr>
                      <td>BAZNAZ ZAKAT</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['baznaz_zakat'])?></td>
                    </tr>
                    <tr>
                      <td>BANK BPD</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['bank_bpd'])?></td>
                    </tr>
                    <tr>
                      <td>BPR GN. SIMPING</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['bpr_gnsimping'])?></td>
                    </tr>
                    <tr>
                      <td>KOP. BINA SEHAT</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['k_bina_sehat'])?></td>
                    </tr>
                    <tr>
                      <td>KOP. SEKAR</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['kop_sekar'])?></td>
                    </tr>
                    <tr>
                      <td>ARISAN SAS</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['arisan_sas'])?></td>
                    </tr>
                    <tr>
                      <td>BPJS KESEHATAN</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['bpjs_kes'])?></td>
                    </tr>
                    <tr>
                      <td>BPJS KETENAGAKERJAAN</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['bpjs_ker'])?></td>
                    </tr>
                    <tr>
                      <td>Darma Wanita</td>
                      <td>:</td>
                      <td><?=($data['darma'])?></td>
                    </tr>
                    <tr>
                      <td>LAIN</td>
                      <td>:</td>
                      <td><?='Rp. '.number_format($data['lain'])?></td>
                    </tr>
                    <tr>
                      <td><a target="_blank" href="print_2.php?id=<?=$data['id_peg']?>" class="btn btn-primary btn-sm">Print</a></td>
                    </tr>
                  </tbody>
                  <div class="pull-right">
                  <a href="look.php" class="btn btn-primary btn-sm">Back</a>
                  
                  </div>
                </table>
            </div> 
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
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Employee Details</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 