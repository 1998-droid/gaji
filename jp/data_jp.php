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
                    <th>Pelayanan indeks</th>
                    <th>Farmasi indeks</th>
                    <th>Pelayanan langsung</th>
                    <th>Farmasi langsung</th>
					<th>Total indeks</th>
                    <th>Pelayanan pi</th>
                    <th>Farmasi pi</th>
                    <th>Pelayanan pl</th>
                    <th>Farmasi pl</th>
					<th>Total PPH</th>
					<th>Diterimakan</th>
                    <th>Hari Raya</th>
                    <th>Kurban</th>
                    <th>POT BINA SEHAT</th>
                    <th>RUANGAN</th>
                    <th>ARISAN KARU </th>
                    <th>POT ARTHA MEDIKA </th>
					<th>Lain2</th>
					<th>T Potongan</th>
					<th>Neto</th>
					<th>Ip</th>
					<th>If</th>
				</thead>
                <tbody>
					<?php
					// Load file koneksi.php
					
					// Buat query untuk menampilkan semua data siswa
					$bulan = mysqli_query($connect, "SELECT tgl FROM tb_jp where tgl='2021-07-10' order by tgl asc");
					$sql = mysqli_query($connect, "SELECT *, 
					(Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+Farmasi_langsung) as total_indeks, 
					(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl) as t_pph, ((Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+
					Farmasi_langsung)-(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)) as bersih, 
					(Hari_Raya+Kurban+POT_BINA_SEHAT+Lain2) AS t_pot,
					((Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+
					Farmasi_langsung)-(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)-(Hari_Raya+Kurban+POT_BINA_SEHAT+Lain2)) as neto
					 FROM tb_jp order by tgl asc") 
					or die (mysqli_error($connect));
					
					while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
						echo "<tr>";
						echo "<td><input type='checkbox' class='check-item' name='nis[]' value='".$data['id_jp']."'></td>";
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
						echo "<td>".($data['Pelayanan_indeks'])."</td>";
						echo "<td>".($data['Farmasi_indeks'])."</td>";
						echo "<td>".($data['Pelayanan_langsung'])."</td>";
						echo "<td>".($data['Farmasi_langsung'])."</td>";
						echo "<td>".($data['total_indeks'])."</td>";
						echo "<td>".($data['Pelayanan_pi'])."</td>";
						echo "<td>".($data['Farmasi_pi'])."</td>";
						echo "<td>".($data['Pelayanan_pl'])."</td>";
						echo "<td>".$data['Farmasi_pl']."</td>";
						echo "<td>".($data['t_pph'])."</td>";
						echo "<td>".($data['bersih'])."</td>";
						echo "<td>".$data['Hari_Raya']."</td>";
						echo "<td>".$data['Kurban']."</td>";
						echo "<td>".$data['POT_BINA_SEHAT']."</td>";
						echo "<td>".$data['RUANGAN']."</td>";
						echo "<td>".$data['ARISAN_KARU']."</td>";
						echo "<td>".$data['POT_ARTHA_MEDIKA']."</td>";
						echo "<td>".$data['Lain2']."</td>";
						echo "<td>".($data['t_pot'])."</td>";
						echo "<td>".($data['neto'])."</td>";
						echo "<td>".$data['indeks_p']."</td>";
						echo "<td>".$data['indeks_f']."</td>";
						echo "</tr>";
						
					}
					?>
					</tbody>
				</table>
				<button type="button" id="btn-delete" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span> DELETE</button>
				<hr>
				</form>
				<!-- <div style="width: 500px;height: 500px">
		<canvas id="myChart"></canvas>
	</div> -->
	<div class="container">
            <canvas id="myChart" width="100" height="100"></canvas>
        </div>
		<?php
		$bulan = mysqli_query($connect, "SELECT tgl FROM tb_jp where tgl='2021-07-10' order by tgl asc");
		$penghasilan = mysqli_query($connect, "SELECT Indeks_penyesuaian FROM tb_jp WHERE tgl='2021' order by id asc");
		?>
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
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
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

<script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($b = mysqli_fetch_array($penghasilan)) { echo '"' . $b['tgl'] . '",';}?>],
                    datasets: [{
                            label: '# of Votes',
                            data: [<?php while ($p = mysqli_fetch_array($bulan)) { echo '"' . $p['tgl'] . '",';}?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
			</div>
		</div>
	</body>
</html>
