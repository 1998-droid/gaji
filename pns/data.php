<?php
include "../_header.php";
if(!isset($_SESSION['id_user'])){
    die("<b>Oops!</b> Access Failed.
        <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
        <button type='button' onclick=location.href='./'>Back</button>");
}
if($_SESSION['hak_akses']!="petugas"){
    die("<b>Oops!</b> Access Failed.
        <p>Anda Bukan Pegawai.</p>
        <button type='button' onclick=location.href='./'>Back</button>");
}
?>
		<!-- Content -->
      <!--
      -- col-xs-12 artinya jika ukuran layar < 768px, maka gunakan 12 kolom
      -- col-sm-6 artinya jika ukuran layar >= 768px, maka gunakan 6 kolom
      -- Untuk lebih jelasnya soal Grid, silahkan buka link ini : http://viid.me/qb4V8P
      -->
      
		<div style="padding: 0 15px;">
			<a href="form.php" class="btn btn-success pull-right">
				<span class="glyphicon glyphicon-upload"></span> Import Data
			</a>
			<h3>Data Hasil Import PNS</h3>
			
			<hr>
			
			<!-- Buat sebuah div dan beri class table-responsive agar tabel jadi responsive -->
			<div class="table-responsive">
			<form method="post" action="delete.php" id="form-delete">
				<table class="table table-xs table-bordered tabel-hover" id="pns">
				<thead>
						<th><input type="checkbox" id="check-all"></th>
						<th>Tanggal</th>
						<th>Nip/Nik</th>
						<th>Gol</th>
						<th>Nama</th>
						<th>Gaji</th>
						<th>DANSOS KORPRI</th>
						<th>iw_korpkab</th>
						<th>dapens_korp</th>
						<th>SIMPI ARMED</th>
						<th>DPLK</th>
						<th>IW.KORPRI UNIT</th>
						<th>BAZNAS INFAQ</th>
						<th>BAZNAS ZAKAT</th>
						<th>BANK BPD</th>
						<th>BPR GN.SIMPING</th>
						<th>KOP BINA SEHAT</th>
						<th>KOP SEKAR</th>
						<th>ARISAN SAS</th>
						<th>BPJS KESEHATAN</th>
						<th>BPJS KER</th>
						<th>Darma wanita</th>
						<th>LAIN-LAIN</th>
						<th>J. Potongan</th>
						<th>J. Bersih</th>
					</thead>
					<tbody>
					<?php
					// Load file koneksi.php
					
					// Buat query untuk menampilkan semua data siswa
					$sql = mysqli_query($connect, "SELECT *, 
					(gaji-dansos-iw_korpkab-dapens_korp-simpi_armed-dplk-iw_korp_unit-baznaz_infaq-baznaz_zakat-bank_bpd-bpr_gnsimping-k_bina_sehat-kop_sekar-arisan_sas-bpjs_kes-bpjs_ker-lain-darma) as jml_bersih, 
					(dansos+iw_korpkab+dapens_korp+simpi_armed+dplk+iw_korp_unit+baznaz_infaq+baznaz_zakat+bank_bpd+bpr_gnsimping+k_bina_sehat+kop_sekar+arisan_sas+bpjs_kes+bpjs_ker+lain+darma) as jml_pot  FROM karyawan") 
					or die (mysqli_error($connect));
					 // Untuk penomoran tabel, di awal set dengan 1
					$total_pot=0;
					$total_ber=0;
					while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
						echo "<tr>";
						echo "<td><input type='checkbox' class='check-item' name='nis[]' value='".$data['id_peg']."'></td>";
						echo "<td>".date('j M y', strtotime($data['tgl']))."</td>";
						echo "<td>".($data['nip'])."</td>";
						echo "<td>".$data['gol']."</td>";
						echo "<td>".$data['nama']."</td>";
						echo "<td>".$data['gaji']."</td>";
						echo "<td>".$data['dansos']."</td>";
						echo "<td>".$data['iw_korpkab']."</td>";
						echo "<td>".$data['dapens_korp']."</td>";
						echo "<td>".$data['simpi_armed']."</td>";
						echo "<td>".$data['dplk']."</td>";
						echo "<td>".$data['iw_korp_unit']."</td>";
						echo "<td>".$data['baznaz_infaq']."</td>";
						echo "<td>".$data['baznaz_zakat']."</td>";
						echo "<td>".$data['bank_bpd']."</td>";
						echo "<td>".$data['bpr_gnsimping']."</td>";
						echo "<td>".$data['k_bina_sehat']."</td>";
						echo "<td>".$data['kop_sekar']."</td>";
						echo "<td>".$data['arisan_sas']."</td>";
						echo "<td>".$data['bpjs_kes']."</td>";
						echo "<td>".$data['bpjs_ker']."</td>";
						echo "<td>".$data['darma']."</td>";
						echo "<td>".$data['lain']."</td>";
						echo "<td>".number_format($data['jml_pot'], 0, ',', '.')."</td>";
						echo "<td>".number_format($data['jml_bersih'], 0, ',', '.')."</td>";
						echo "</tr>";
						$total_pot += $data['jml_pot'];
						$total_ber += $data['jml_bersih'];
					}
					echo "</tbody>";
					// $sql1 = mysqli_query($connect, "SELECT sum(gaji) as total_gaji, sum(dansos) as total_dansos
					// ,sum(simpi_armed) as total_simpi, sum(iw_korpkab) as total_iwkorkab, 
					// sum(dapens_korp) as total_dapens, sum(dplk) as total_dplk, sum(iw_korp_unit) as t_iwkorpunit, 
					// sum(baznaz_infaq) as t_baznaz_infaq, sum(baznaz_zakat) as t_baznaz_zakat, 
					// sum(bank_bpd) as t_bpd, sum(bpr_gnsimping) as t_gnsimping, sum(k_bina_sehat) as t_sehat, 
					// sum(kop_sekar) as t_sekar, sum(arisan_sas) as t_arisan, sum(bpjs_kes) as t_bpjs, sum(bpjs_ker) as  t_ker,sum(lain) as t_lain FROM karyawan") 
					// or die (mysqli_error($connect));
					// $data = mysqli_fetch_array($sql1);
					// echo "<tr>";
					// echo "<td colspan='4'><center>JUMLAH</td>";
					// echo "<td>"."<center>".number_format($data['total_gaji'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['total_dansos'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['total_iwkorkab'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['total_dapens'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['total_simpi'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['total_dplk'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_iwkorpunit'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_baznaz_infaq'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_baznaz_zakat'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_bpd'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_gnsimping'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_sehat'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_sekar'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_arisan'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_bpjs'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_ker'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($data['t_lain'], 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($total_pot, 0, ',', '.')."</td>";
					// echo "<td>"."<center>".number_format($total_ber, 0, ',', '.')."</td>";
					// echo "</tr>";
					?>
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
         
         $('#pns').DataTable(
            {
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
             dom:'lBfrtip',
			 buttons: [
				'copy', 'csv', 'excel', 'colvis'
        ],
			 "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0,1,21,22 ] }
       ]
        //      button:['print'],
		// 	 "aoColumnDefs": [
        //   { 'bSortable': false, 'aTargets': [ 0,1,21,22 ],
		// 	'bPrintable': false, 'aTargets': [ 0,1,21,22 ] }
		// 	 ]
		// 	 "columnDefs": [
        //     {
        //         "targets": [ 1 ],
        //         "searchable": false
        //     },
        //     {
        //         "targets": [ 21 ],
		// 		"printable": false,
		// 		"searchable": false
        //     },
		// 	{
        //         "targets": [ 22 ],
		// 		"printable": false,
		// 		"searchable": false
        //     }
        // ]
         }
        
          )} );
  				</script>
			</div>
		</div>
	</body>
</html>

