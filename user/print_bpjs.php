<?php
include_once "../koneksi.php";
$id = @$_GET['id'];
$sql_2 = mysqli_query($connect, "SELECT *, a.nama, b.nip, a.tgl, (gol+gr+MK+TJ+JAB+TF+LL) AS tot,
 ((gol+gr+MK+TJ+JAB+TF+LL)*80/100) as idks, (Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+Farmasi_langsung+il_casemix+il_jp) as total_indeks,
 (Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl+pil_casemix+pil_jp) as t_pph, ((Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+
					Farmasi_langsung+il_casemix+il_jp)-(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)) as bersih, 
					((Hari_Raya+Lain2)) AS t_pot, (il_casemix+il_jp) as insentif,
					((Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+
					Farmasi_langsung+il_casemix+il_jp)-(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)-
                    (Hari_Raya+Lain2+ppni+pot_bpjs+artha_medika+BinaSehat+apotik_kasir)) as neto FROM tb_bpjs a 
JOIN tb_user b ON b.nip=a.nip WHERE id_bpjs ='$id'") 
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
  width: 600px;
}

#hrnew3 {
  border: 1px solid black;
  width: 300px;
  position: right;
}

#watermark1
{
 height: 100px; /* or whatever, equal to the image you want 'watermarked' */
width: 100px; /* as above */
background-position: 5 0;
background-repeat: no-repeat;
position: relative;
}
    #watermark{
    margin: auto;
    top :1px;
    bottom : 1px;
    left : 5%;
    display:block;
    position : absolute;
    opacity: 0.3;
    filter: alpha(opacity=60);
    size:10px;
}
</style>
<html>
<head>
    <title>Form Slip JP Karyawan</title>
</head>
<body>
<table class="table_detail"  width="600" style="color:black;font-weight:bold;font-size:12px;"> 
    <tr>
      <td width="1">Jasa Pelayanan & Jasa Farmasi</td><br>
    <tr>
        <td  width="2.5">NIP/NIK</td>
        <td width="2.5">:</td>
        <td > <?php echo $data['nip']; ?></td><br>
    </tr>
        </tr>        
<tr>
            <td  width="1">Bulan Pelayanan</td>
            <td width="1">:</td>
            <td > <?php echo date(' M Y', strtotime($data['tgl'])); ?></td><br>
        </tr>
        <tr>
            <td  width="1">Ruangan</td>
            <td width="1">:</td>
            <td > <?php echo $data['ruang']; ?></td><br>
        </tr>
        <tr>
            <td  width="1">Nama</td>
            <td width="1">:</td>
            <td > <?php echo $data['nama']; ?></td><br>
        </tr>
        <tr>
            <td  width="1">Gol</td>
            <td width="1">:</td>
            <td > <?php echo $data['gol']; ?></td><br>
        </tr>
</table>
    
    <hr id="hrnew4">
    
    <br>
    <table border="1" class="table_detail" width="600" style="color:black;font-weight:bold;font-size:12px;">
    <thead>
        <th>GR</th>
        <th>MK</th>
        <th>TJ</th>
        <th>JAB</th>
        <th>TF</th>
        <th>LL</th>
        <th>TOT</th>
        <th>IDKS</th>
    </thead>
    <tbody align="center">
        <td><?php echo $data['gr'] ?></td>
        <td><?php echo $data['MK'] ?></td>
        <td><?php echo $data['TJ'] ?></td>
        <td><?php echo $data['JAB'] ?></td>
        <td><?php echo $data['TF'] ?></td>
        <td><?php echo $data['LL'] ?></td>
        <td><?php echo $data['tot'] ?></td>
        <td><?php echo $data['Indeks'] ?></td>
    </tbody>
    </table>
    
<hr id="hrnew4">
<table  width="600">
        <tr>
            <td colspan="1">Insentif</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['insentif']); ?></td>
        </tr>
        
        <tr>
            <td colspan="1">Indeks Pelayanan</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['Pelayanan_indeks']); ?></td>
        </tr>
        <tr>
            <td colspan="1">Indeks Farmasi</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['Farmasi_indeks']); ?></td>
        </tr>
        <tr>
            <td colspan="1">Jasa Pelayanan</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['Pelayanan_langsung']); ?></td>
        </tr>
        <tr>
            <td colspan="1">Jasa Farmasi</td>
            <td align="right"><?php echo 'Rp. '.number_format($data['Farmasi_langsung']); ?></td>
        </tr>
    </table>
    <hr id="hrnew4">
    <table width="600">
    <tr>
    <td align="right"><b>Total         :   <?php echo 'Rp. '.number_format($data['total_indeks']); ?></td>
    </tr>
    <tr>
    <td align="right"><b>Total PPH : <?php echo 'Rp. '.number_format($data['t_pph']); ?></td>
    </tr>
    </table>
    <hr size="1px" width="600" align="right" >
    <table width="600" >
        <tr>
            <td align="right">Bersih  </td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['bersih']); ?></td>
        </tr>
        <tr>
            <td align="right">THR  </td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['Hari_Raya']); ?></td>
        </tr>
        <tr>
            <td align="right">PPNI</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['ppni']); ?></td>
        </tr>
        <tr>
            <td align="right">Pot. BPJS</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['pot_bpjs']); ?></td>
        </tr>
        <tr>
            <td align="right">Artha Medika</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['artha_medika']); ?></td>
        </tr>
        <tr>
            <td align="right">Bina Sehat</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['BinaSehat']); ?></td>
        </tr>
        <tr>
            <td align="right">Apotik & Kasir</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['apotik_kasir']); ?></td>
        </tr>
        <tr>
            <td align="right">Lain</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['Lain2']); ?></td>
        </tr>
    </table>
    <hr size="1px" width="600" align="right" >
    <table width="600">
    <tr>
            <!-- <td align="right">Total</td>
            <td align="right">:</td> -->
            <td align="right" colspan="2"><b><?php echo 'Rp. '.number_format($data['neto']); ?></td>
    </tr>
    </table>
    <br>
    <br>
    <br>
    <table>
        <tr>
            <td width="550" colspan="1" align="right" style="color:black;font-weight:bold">
                Bendahara JP
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table>
        <tr>
        <td width="600" colspan="1" align="right" style="color:black;font-weight:bold">
        Sangga Wishnu A, SE
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