<?php
$semuadata=array();
$tgl_mulai="-";
$tgl_selesai="-";
if (isset($_POST["kirim"]))
{
    $tgl_mulai = $_POST["tglm"];
    $tgl_selesai = $_POST['tgls'];

    $ambl = $kn->query("SELECT * FROM pembelian LEFT JOIN pelanggan ON
    id_pelanggan=id_pelangganbeli WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
   while($pch = $ambl->fetch_assoc())
   {
     $semuadata[]=$pch;
   }

}
 ?>
 <head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<style>
    h2{
        font-family: 'Poppins', sans-serif;
        color:#045497;
    }
    .row{
        font-family: 'Poppins', sans-serif;
    }
    #op{
        font-family: 'Poppins', sans-serif;
    }
    th, td{
        text-align: center;
    }
</style>
<h2>Laporan Pembelian <?php echo $tgl_mulai ?> S/D <?php echo $tgl_selesai ?></h2>
<hr>

<form method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
            </div>
        </div>
        <div class="col-md-1">
            <label>&nbsp;</label>
            <button class= "btn btn-primary" name="kirim"> Lihat Laporan</button>
        </div>
    </div>
</form>

<table id="op" class="table table-bordered">
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
            <td><?php echo $key+1; ?></td>
            <td><?php echo $value["nama_pelanggan"] ?></td>
            <td><?php echo date("d F Y",strtotime($value["tanggal_pembelian"])) ?></td>
            <td>Rp. <?php echo number_format($value["total_pembelian"]) ?></td>
            <td><?php echo $value["status_pembelian"] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">TOTAL</th>
            <th>Rp. <?php echo number_format($total) ?></th>
        </tr>
    </tfoot>
</table>

<a id="op" href="cetak_laporan.php?tglm=<?php echo $tgl_mulai ?>&tgls=<?php echo $tgl_selesai ?>" class="btn btn-primary" target="_blank" >Cetak Laporan</a>
<a id="op" href="cetak_excel.php?tglm=<?php echo $tgl_mulai ?>&tgls=<?php echo $tgl_selesai ?>" class="btn btn-success" target="_blank" >Download Excel</a>    
