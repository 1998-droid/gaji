<?php
include "../koneksi.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data.xlsx';

	// Load librari PHPExcel nya
	require_once '../lib/vendor/autoload.php';
	$excelreader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	
	$loadexcel = $excelreader->load('../tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

	$numrow = 1;
	foreach($sheet as $row){
		// Ambil data pada excel sesuai Kolom
		$tgl = date('y-m-d', strtotime($row['A']));
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
		if($tgl== "" && $nip=="" && $gol=="" && $nama =="" && $gaji =="" && $dansos=="" && $iw_k&&pkab=="" && $dapens_k&&p=="" && $simpi_armed ==""
		&& $dplk =="" && $iw_k&&p_unit =="" && $baznaz_infaq =="" && $baznaz_zakat =="" && $bank_bpd =="" && $bpr_gnsimping =="" 
		&& $k_bina_sehat =="" && $kop_sekar =="" && $arisan_sas =="" && $bpjs_kes =="" && $bpjs_ker =="" && $lain =="" && $darma =="")
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 4){
			// Buat query Insert
			
				$query = "INSERT INTO karyawan (tgl, nip, gol, nama, gaji, dansos, iw_korpkab, dapens_korp, 
				simpi_armed, dplk, iw_korp_unit, baznaz_infaq, baznaz_zakat, 
				bank_bpd, bpr_gnsimping, k_bina_sehat,
				kop_sekar, arisan_sas, bpjs_kes, bpjs_ker, lain, darma) VALUES ('".$tgl."', '".$nip."', '".$gol."', '".$nama."','".$gaji."','".$dansos."',
				 '".$iw_korpkab."','".$dapens_korp."', '".$simpi_armed."', '".$dplk."', 
				 '".$iw_korp_unit."', '".$baznaz_infaq."', '".$baznaz_zakat."',
				  '".$bank_bpd."', '".$bpr_gnsimping."', '".$k_bina_sehat."', 
				  '".$kop_sekar."', '".$arisan_sas."', '".$bpjs_kes."', '".$bpjs_ker."', '".$lain."', '".$darma."')";
				// Eksekusi $query
				mysqli_query($connect, $query) or die (mysqli_error($connect));
			}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: data.php'); // Redirect ke halaman awal
?>
