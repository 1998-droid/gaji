<?php
include_once "../koneksi.php";
$id = @$_GET['id'];
$sql_2 = mysqli_query($connect, "SELECT *, a.nama, b.nip, 
(gaji-dansos-iw_korpkab-dapens_korp-simpi_armed-dplk-iw_korp_unit-baznaz_infaq-baznaz_zakat-bank_bpd-bpr_gnsimping-k_bina_sehat-kop_sekar-arisan_sas-bpjs_kes-bpjs_ker-lain) as jml_bersih, 
(dansos+iw_korpkab+dapens_korp+simpi_armed+dplk+iw_korp_unit+baznaz_infaq+baznaz_zakat+bank_bpd+bpr_gnsimping+k_bina_sehat+kop_sekar+arisan_sas+bpjs_kes+bpjs_ker+lain) as jml_pot FROM karyawan a 
JOIN tb_user b ON b.nip=a.nip WHERE id_peg ='$id'") 
or die (mysqli_error($connect));
$data =mysqli_fetch_array($sql_2);
?>
<style>
    *{
        margin-left: auto;
        margin-right: auto;
        font-family: sans-serif;
    }

    table{
        border-collapse: collapse;
    }

    table tr td{
        padding:3px;
    }
    #hrnew4 {
  border: 1px solid black;
}
#watermark1
{
 height: 200px; /* or whatever, equal to the image you want 'watermarked' */
width: 200px; /* as above */
background-position: 0 0;
background-repeat: no-repeat;
position: relative;
}
    #watermark{
    margin: auto;
    top :1px;
    bottom : 1px;
    left : 1%;
    display:block;
    position : absolute;
    opacity: 0.3;
    filter: alpha(opacity=40);
    size:10px;
}
</style>
<html>
<head>
    <title>RSUD MAJENANG | Form Slip Gaji Karyawan</title>
</head>
<body>
    <table class="table_detail" width="700" style="color:black;font-weight:bold;font-size:12px;"> 
        <tr>
            <td colspan="3" width="500" align="left">RUMAH SAKIT UMUM DAERAH MAJENANG</td>
            <td colspan="3" width="500" align="right">SLIP GAJI</td>
        </tr>
        <tr>
            <td colspan="3" width="500" align="left">Jl. Dr. Soetomo No. 54 Telp. (0280)621012-621343 Fax. (0280)621519</td>
            <td colspan="3" width="700" align="right"><?php echo date(' M Y', strtotime($data['tgl'])); ?></td>
        </tr>
    </table>
    <hr id="hrnew4">
    <table>
        <tr>
            <td colspan="3" align="center"><h3>Slip Gaji Karyawan<br></h3></td>
        </tr>
        <tr></tr>
        <tr>
            <td width="200">Nama Karyawan</td>
            <td>:</td>
            <td>
               <?php echo  $data['nama'] ?>
            </td>
        </tr>
        <tr>
            <td width="200">NIP/NIK</td>
            <td>:</td>
            <td>
                <?php echo $data['nip'] ?>
            </td>
        </tr>
    </table>
        <hr id="hrnew4">
        
        <table border="0" class="table_detail" width="700" style="color:black;font-weight:bold;font-size:12px;">
    <tr>
            <td><h3>Potongan<br></h3></td>
            <td align="right"><h3>Nominal<br></h3></td>
        </tr>
        <tr>
           
            <td >Dansos</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['dansos']); ?></td>
        </tr>
        <tr>
            
            <td>I.W Korpkab</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['iw_korpkab']); ?></td>
        </tr>
        <tr>
            
            <td>Dapens Korp</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['dapens_korp']); ?></td>
        </tr>
        <tr>
           
            <td>Simpi Armed</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['simpi_armed']); ?></td>
        </tr>
        <tr>
            
            <td>DPLK</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['dplk']); ?></td>
        </tr>
        <tr>
            
            <td>I.W Korp.Unit</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['iw_korp_unit']); ?></td>
        </tr>
        <tr>
           
            <td>Baznaz Infaq</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['baznaz_infaq']); ?></td>
        </tr>
        <tr>
            
            <td>Baznaz Zakat</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['baznaz_zakat']); ?></td>
        </tr>
        <tr>
            
            <td>Bank BPD</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['bank_bpd']); ?></td>
        </tr>
        <tr>
            
            <td>BPR Gn.Simping</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['bpr_gnsimping']); ?></td>
        </tr>
        <tr>
            
            <td>Kop.Bina Sehat</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['k_bina_sehat']); ?></td>
        </tr>
        <tr>
           
            <td>Kop. Sekar</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['kop_sekar']); ?></td>
        </tr>
        <tr>
            
            <td>Arisan SAS</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['arisan_sas']); ?></td>
        </tr>
        <tr>
            
            <td>BPJS Kes</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['bpjs_kes']); ?></td>
        </tr>
        <tr>
            
            <td>BPJS Ker</td>
            <td align="right"><?php echo 'Rp. '.($data['bpjs_ker']); ?></td>
        </tr>
        <tr>
            
            <td>Lain</td>
            <td align="right"><?php echo 'Rp. '.($data['lain']); ?></td>
        </tr>
</table>
    </table>
    <br>
    <hr id="hrnew4">
    <table border="0" class="table_detail" width="700">
        <th></th>
    </table>
<table  width="700">
        <tr>
            <td colspan="1"><strong>TOTAL BERSIH</strong></td>
            <td align="right" style="color:green;font-weight:bold"><?php echo 'Rp. '.number_format($data['jml_bersih']); ?></td>
        </tr>
        <tr>
            <td colspan="1"><strong>TOTAL POT</strong></td>
            <td align="right" style="color:red;font-weight:bold"><?php echo 'Rp. '.number_format($data['jml_pot']); ?></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table>
        <tr>
            <td width="650" colspan="1" align="right" style="color:black;font-weight:bold">
                Bendahara Gaji
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table>
        <tr>
        <td width="700" colspan="1" align="right" style="color:black;font-weight:bold">
        Tonny Kurniawan, SE, Ak
            </td>
        </tr>
    </table>
  
    <div id="watermark" >    
    <img src="../_asset/img/1.png">
</div>
    <script>
 window.print();
 </script>
</body>
</html>