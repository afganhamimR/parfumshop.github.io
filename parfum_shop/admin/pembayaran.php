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
    #ry{
        font-family: 'Poppins', sans-serif;
    }
    
</style>
<h2>Data Pembayaran</h2>

<?php 

$id_pembelian = $_GET['id'];

$ambl = $kn->query("SELECT*FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambl->fetch_assoc();


?>

<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?php echo $detail['nama'] ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?php echo $detail['bank'] ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?php echo number_format($detail['jumlah']) ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?php echo date("d F Y",strtotime ($detail['tanggal'])) ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti_pembayaran/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive">
    </div>

   
</div>

<form id="ry" method="post">
    <div class="form-group">
        <label>No Resi Pengiriman</label>
        <input type="text" class="form-control" name="resi">
    </div>
    <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="status">
            <option value="">Pilih Status</option>
            <option value="lunas">Lunas</option>
            <option value="barang dikirim">Barang Dikirim</option>
            <option value="barang telah diterima">Barang Telah Diterima</option>
            <option value="batal">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
if (isset($_POST["proses"]))
{
    $resi = $_POST["resi"];
    $status = $_POST["status"];
    $kn->query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status'
    WHERE id_pembelian='$id_pembelian'");

     echo "<script>alert('Data pembelian terupdate');</script>";
     echo "<script>location='index.php?halaman=pembelian';</script>";
}

?>