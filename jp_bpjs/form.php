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
            <a href="data_bpjs.php" class="btn btn-danger pull-right">
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
                    echo "<form method='post' action='import_bpjs.php'>";

                    // Buat sebuah div untuk alert validasi kosong
                    echo "<div class='alert alert-danger' id='kosong'>
                    Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                    </div>";

                    echo "<table class='table table-bordered' id='form'>
                    <thead>
                        <th colspan='60' class='text-center'>Preview Data</th>
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
                    <th>INDEKS</th>
                    <th>jp</th>
                    <th>CASEMIX</th>
                    <th>INDEKSp</th>
                    <th>JP</th>
                    <th>Pelayanan indeks</th>
                    <th>Farmasi indeks</th>
                    <th>Pelayanan langsung</th>
                    <th>Farmasi langsung</th>
                    <th>Pil casemix</th>
                    <th>Pil JP</th>
                    <th>Pi_Pelayanan</th>
                    <th>Pi_Farmasi</th>
                    <th>Pl_Pelayanan</th>
                    <th>Pl_Farmasi</th>
                    <th>Hari_Raya<th>
                    <th>PPNI<th>
                    <th>POT_BPJS<th>
                    <th>ARTHA_MEDIKA<th>
                    <th>BINA_SEHAT<th>
                    <th>APOTIK<th>
                    <th>LAIN<th>
                    <th>IP<th>
                    <th>IF<th>
                    <th>RUANG<th>
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
                            $INDEKS_td = ( ! empty($INDEKS))? "" : " style='background: #E07171;'";
                            $INDEKSp_td = ( ! empty($INDEKSp))? "" : " style='background: #E07171;'";
                            $CASEMIX_td = ( ! empty($CASEMIX))? "" : " style='background: #E07171;'";
                            $JP_td = ( ! empty($JP))? "" : " style='background: #E07171;'";
                            $Pelayanan_indeks_td = ( ! empty($Pelayanan_indeks))? "" : " style='background: #E07171;'";
                            $Farmasi_indeks_td = ( ! empty($Farmasi_indeks))? "" : " style='background: #E07171;'";
                            $Pelayanan_langsung_td = ( ! empty($Pelayanan_langsung))? "" : " style='background: #E07171;'";
                            $Farmasi_langsung_td = ( ! empty($Farmasi_langsung))? "" : " style='background: #E07171;'";
                            $Pil_casemix_td = ( ! empty($Pil_casemix))? "" : " style='background: #E07171;'";
                            $Pil_jp_td = ( ! empty($Pil_jp))? "" : " style='background: #E07171;'";
                            $Pi_Pelayanan_td = ( ! empty($Pi_Pelayanan))? "" : " style='background: #E07171;'";
                            $Pi_Farmasi_td = ( ! empty($Pi_Farmasi))? "" : " style='background: #E07171;'";
                            $Pl_Pelayanan_td = ( ! empty($Pl_Pelayanan))? "" : " style='background: #E07171;'";
                            $Pl_Farmasi_td = ( ! empty($Pl_Farmasi))? "" : " style='background: #E07171;'";
                            $Hari_Raya_td = ( ! empty($Hari_Raya))? "" : " style='background: #E07171;'";
                            $PPNI_td = ( ! empty($PPNI))? "" : " style='background: #E07171;'";
                            $POT_BPJS_td = ( ! empty($POT_BPJS))? "" : " style='background: #E07171;'";
                            $ARTHA_MEDIKA_td = ( ! empty($ARTHA_MEDIKA))? "" : " style='background: #E07171;'";
                            $BINA_SEHAT_td = ( ! empty($BINA_SEHAT))? "" : " style='background: #E07171;'";
                            $APOTIK_td = ( ! empty($APOTIK))? "" : " style='background: #E07171;'";
                            $LAIN_td = ( ! empty($LAIN))? "" : " style='background: #E07171;'";
                            $IP_td = ( ! empty($IP))? "" : " style='background: #E07171;'";
                            $IF_td = ( ! empty($IF))? "" : " style='background: #E07171;'";
                            $RUANG_td = ( ! empty($RUANG))? "" : " style='background: #E07171;'";
                            

                            // Jika salah satu data ada yang kosong
                            if($tgl== "" or $nip=="" or $nama =="" or $gol =="" 
                            or $gr=="" or $MK=="" or $TJ=="" or $JAB ==""
                                or $TF =="" or $LL =="" or $INDEKS =="" or $INDEKSp =="" or $CASEMIX ==""
                                or $Pelayanan_indeks =="" or $Farmasi_indeks =="" or $Pelayanan_langsung =="" or $Farmasi_langsung =="" or $Pil_casemix ==""
                                or $Pil_jp =="" or $Pi_Pelayanan =="" or $Pi_Farmasi =="" 
                                or $Pl_Pelayanan =="" or $Pl_Farmasi ==""
                                or $Hari_Raya =="" or $PPNI =="" or $POT_BPJS =="" or $ARTHA_MEDIKA ==""
                                or $BINA_SEHAT =="" or $APOTIK =="" or $LAIN =="" or $IP ==""
                                or $IF =="" or $RUANG ==""){
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
                            echo "<td".$INDEKS_td.">".$INDEKS."</td>";
                            echo "<td".$INDEKSp_td.">".$INDEKSp."</td>";
                            echo "<td".$CASEMIX_td.">".$CASEMIX."</td>";
                            echo "<td".$JP_td.">".$JP."</td>";
                            echo "<td".$Pelayanan_indeks_td.">".$Pelayanan_indeks."</td>";
                            echo "<td".$Farmasi_indeks_td.">".$Farmasi_indeks."</td>";
                            echo "<td".$Pelayanan_langsung_td.">".$Pelayanan_langsung."</td>";
                            echo "<td".$Farmasi_langsung_td.">".$Farmasi_langsung."</td>";
                            echo "<td".$Pil_casemix_td.">".$Pil_casemix."</td>";
                            echo "<td".$Pil_jp_td.">".$Pil_jp."</td>";
                            echo "<td".$Pi_Pelayanan_td.">".$Pi_Pelayanan."</td>";
                            echo "<td".$Pi_Farmasi_td.">".$Pi_Farmasi."</td>";
                            echo "<td".$Pl_Pelayanan_td.">".$Pl_Pelayanan."</td>";
                            echo "<td".$Pl_Farmasi_td.">".$Pl_Farmasi."</td>";
                            echo "<td".$Hari_Raya_td.">".$Hari_Raya."</td>";
                            echo "<td".$PPNI_td.">".$PPNI."</td>";
                            echo "<td".$POT_BPJS_td.">".$POT_BPJS."</td>";
                            echo "<td".$ARTHA_MEDIKA_td.">".$ARTHA_MEDIKA."</td>";
                            echo "<td".$BINA_SEHAT_td.">".$BINA_SEHAT."</td>";
                            echo "<td".$APOTIK_td.">".$APOTIK."</td>";
                            echo "<td".$LAIN_td.">".$LAIN."</td>";
                            echo "<td".$IP_td.">".$IP."</td>";
                            echo "<td".$IF_td.">".$IF."</td>";
                            echo "<td".$RUANG_td.">".$RUANG."</td>";
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
