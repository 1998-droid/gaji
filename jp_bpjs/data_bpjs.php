<?php
include "../_header_jp.php";
if(!isset($_SESSION['id_user'])){
    die("<b>Oops!</b> Access Failed.
        <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
        <button type='button' onclick=location.href='./'>Back</button>");
}
if($_SESSION['hak_akses']!="jp"){
    die("<b>Oops!</b> Access Failed.
        <p>Anda Bukan Pegawai.</p>
        <button type='button' onclick=location.href='./'>Back</button>");
}
?>
<div style="padding: 0 15px;">
<a href="form.php" class="btn btn-success pull-right">
<span class="glyphicon glyphicon-upload"></span> Import Data
</a>
			<h3>Data Hasil Import JP</h3>
			<hr>
			
			<!-- Buat sebuah div dan beri class table-responsive agar tabel jadi responsive -->
			<div class="table-responsive">
			<form method="post" action="del.php" id="form-delete">
				<table class="table table-bordered table-xs tabel-hover table-responsive"  style="width:50%" id="jp">
				<thead>
					<th><input type="checkbox" id="check-all"></th>
					<th>TGL</th>
                    <th>NIP/NIK</th>
                    <th>Nama</th>
                    <th>gol</th>
                    <th>gr</th>
                    <th>MK</th>
                    <th>TJ</th>
                    <th>JAB</th>
                    <th>TF</th>
                    <th>LL</th>
                    <th>Indeks</th>
					<th>Indeks penyesuaian</th>
                    <th>Casemix</th>
                    <th>Jp</th>
                    <th>Pelayanan indeks</th>
                    <th>Farmasi indeks</th>
                    <th>Pelayanan langsung</th>
                    <th>Farmasi langsung</th>
					<th>Total indeks</th>
					<th>Pil casemix</th>
                    <th>Pil jp</th>
                    <th>Pelayanan pi</th>
                    <th>Farmasi pi</th>
                    <th>Pelayanan pl</th>
                    <th>Farmasi pl</th>
					<th>Total PPH</th>
					<th>Diterimakan</th>
                    <th>Hari Raya</th>
                    <th>ppni</th>
                    <th>Bpjs</th>
					<th>ARTHA MEDIKA</th>
                    <th>POT BINA SEHAT</th>
                    <th>Apotik</th>
					<th>Lain2</th>
					<th>T Potongan</th>
					<th>Neto</th>
					<th>Ip</th>
					<th>If</th>
					<th>Ruang</th>
                    
				</thead>
                <tbody>
					<?php
					// Load file koneksi.php
					
					// Buat query untuk menampilkan semua data siswa
					$sql = mysqli_query($connect, "SELECT *, 
					((il_casemix+il_jp)+(Pelayanan_indeks+Farmasi_indeks)+(Pelayanan_langsung+Farmasi_langsung)) as total_indeks, 
					(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl) as t_pph, ((Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+
					Farmasi_langsung)-(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)) as bersih, 
					(Hari_Raya+Lain2) AS t_pot,
					((Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+
					Farmasi_langsung)-(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)-(Hari_Raya+Lain2)) as neto
					 FROM tb_bpjs order by nama asc") 
					or die (mysqli_error($connect));
					
					while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
						echo "<tr>";
						echo "<td><input type='checkbox' class='check-item' name='nis[]' value='".$data['id_bpjs']."'></td>";
						echo "<td>".date('j M y', strtotime($data['tgl']))."</td>";
						echo "<td>".$data['nip']."</td>";
						echo "<td>".$data['nama']."</td>";
						echo "<td>".$data['gol']."</td>";
						echo "<td>".$data['gr']."</td>";
						echo "<td>".$data['MK']."</td>";
						echo "<td>".$data['TJ']."</td>";
						echo "<td>".$data['JAB']."</td>";
						echo "<td>".$data['TF']."</td>";
						echo "<td>".$data['LL']."</td>";
						echo "<td>".$data['Indeks']."</td>";
						echo "<td>".$data['Indeks_penyesuaian']."</td>";
						echo "<td>".$data['il_casemix']."</td>";
                        echo "<td>".$data['il_jp']."</td>";
						echo "<td>".($data['Pelayanan_indeks'])."</td>";
						echo "<td>".($data['Farmasi_indeks'])."</td>";
						echo "<td>".($data['Pelayanan_langsung'])."</td>";
						echo "<td>".($data['Farmasi_langsung'])."</td>";
						echo "<td>".($data['total_indeks'])."</td>";
						echo "<td>".($data['pil_casemix'])."</td>";
						echo "<td>".($data['pil_jp'])."</td>";
						echo "<td>".($data['Pelayanan_pi'])."</td>";
						echo "<td>".($data['Farmasi_pi'])."</td>";
						echo "<td>".($data['Pelayanan_pl'])."</td>";
						echo "<td>".$data['Farmasi_pl']."</td>";
						echo "<td>".($data['t_pph'])."</td>";
						echo "<td>".($data['bersih'])."</td>";
						echo "<td>".$data['Hari_Raya']."</td>";
                        echo "<td>".$data['ppni']."</td>";
						echo "<td>".$data['pot_bpjs']."</td>";
						echo "<td>".$data['artha_medika']."</td>";
						echo "<td>".$data['BinaSehat']."</td>";
						echo "<td>".$data['apotik_kasir']."</td>";
						echo "<td>".$data['Lain2']."</td>";
						echo "<td>".($data['t_pot'])."</td>";
						echo "<td>".($data['neto'])."</td>";
						echo "<td>".$data['indeks_p']."</td>";
						echo "<td>".$data['indeks_f']."</td>";
						echo "<td>".$data['ruang']."</td>";
                        
						echo "</tr>";
						
					}
					?>
					</tbody>
				</table>
				<button type="button" id="btn-delete" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span> DELETE</button>
				<hr>
				</form>
            <script>
					$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
					$("#check-all").click(function(){ // Ketika user men-cek checkbox all
					if($(this).is(":checked")) // Jika checkbox all diceklis
						$(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
					else // Jika checkbox all tidak diceklis
						$(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
					});
					
					$("#btn-delete").click(function(){ // Ketika user mengklik tombol delete
					var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi
					
					if(confirm) // Jika user mengklik tombol "Ok"
						$("#form-delete").submit(); // Submit form
					});
				});

				$(document).ready(function(){
         
         $('#jp').DataTable(
            {
                "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
             dom:'lBfrtip', 
             buttons: [
				'copy', 'csv', 'excel', 'colvis'
        ],
			 "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0,1 ] }
       ]
         }
        
          )} );
  				</script>
			</div>
		</div>
	</body>
</html>
