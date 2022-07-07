<?php
	include "../_header.php";
?>



		<!-- Load File jquery.min.js yang ada difolder js -->
		<script src="js/jquery.min.js"></script>

		<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
		</script>
	

		<!-- Content -->
		<div style="padding: 0 15px;">
			<!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
			<a href="data.php" class="btn btn-danger pull-right">
				<span class="glyphicon glyphicon-remove"></span> Cancel
			</a>

			<h3>Form Import Data</h3>
			<hr>

			<!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
			<form method="post" action="" enctype="multipart/form-data">
				<a href="../tmp/data.xlsx" class="btn btn-default">
					<span class="glyphicon glyphicon-download"></span>
					Download Format
				</a><br><br>

				<!--
				-- Buat sebuah input type file
				-- class pull-left berfungsi agar file input berada di sebelah kiri
				-->
				<input type="file" name="file" class="pull-left">

				<button type="submit" name="preview" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-eye-open"></span> Preview
				</button>
			</form>

			<hr>

			<!-- Buat Preview Data -->
			<?php
			// Jika user telah mengklik tombol Preview
			if(isset($_POST['preview'])){
				//$ip = ; // Ambil IP Address dari User
				$nama_file_baru = 'data.xlsx';

				// Cek apakah terdapat file data.xlsx pada folder tmp
				if(is_file('../tmp/'.$nama_file_baru)) // Jika file tersebut ada
					unlink('../tmp/'.$nama_file_baru); // Hapus file tersebut

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
				$tmp_file = $_FILES['file']['tmp_name'];

				// Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
				if($ext == "xlsx"){
					// Upload file yang dipilih ke folder tmp
					// dan rename file tersebut menjadi data{ip_address}.xlsx
					// {ip_address} diganti jadi ip address user yang ada di variabel $ip
					// Contoh nama file setelah di rename : data127.0.0.1.xlsx
					move_uploaded_file($tmp_file, '../tmp/'.$nama_file_baru);

					// Load librari PHPExcel nya
					require_once '../lib/vendor/autoload.php';

					$excelreader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					$loadexcel = $excelreader->load('../tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

					// Buat sebuah tag form untuk proses import data ke database
					echo "<form method='post' action='import.php'>";
					

					// Buat sebuah div untuk alert validasi kosong
					echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					</div>";

					echo "<table class='table table-bordered'>
					<tr>
						<th colspan='21' class='text-center'>Preview Data</th>
					</tr>
					<tr>
					<th>TGL</th>
					<th>NIK/NIP</th>
					<th>Gol</th>
					<th>NAMA</th>
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
					<th>BPJS kerja</th>
					<th>LAIN-LAIN</th>
					<th>darma</th>
					</tr>";

					$numrow = 1;
					$kosong = 0;
					foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
						// Ambil data pada excel sesuai Kolom
						$tgl = date('d-m-y', strtotime($row['A']));
						$nip = $row['B'];
						$gol = $row['C'];
						$nama = $row['D'];
						$gaji = $row['E']; // Ambil data nama
						$dansos= $row['F']; // Ambil data jenis kelamin
						$iw_korpkab = $row['G']; // Ambil data telepon
						$dapens_korp = $row['H']; // Ambil data alamat
						$simpi_armed = $row['I'];
						$dplk = $row['J'];
						$iw_korp_unit = $row['K'];
						$baznaz_infaq = $row['L'];
						$baznaz_zakat = $row['M'];
						$bank_bpd = $row['N'];
						$bpr_gnsimping = $row['O'];
						$k_bina_sehat = $row['P'];
						$kop_sekar = $row['Q'];
						$arisan_sas = $row['R'];
						$bpjs_kes = $row['S'];
						$bpjs_ker = $row['T'];
						$lain = $row['U'];
						$darma = $row['V'];


						// Cek jika semua data tidak diisi
						if($tgl== "" && $nip=="" && $gol =="" && $nama =="" && $gaji =="" && $dansos=="" && $iw_korpkab=="" && $dapens_korp=="" && $simpi_armed ==""
						&& $dplk =="" && $iw_korp_unit =="" && $baznaz_infaq =="" && $baznaz_zakat =="" && $bank_bpd =="" && $bpr_gnsimping =="" 
						&& $k_bina_sehat =="" && $kop_sekar =="" && $arisan_sas =="" && $bpjs_kes =="" && $bpjs_ker =="" && $lain =="" && $darma =="") 
							continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

						// Cek $numrow apakah lebih dari 1
						// Artinya karena baris pertama adalah nama-nama kolom
						// Jadi dilewat saja, tidak usah diimport
						if($numrow > 4){
							// Validasi apakah semua data telah diisi
							$tgl_td = ( ! empty($tgl))? "" : " style='background: #E07171;'";
							$nip_td = ( ! empty($nip))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
							$gol_td = ( ! empty($gol))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
							$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'";
							$gaji_td = ( ! empty($gaji))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
							$dansos_td = ( ! empty($dansos))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
							$iw_korpkab_td = ( ! empty($iw_korpkab))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
							$dapens_korp_td = ( ! empty($dapens_korp))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$simpi_armed_td = ( ! empty($simpi_armed))? "" : " style='background: #E07171;'";
							$dplk_td = ( ! empty($dplk))? "" : " style='background: #E07171;'";
							$iw_korp_unit_td = ( ! empty($iw_korp_unit))? "" : " style='background: #E07171;'";
							$baznaz_infaq_td = ( ! empty($baznaz_infaq))? "" : " style='background: #E07171;'";
							$baznaz_zakat_td = ( ! empty($baznaz_zakat))? "" : " style='background: #E07171;'";
							$bank_bpd_td = ( ! empty($bank_bpd))? "" : " style='background: #E07171;'";
							$bpr_gnsimping_td = ( ! empty($bpr_gnsimping))? "" : " style='background: #E07171;'";
							$k_bina_sehat_td = ( ! empty($k_bina_sehat))? "" : " style='background: #E07171;'";
							$kop_sekar_td = ( ! empty($kop_sekar))? "" : " style='background: #E07171;'";
							$arisan_sas_td = ( ! empty($arisan_sas))? "" : " style='background: #E07171;'";
							$bpjs_kes_td = ( ! empty($bpjs_kes))? "" : " style='background: #E07171;'";
							$bpjs_ker_td = ( ! empty($bpjs_ker))? "" : " style='background: #E07171;'";
							$lain_td = ( ! empty($lain))? "" : " style='background: #E07171;'";
							$darma_td = ( ! empty($darma))? "" : " style='background: #E07171;'";

							// Jika salah satu data ada yang kosong
							if( $tgl== "" or $nip=="" or $gol=="" or $nama =="" or $gaji =="" or $dansos=="" or $iw_korpkab=="" or $dapens_korp=="" or $simpi_armed ==""
							or $dplk =="" or $iw_korp_unit =="" or $baznaz_infaq =="" or $baznaz_zakat =="" or $bank_bpd =="" or $bpr_gnsimping =="" 
							or $k_bina_sehat =="" or $kop_sekar =="" or $arisan_sas =="" or $bpjs_kes =="" or $bpjs_ker =="" or $lain =="" or $darma ==""){
								$kosong++; // Tambah 1 variabel 
							}

							echo "<tr>";
							echo "<td".$tgl_td.">".$tgl."</td>";
							echo "<td".$nip_td.">".$nip."</td>";
							echo "<td".$gol_td.">".$gol."</td>";
							echo "<td".$nama_td.">".$nama."</td>";
							echo "<td".$gaji_td.">".$gaji."</td>";
							echo "<td".$dansos_td.">".$dansos."</td>";
							echo "<td".$iw_korpkab_td.">".$iw_korpkab."</td>";
							echo "<td".$dapens_korp_td.">".$dapens_korp."</td>";
							echo "<td".$simpi_armed_td.">".$simpi_armed."</td>";
							echo "<td".$dplk_td.">".$dplk."</td>";
							echo "<td".$iw_korp_unit_td.">".$iw_korp_unit."</td>";
							echo "<td".$baznaz_infaq_td.">".$baznaz_infaq."</td>";
							echo "<td".$baznaz_zakat_td.">".$baznaz_zakat."</td>";
							echo "<td".$bank_bpd_td.">".$bank_bpd."</td>";
							echo "<td".$bpr_gnsimping_td.">".$bpr_gnsimping."</td>";
							echo "<td".$k_bina_sehat_td.">".$k_bina_sehat."</td>";
							echo "<td".$kop_sekar_td.">".$kop_sekar."</td>";
							echo "<td".$arisan_sas_td.">".$arisan_sas."</td>";
							echo "<td".$bpjs_kes_td.">".$bpjs_kes."</td>";
							echo "<td".$bpjs_ker_td.">".$bpjs_ker."</td>";
							echo "<td".$lain_td.">".$lain."</td>";
							echo "<td".$darma_td.">".$darma."</td>";
							echo "</tr>";
						}
						$numrow++; // Tambah 1 setiap kali looping
					}

					echo "</table>";
					echo "<br>";

					// Cek apakah variabel kosong lebih dari 1
					// Jika lebih dari 1, berarti ada data yang masih kosong
					if($kosong > 1){
					?>
						<script>
						$(document).ready(function(){
							// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');

							$("#kosong").show(); // Munculkan alert validasi kosong
						});
						</script>
						<?php 
						echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
						?>
						<?php
					}else{ // Jika semua data sudah diisi
						echo "<hr>";

						// Buat sebuah tombol untuk mengimport data ke database?>
						<!-- <button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button> -->
						<div></div>
						<button type="submit" name="import" class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>
						<?php
					}

					echo "</form>";
				}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					// Munculkan pesan validasi
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					</div>";
				}
			}
			?>
		</div>
	</body>
</html>
