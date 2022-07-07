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
		$nip = $row['A'];
		$ruang = $row['B'];
		
		

		// Cek jika semua data tidak diisi
		if($nip=="" && $ruang=="" )
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 4){
			// Buat query Insert
			
				$query = "INSERT INTO tb_peg (nik, ruang_peg) VALUES ('".$nip."', '".$ruang."')";
				// Eksekusi $query
				mysqli_query($connect, $query) or die (mysqli_error($connect));
			}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: form_peg.php'); // Redirect ke halaman awal
?>
