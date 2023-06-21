<?php 
$kn = new mysqli("localhost","root","","tokoparfum");

 $tgl_mulai = $_GET["tglm"];
 $tgl_selesai = $_GET['tgls'];

$semuadata=array();
 $ambl = $kn->query("SELECT * FROM pembelian LEFT JOIN pelanggan ON
 id_pelanggan=id_pelangganbeli WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
while($pch = $ambl->fetch_assoc())
{
  $semuadata[]=$pch;
}
 ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Cetak Laporan</title>
  </head>
  <style>
    #judul {
     text-align:center;
        font-size:14pt;
        font-weight:bold;
        margin-bottom:13px;
   }
   h4{
     text-align:center;
   }
   #td{
     text-align:center;
   }
  </style>
  <body>
  <div id="judul">LAPORAN PEMBELIAN</div>
  <div id="judul">PARFUM SHOP</div>
  <h4><?php echo date("d F Y",strtotime ($tgl_mulai)) ?> S/D <?php echo date("d F Y",strtotime ($tgl_selesai)) ?></h4>
  <table border="1" align="center" width="100%">
    <thead>
        <th>NO</th>
        <th>PELANGGAN</th>
        <th>TANGGAL</th>
        <th>JUMLAH</th>
        <th>STATUS</th>
    </thead>
    <tbody>
        <?php $total=0; ?>
        <?php foreach ($semuadata as $key => $value): ?>
        <?php $total+=$value['total_pembelian'] ?>
        <tr>
            <td id="td"><?php echo $key+1; ?></td>
            <td><?php echo $value["nama_pelanggan"] ?></td>
            <td><?php echo date("d F Y",strtotime($value["tanggal_pembelian"])) ?></td>
            <td>Rp. <?php echo number_format($value["total_pembelian"]) ?></td>
            <td><?php echo $value["status_pembelian"] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
        <tr>
            <th colspan="3">TOTAL</th>
            <th>Rp. <?php echo number_format($total) ?></th>
            <th></th>
        </tr>
</table>
<script>
   window.print();
</script>
  </body>
</html>
