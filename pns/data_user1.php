<?php
    include "../_header.php";
?>
<div style="padding: 0 15px;">
<div class="pull-right">
                  <a onclick="history.back();" class="btn btn-primary btn-sm">Back</a>
                  </div>
			<h3>Data User</h3>
	<hr>
    <div class="table-responsive">
    <table class="table table-striped table-bordered tabel-hover" id="d_user">
    <thead>
        <th>No</th>
        <th>Username</th>
        <th>Password</th>
        <th>Hak akses</th>
        <th>Rekening</th>
        <th>Status</th>
        <th>Opsi</th>
        <!-- <th>Ruangan</th> -->
    </thead>
    <tbody>
        <?php
            $sql_user = mysqli_query($connect, "SELECT * FROM tb_user") or die (mysqli_error($connet));
            $no=1;
            while($data=mysqli_fetch_array($sql_user)){?>
                <tr>
                 <td><?=$no++?></td>
                 <td><?=$data['username']?></td>
                 <td><?=$data['password']?></td>
                 <td><?=$data['hak_akses']?></td>
                 <td><?=$data['nip']?></td>
                 <td><?=$data['status']?></td>
                 <td class="text-center">
                    <a href ="del.php?id=<?=$data['id_user']?>" onclick ="return confirm ('Yakin Hapus Data ?')" class= "btn btn-danger btn-xs">
                    <i class="glyphicon glyphicon-trash"></i></a>
                    <a href ="edit.php?id=<?=$data['id_user']?>"  class= "btn btn-warning btn-xs">
                    <i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                </tr><?php
            }
        ?>
    </tbody>
    
    </table>
    <div class="pull-right">
    <a href="add.php" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
    <span class="glyphicon glyphicon-th-list"></span></a>
     </div>
     <div class="modal fade" id="myModal" role="dialog">
           <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            </div>
            </div>
            </div>
            </div>
    <script>
        $(document).ready(function(){
         
         $('#d_user').DataTable(
            {
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            //  dom:'lBfrtip',
            //  button:['print'],
         }
          )} );

          $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
    </script>
    </div>
</div>