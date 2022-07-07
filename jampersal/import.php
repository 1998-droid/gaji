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
		$nama = $row['C'];
		$gol = $row['D']; // Ambil data nama
		$gr= $row['E']; // Ambil data jenis kelamin
		$MK = $row['F']; // Ambil data telepon
		$TJ = $row['G']; // Ambil data alamat
		$JAB = $row['H'];
		$TF = $row['I'];
		$LL = $row['J'];
		$Indeks = $row['K'];
		$Indeks_penyesuaian = $row['L'];
		$Pelayanan_indeks = $row['M'];
		$Farmasi_indeks = $row['N'];
		$Pelayanan_langsung = $row['O'];
		$Farmasi_langsung = $row['P'];
		$Pelayanan_pi = $row['Q'];
		$Farmasi_pi = $row['R'];
		$Pelayanan_pl = $row['S'];
		$Farmasi_pl	 = $row['T'];
		$Hari_Raya = $row['U'];
		$Kurban = $row['V'];
		$POT_BINA_SEHAT	 = $row['W'];
		$RUANGAN = $row['X'];
		$ARISAN_KARU = $row['Y'];
		$POT_ARTHA_MEDIKA = $row['Z'];
		$Lain2 = $row['AA'];
		$ip = $row['AB'];
		$if = $row['AC'];
		// $ruang = $row['AD'];
		// Cek jika semua data tidak diisi
		if($tgl== "" && $nip=="" && $nama =="" && $gol =="" && $gr=="" && $MK=="" && $TJ=="" && $JAB ==""
		&& $TF =="" && $LL =="" && $Indeks =="" && $Indeks_penyesuaian =="" && $Pelayanan_indeks =="" 
		&& $Farmasi_indeks =="" &&$Pelayanan_langsung =="" && $Farmasi_langsung ==""
		&& $Farmasi_pi =="" && $Pelayanan_pl =="" && $Farmasi_pl =="" 
		&& $Hari_Raya =="" && $Kurban =="" && $POT_BINA_SEHAT =="" && $RUANGAN =="" 
		&& $ARISAN_KARU =="" && $POT_ARTHA_MEDIKA =="" && $Lain2 ==""  && $ip ==""  && $if =="" )
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 3){
			// Buat query Insert
				$query = "INSERT INTO tb_jam (tgl, nip, nama, gol, gr, MK, TJ, 
				JAB, TF, LL, Indeks, Indeks_penyesuaian, 
				Pelayanan_indeks, Farmasi_indeks, Pelayanan_langsung, Farmasi_langsung, 
				Pelayanan_pi, Farmasi_pi, Pelayanan_pl, Farmasi_pl, Hari_Raya, Kurban, POT_BINA_SEHAT, RUANGAN, ARISAN_KARU, 
				POT_ARTHA_MEDIKA, Lain2, indeks_p, indeks_f) VALUES ('".$tgl."', '".$nip."', '".$nama."','".$gol."','".$gr."', '".$MK."',
				 '".$TJ."','".$JAB."', '".$TF."', '".$LL."', 
				 '".$Indeks."', '".$Indeks_penyesuaian."', '".$Pelayanan_indeks."',
				  '".$Farmasi_indeks."','".$Pelayanan_langsung."', 
				  '".$Farmasi_langsung."', '".$Pelayanan_pi."', 
				  '".$Farmasi_pi."', '".$Pelayanan_pl."', '".$Farmasi_pl."', '".$Hari_Raya."', '".$Kurban."'
				  , '".$POT_BINA_SEHAT."', '".$RUANGAN."', '".$ARISAN_KARU."', '".$POT_ARTHA_MEDIKA."', '".$Lain2."', '".$ip."', '".$if."')";
				// Eksekusi $query
				mysqli_query($connect, $query) or die (mysqli_error($connect));
			}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: data_jam.php'); // Redirect ke halaman awal
?>
