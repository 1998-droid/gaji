<?php
include_once "../koneksi.php";
$id = @$_GET['id'];
$sql_2 = mysqli_query($connect, "SELECT *, a.nama, b.nip, a.tgl, (gol+gr+MK+TJ+JAB+TF+LL) AS tot,
 ((gol+gr+MK+TJ+JAB+TF+LL)*80/100) as idks, (Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+Farmasi_langsung) as total_indeks,
 (Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl) as t_pph, ((Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+
					Farmasi_langsung)-(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)) as bersih, 
					(Hari_Raya+Kurban+POT_BINA_SEHAT+Lain2) AS t_pot,
					((Pelayanan_indeks+Farmasi_indeks+Pelayanan_langsung+
					Farmasi_langsung)-(Pelayanan_pi+Farmasi_pi+Pelayanan_pl+Farmasi_pl)-(Hari_Raya+Kurban+POT_BINA_SEHAT+RUANGAN+ARISAN_KARU+POT_ARTHA_MEDIKA+Lain2)) as neto FROM tb_jam a 
JOIN tb_user b ON b.nip=a.nip WHERE id_jp ='$id'") 
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
  width: 200px;
  margin-right: 10px;
}

#watermark1
{
 height: 100px; /* or whatever, equal to the image you want 'watermarked' */
width: 100px; /* as above */
background-position: 5 0;
background-repeat: no-repeat;
position: relative;
}
    #watermarkjp
    {
    margin: auto;
    top :1px;
    bottom : 10px;
    left : 10%;
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
        <td><?php echo $data['idks'] ?></td>
    </tbody>
    </table>   
<hr id="hrnew4">
<table  width="600">
   
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
            <td align="right">Kurban</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['Kurban']); ?></td>
        </tr>
        <tr>
            <td align="right">Pot. Bina Sehat</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['POT_BINA_SEHAT']); ?></td>
        </tr>
        <tr>
            <td align="right">Ruangan</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['RUANGAN']); ?></td>
        </tr>
        <tr>
            <td align="right">Arisan Karu</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['ARISAN_KARU']); ?></td>
        </tr>
        <tr>
            <td align="right">Pot. Artha Medika</td>
            <td align="right">:</td>
            <td align="right" ><?php echo 'Rp. '.number_format($data['POT_ARTHA_MEDIKA']); ?></td>
        </tr>
        <tr>
            <td align="right">Lain2</td>
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
    
    <table>
        <tr>
        <td width="600" colspan="1" align="right" style="color:black;font-weight:bold">
        Sangga Wishnu A, SE
            </td>
        </tr>
    </table>
    
    <div id="watermarkjp">    
    <img src="../_asset/img/1.png">
</div>
    <script>
 window.print();
 </script>
</body>
</html>