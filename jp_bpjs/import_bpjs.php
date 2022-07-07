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
         $INDEKS = $row['K'];
         $INDEKSp = $row['L'];
		 $CASEMIX = $row['M'];
         $JP = $row['N'];
         $Pelayanan_indeks = $row['O'];
         $Farmasi_indeks = $row['P'];
         $Pelayanan_langsung = $row['Q'];
         $Farmasi_langsung = $row['R'];
         $Pil_casemix = $row['S'];
         $Pil_jp = $row['T'];
         $Pi_Pelayanan = $row['U'];
         $Pi_Farmasi = $row['V'];
         $Pl_Pelayanan = $row['W'];
         $Pl_Farmasi = $row['X'];
         $Hari_Raya = $row['Y'];
         $PPNI = $row['Z'];
         $POT_BPJS = $row['AA'];
         $ARTHA_MEDIKA = $row['AB'];
         $BINA_SEHAT = $row['AC'];
         $APOTIK = $row['AD'];
         $LAIN = $row['AE'];
         $IP = $row['AF'];
         $IF = $row['AG'];
         $RUANG = $row['AH'];
        
		// Cek jika semua data tidak diisi
		if($tgl== "" && $nip=="" && $nama =="" && $gol =="" 
		&& $gr=="" && $MK=="" && $TJ=="" && $JAB ==""
			&& $TF =="" && $LL =="" && $INDEKS =="" && $INDEKSp =="" && $CASEMIX =="" && $JP ==""
			&& $Pelayanan_indeks =="" && $Farmasi_indeks =="" 
			&& $Pelayanan_langsung =="" && $Farmasi_langsung =="" && $Pil_casemix =="" && $Pil_jp ==""
			&& $Pi_Pelayanan =="" && $Pi_Farmasi =="" && $Pl_Pelayanan =="" && $Pl_Farmasi ==""
			&& $Hari_Raya =="" && $PPNI =="" && $POT_BPJS =="" && $ARTHA_MEDIKA ==""
			&& $BINA_SEHAT =="" && $APOTIK =="" && $LAIN =="" && $IP ==""
			&& $IF =="" && $RUANG =="" )
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 3){
			// Buat query Insert
				$query = "INSERT INTO tb_bpjs (tgl, nip, 
				nama, gol, gr, MK, TJ, 
				JAB, TF, LL, Indeks, Indeks_penyesuaian
				, il_casemix, il_jp,
				Pelayanan_indeks, 
				Farmasi_indeks, Pelayanan_langsung, 
				Farmasi_langsung, pil_casemix, pil_jp, 
				Pelayanan_pi, Farmasi_pi, Pelayanan_pl, 
				Farmasi_pl, Hari_Raya, ppni, 
				pot_bpjs, artha_medika, BinaSehat, apotik_kasir, Lain2, indeks_p,
				indeks_f, ruang) VALUES 
				('".$tgl."', '".$nip."', '".$nama."','".$gol."','".$gr."', '".$MK."',
				 '".$TJ."','".$JAB."', '".$TF."', '".$LL."', 
				 '".$INDEKS."', '".$INDEKSp."', '".$CASEMIX."',
				  '".$JP."','".$Pelayanan_indeks."', 
				  '".$Farmasi_indeks."', '".$Pelayanan_langsung."', 
				  '".$Farmasi_langsung."', '".$Pil_casemix."', '".$Pil_jp."', 
				  '".$Pi_Pelayanan."', '".$Pi_Farmasi."',
				  '".$Pl_Pelayanan."', '".$Pl_Farmasi."',
				  '".$Hari_Raya."', '".$PPNI."', 
				  '".$POT_BPJS."', '".$ARTHA_MEDIKA."', 
				  '".$BINA_SEHAT."', '".$APOTIK."', '".$LAIN."', '".$IP."','".$IF."'
				  ,'".$RUANG."')";
				// Eksekusi $query
				mysqli_query($connect, $query) or die (mysqli_error($connect));
			}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: data_bpjs.php'); // Redirect ke halaman awal
?>
