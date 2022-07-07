<?php
include "_header.php";
  
?>

<div class="container bootdey flex-grow-1 container-p-y">

            <div class="media align-items-center py-3 mb-3">
              <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" href='look_jp.php' class="d-block ui-w-100 rounded-circle">
              
              <div class="media-body ml-4">
                <?php
                $sql_2 = mysqli_query($connect, "SELECT b.id_peg, b.nama, b.gaji, b.nip, b.tgl, a.password FROM tb_user a JOIN karyawan b ON a.nip=b.nip where username='$_SESSION[username]' order by b.tgl desc")
                or die (mysqli_error($connect));
                $data =mysqli_fetch_array($sql_2);

                ?>
                <h4 class="font-weight-bold mb-0"><?=($data['nama'])?> <span class="text-muted font-weight-normal"></span></h4>
                <hr class="mb-0">
                <div class="text-muted mb-0">Gaji : <?=($data['gaji'])?></div>
                <div class="text-muted mb-1">NIP/NIK : <?=($data['nip'])?></div>
                <a href="look_jp.php" class="btn btn-success btn-sm">JP Umum</a>&nbsp;
                <a href="look_bpjs.php" class="btn btn-success btn-sm">JP BPJS</a>&nbsp;
                <a href="../auth/logout.php" class="btn btn-danger btn-sm">Logout</a>&nbsp;
                <!-- <a href="buat_ijin.php" class="btn btn-success btn-sm">Surat Ijin</a>&nbsp; -->
              </div>
            </div>

            <div class="card md-1">
              <div class="card-body">
                <table class="table table-responsive table-borderless">
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
                    <td><a href ="u_foto.php?id=<?=$_SESSION['id_user']?>"
                       class= "btn btn-warning btn-xs"><i class="bi bi-archive"></i>Update</a>
                      </td>
                    
                  </tbody>
                  <!-- <div class="pull-right">
                  <a href="javascript:void(0)" class="btn btn-primary btn-sm">Edit</a>
                  </div> -->
                </table>
              </div>
              </div>
              <div class="card md-0 card-responsive">
              <div class="card-body">
                <b>Table Gaji</b>
                <hr>
              <div class="table-responsive table-sm">
                <table class="table table-sm table-responsive card-table m-0" id="table_user">
                  <thead>
                    <tr class="table-success">
                      <th>TGL</th>
                      <th>Bersih</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                       $sql = mysqli_query($connect, "SELECT *, b.id_peg, b.nama, b.gaji, b.nip, b.tgl, 
                        (gaji-dansos-iw_korpkab-dapens_korp-simpi_armed-dplk-iw_korp_unit-baznaz_infaq-baznaz_zakat-bank_bpd-bpr_gnsimping-k_bina_sehat-kop_sekar-arisan_sas-bpjs_kes-bpjs_ker-lain-darma)
                          as jml_bersih ,
                          (dansos+iw_korpkab+dapens_korp+simpi_armed+dplk+iw_korp_unit+baznaz_infaq+baznaz_zakat+bank_bpd+bpr_gnsimping+k_bina_sehat+kop_sekar+arisan_sas+bpjs_kes+bpjs_kes+lain) as jml_pot FROM tb_user a JOIN karyawan b ON a.nip=b.nip where username='$_SESSION[username]'")
                                    or die (mysqli_error($connect));
                                    if(mysqli_num_rows($sql)>0)
                                    {
                                        while ($peg =mysqli_fetch_array($sql)){?>
                                            <tr>
                                                <td><?=date('M y', strtotime($peg['tgl']))?></td>
                                                <td><?=number_format($peg['jml_bersih'])?></td>
                                                <td><a href ="look_detail.php?id=<?=$peg['id_peg']?>" 
                                                class= "btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit">detail</i></a>
                                        </td>
                                            </tr> <?php
                                        }
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
         
         $('#table_user').DataTable(
            {
                "lengthMenu": [ [5, 10], [5, 10] ],
                "order": [[ 2, 'desc' ]],
                "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 2 ] }
       ]
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
