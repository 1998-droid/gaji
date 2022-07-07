<?php
include "_header.php";
?>
<div class="container bootdey flex-grow-1 container-p-y">
  <style>
    table.dataTable td {
  font-size: 1em;
}
  </style>

            <div class="media align-items-center py-3 mb-3">
              <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="d-block ui-w-100 rounded-circle">
              <div class="media-body ml-4">
                <?php
                $sql_2 = mysqli_query($connect, "SELECT a.Indeks_penyesuaian, a.id_bpjs, a.nama, a.tgl, b.nip FROM tb_bpjs a 
                JOIN tb_user b ON b.nip=a.nip WHERE username='$_SESSION[username]' order by a.tgl desc") 
                or die (mysqli_error($connect));
                $data =mysqli_fetch_array($sql_2);
                

                ?>
                <h4 class="font-weight-bold mb-0"><?=($data['nama'])?> <span class="text-muted font-weight-normal"></span></h4>
                <hr class="mb-0">
                <div class="text-muted mb-0">Indeks : <?=($data['Indeks_penyesuaian'])?></div>
                <div class="text-muted mb-2">NIP/NIK : <?=($data['nip'])?></div>
                <a href="look.php" class="btn btn-success btn-sm">Gaji</a>&nbsp;
                <a href="look_jp.php" class="btn btn-success btn-sm">JP Umum</a>&nbsp;
                <a href="../auth/logout.php" class="btn btn-danger btn-sm">Logout</a>&nbsp;
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <table class="table table-responsive table-borderless table-hover">
                  <tbody>
                    <tr>
                      <td>Username</td>
                      <td>:</td>
                      <td><?=($_SESSION['username'])?></td>
                    </tr>
                    <tr>
                      <td>Role</td>
                      <td>:</td>
                      <td><?=($_SESSION['hak_akses'])?></td>
                    </tr>
                    <tr>
                    <!-- <td><a href ="ubah.php?id=<?=$_SESSION['id_user']?>"
                       class= "btn btn-warning btn-xs"><i class="bi bi-archive"></i>Update</a>
                      </td>
                    </tr> -->
                    
                  </tbody>
                  <!-- <div class="pull-right">
                  <a href="javascript:void(0)" class="btn btn-primary btn-sm">Edit</a>
                  </div> -->
                </table>
              </div>
            </div>
            <hr class="border-light m-0">
            <div class="card md-0 card-responsive">
              <div class="card-body">
              <b>Table BPJS</b>
                <hr>
              <div class="table-responsive table-xs">
                <table class="table table-sm table-responsive card-table m-0" id="table_bpjs">
                  <thead>
                    <tr class="table-info table-center" >
                      <th>TGL</th>
                      <th>Net</th>
                      <th>Opsi</th>
                      <TH>POT</TH>
                    </tr>
                  </thead>
                  <tbody>
                    
                  <?php
                   $sql_2 = mysqli_query($connect, "SELECT *,b.nip, a.nip,
                   (((il_casemix+il_jp)+(Pelayanan_indeks+Farmasi_indeks)+(Pelayanan_langsung+Farmasi_langsung))) as total_indeks,
                   (pil_casemix+pil_jp+Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl) as t_pph, 
                   ((il_casemix+il_jp+Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+Farmasi_langsung)-(pil_casemix+pil_jp+Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)) as bersih,
                   ((il_casemix+il_jp+Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+Farmasi_langsung)-(pil_casemix+pil_jp+Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)-(Hari_Raya+ppni+pot_bpjs+artha_medika+BinaSehat+apotik_kasir+Lain2)) as net,
                   (Hari_Raya+ppni+pot_bpjs+artha_medika+BinaSehat+apotik_kasir+Lain2) t_pot
                   FROM tb_bpjs a 
                   JOIN tb_user b ON b.nip=a.nip 
                   WHERE username='$_SESSION[username]' ") 
                   or die (mysqli_error($connect));
                   if(mysqli_num_rows($sql_2)>0){
                    while ($data =mysqli_fetch_array($sql_2)){ ?>
                     <tr>
                       <td><?=date('M y', strtotime($data['tgl']))?></td>
                       <td><?='Rp.'.number_format($data['net'])?></td>
                       <td><a href ="d_bpjs.php?id_bp=<?=$data['id_bpjs']?>"
                       class= "btn btn-warning btn-xs"><i class="bi bi-archive"></i>detail</a>
                      </td>
                      <td><a href ="pot_bpjs.php?id_bp=<?=$data['id_bpjs']?>"
                       class= "btn btn-warning btn-xs"><i class="bi bi-archive"></i>pot</a>
                      </td>
                    </tr>
                      <?php }
                                    } else{
                                        echo "<tr><td colspan =\"6\" align = \"center\">Data tidak ditemukan</td></tr>";
                                    }
                                ?>
                  </tbody>
                </table>
              </div>
            </div>

    <script>
$(document).ready(function(){
         
         $('#table_bpjs').DataTable(
            {
                "lengthMenu": [ [10, 20], [10, 20] ],
                "order": [[3,"desc" ]]
         }
        
          )} );
</script>
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
 
<script>
//   $(document).on('click', '.view_data', function(){  
//            var employee_id = $(this).attr("id");  
//            if(employee_id != '')  
//            {  
//                 $.ajax({  
//                      url:"select.php",  
//                      method:"POST",  
//                      data:{employee_id:employee_id},  
//                      success:function(data){  
//                           $('#employee_detail').html(data);  
//                           $('#dataModal').modal('show');  
//                      }  
//                 });  
//            }            
//       });  
//  });  
</script>