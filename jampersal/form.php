<?php
    include "../_header_jp.php";
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
            <a href="data_jam.php" class="btn btn-danger pull-right">
                <span class="glyphicon glyphicon-remove"></span> Cancel
            </a>

            <h3>Form Import Data</h3>
            <hr>

            <!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
            <form method="post" action="" enctype="multipart/form-data">
                <!-- <a href="Format.xlsx" class="btn btn-default">
                    <span class="glyphicon glyphicon-download"></span>
                    Download Format
                </a><br><br> -->

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

                    echo "<table class='table table-bordered' id='form'>
                    <thead>
                        <th colspan='32' class='text-center'>Preview Data</th>
                    </thead>
                    <thead>
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
                    <th>Indeks_penyesuaian</th>
                    <th>Pelayanan_indeks</th>
                    <th>Farmasi_indeks</th>
                    <th>Pelayanan_langsung</th>
                    <th>Farmasi_langsung</th>
                    <th>Pelayanan_pi</th>
                    <th>Farmasi_pi</th>
                    <th>Pelayanan_pl</th>
                    <th>Farmasi_pl</th>
                    <th>Hari_Raya</th>
                    <th>Kurban</th>
                    <th>POT_BINA_SEHAT</th>
                    <th>RUANGAN</th>
                    <th>ARISAN_KARU </th>
                    <th>POT_ARTHA_MEDIKA </th>
                    <th>Lain2 </th>
                    <th>Ip</th>
                    <th>If</th>
                    
                    </thead>";

                    ?><tbody><?php
                    $numrow = 1;
                    $kosong = 0;
                    foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
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
                       
                        // Cek jika semua data tidak diisi
                        if($tgl== "" && $nip=="" && $nama =="" && $gol =="" && $gr=="" && $MK=="" && $TJ=="" && $JAB ==""
                            && $TF =="" && $LL =="" && $Indeks =="" && $Indeks_penyesuaian =="" && $Pelayanan_indeks =="" 
                            && $Farmasi_indeks =="" && $Pelayanan_langsung =="" && $Farmasi_langsung ==""  
                            && $Farmasi_pi =="" && $Pelayanan_pl =="" && $Farmasi_pl =="" 
                            && $Hari_Raya =="" && $Kurban =="" && $POT_BINA_SEHAT =="" && $RUANGAN =="" 
                            && $ARISAN_KARU =="" && $POT_ARTHA_MEDIKA =="" && $Lain2 ==""  && $ip ==""  && $if =="")
                            continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                        // Cek $numrow apakah lebih dari 1
                        // Artinya karena baris pertama adalah nama-nama kolom
                        // Jadi dilewat saja, tidak usah diimport
                        if($numrow > 3){
                            // Validasi apakah semua data telah diisi
                            $tgl_td = ( ! empty($tgl))? "" : " style='background: #E07171;'";
                            $nip_td = ( ! empty($nip))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                            $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'";
                            $gol_td = ( ! empty($gol))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            $gr_td = ( ! empty($gr))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            $MK_td = ( ! empty($MK))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
                            $TJ_td = ( ! empty($TJ))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                            $JAB_td = ( ! empty($JAB))? "" : " style='background: #E07171;'";
                            $TF_td = ( ! empty($TF))? "" : " style='background: #E07171;'";
                            $LL_td = ( ! empty($LL))? "" : " style='background: #E07171;'";
                            $Indeks_td = ( ! empty($Indeks))? "" : " style='background: #E07171;'";
                            $Indeks_penyesuaian_td = ( ! empty($Indeks_penyesuaian))? "" : " style='background: #E07171;'";
                            $Pelayanan_indeks_td = ( ! empty($Pelayanan_indeks))? "" : " style='background: #E07171;'";
                            $Farmasi_indeks_td = ( ! empty($Farmasi_indeks))? "" : " style='background: #E07171;'";
                            $Pelayanan_langsung_td = ( ! empty($Pelayanan_langsung))? "" : " style='background: #E07171;'";
                            $Farmasi_langsung_td = ( ! empty($Farmasi_langsung))? "" : " style='background: #E07171;'";
                            $Pelayanan_pi_td = ( ! empty($Pelayanan_pi))? "" : " style='background: #E07171;'";
                            $Farmasi_pi_td = ( ! empty($Farmasi_pi))? "" : " style='background: #E07171;'";
                            $Pelayanan_pl_td = ( ! empty($Pelayanan_pl))? "" : " style='background: #E07171;'";
                            $Farmasi_pl_td = ( ! empty($Farmasi_pl))? "" : " style='background: #E07171;'";
                            $Hari_Raya_td = ( ! empty($Hari_Raya))? "" : " style='background: #E07171;'";
                            $Kurban_td = ( ! empty($Kurban))? "" : " style='background: #E07171;'";
                            $POT_BINA_SEHAT_td = ( ! empty($POT_BINA_SEHAT))? "" : " style='background: #E07171;'";
                            $RUANGAN_td = ( ! empty($RUANGAN))? "" : " style='background: #E07171;'";
                            $ARISAN_KARU_td = ( ! empty($ARISAN_KARU ))? "" : " style='background: #E07171;'";
                            $POT_ARTHA_MEDIKA_td = ( ! empty($POT_ARTHA_MEDIKA))? "" : " style='background: #E07171;'";
                            $Lain2_td = ( ! empty($Lain2))? "" : " style='background: #E07171;'";
                            $ip_td = ( ! empty($ip))? "" : " style='background: #E07171;'";
                            $if_td = ( ! empty($if))? "" : " style='background: #E07171;'";

                            // Jika salah satu data ada yang kosong
                            if($tgl== "" or $nip=="" or $nama =="" or $gol =="" or $gr=="" or $MK=="" or $TJ=="" or $JAB ==""
                            or $TF =="" or $LL =="" or $Indeks =="" or $Indeks_penyesuaian =="" or $Pelayanan_indeks =="" 
                            or $Farmasi_indeks =="" or $Pelayanan_langsung =="" 
                            or $Farmasi_langsung =="" or $Pelayanan_pi =="" 
                            or $Farmasi_pi =="" or $Pelayanan_pl =="" or $Farmasi_pl =="" 
                            or $Hari_Raya =="" or $Kurban =="" or $POT_BINA_SEHAT =="" or $RUANGAN =="" 
                            or $ARISAN_KARU =="" or $POT_ARTHA_MEDIKA =="" or $Lain2 =="" or $ip ==""  or $if ==""){
                                $kosong++; // Tambah 1 variabel 
                            }

                            echo "<tr>";
                            echo "<td".$tgl_td.">".$tgl."</td>";
                            echo "<td".$nip_td.">".$nip."</td>";
                            echo "<td".$nama_td.">".$nama."</td>";
                            echo "<td".$gol_td.">".$gol."</td>";
                            echo "<td".$gr_td.">".$gr."</td>";
                            echo "<td".$MK_td.">".$MK."</td>";
                            echo "<td".$TJ_td.">".$TJ."</td>";
                            echo "<td".$JAB_td.">".$JAB."</td>";
                            echo "<td".$TF_td.">".$TF."</td>";
                            echo "<td".$LL_td.">".$LL."</td>";
                            echo "<td".$Indeks_td.">".$Indeks."</td>";
                            echo "<td".$Indeks_penyesuaian_td.">".$Indeks_penyesuaian."</td>";
                            echo "<td".$Pelayanan_indeks_td.">".$Pelayanan_indeks."</td>";
                            echo "<td".$Farmasi_indeks_td.">".$Farmasi_indeks."</td>";
                            echo "<td".$Pelayanan_langsung_td.">".$Pelayanan_langsung."</td>";
                            echo "<td".$Farmasi_langsung_td.">".$Farmasi_langsung."</td>";
                            echo "<td".$Pelayanan_pi_td.">".$Pelayanan_pi."</td>";
                            echo "<td".$Farmasi_pi_td.">".$Farmasi_pi."</td>";
                            echo "<td".$Pelayanan_pl_td.">".$Pelayanan_pl."</td>";
                            echo "<td".$Farmasi_pl_td.">".$Farmasi_pl."</td>";
                            echo "<td".$Hari_Raya_td.">".$Hari_Raya."</td>";
                            echo "<td".$Kurban_td.">".$Kurban."</td>";
                            echo "<td".$POT_BINA_SEHAT_td.">".$POT_BINA_SEHAT."</td>";
                            echo "<td".$RUANGAN_td.">".$RUANGAN."</td>";
                            echo "<td".$ARISAN_KARU_td.">".$ARISAN_KARU."</td>";
                            echo "<td".$POT_ARTHA_MEDIKA_td.">".$POT_ARTHA_MEDIKA."</td>";
                            echo "<td".$Lain2_td.">".$Lain2."</td>";
                            echo "<td".$ip_td.">".$ip."</td>";
                            echo "<td".$if_td.">".$if."</td>";
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
                        $('#form').DataTable(
            {
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            //  dom:'lBfrtip',
            //  button:['print'],
         }
        
          )} );
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
