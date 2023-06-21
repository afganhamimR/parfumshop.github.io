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
</style>
<h2>Detail Pembelian</h2>
<?php
$ambl = $kn->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelangganbeli=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambl->fetch_assoc();
?>

<div class="row">
    <hr>
    <div class="col-md-4">
        <h3>Pembelian</h3>
           Tanggal: <?php echo $detail['tanggal_pembelian']; ?> <br>
           Total: Rp. <?php echo number_format ($detail['total_pembelian']); ?> <br>
           Status: <?php echo $detail["status_pembelian"]; ?>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
           <?php echo $detail['telp_pelanggan']; ?> <br>
           <?php echo $detail['email_pelanggan']; ?> 
    </div>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong><?php echo $detail['nama_kota'] ?></strong><br>
        Jasa Pengiriman: <?php echo $detail['nama_jasa'] ?><br>
        Tarif: Rp. <?php echo number_format($detail['tarif']); ?><br>
        Alamat: <?php echo $detail['alamat_pengiriman']; ?>
    </div>
</div>
<hr>
<table id="op" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $nmr=1; ?>
        <?php $ambl=$kn->query("SELECT * FROM pembelian_product JOIN product ON pembelian_product.id_product=product.id_product WHERE pembelian_product.id_pembelian='$_GET[id]'"); ?>
        <?php while($pch=$ambl->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $pch['nama_product']; ?></td>
            <td>Rp. <?php echo number_format ($pch['harga_product']); ?></td>
            <td><?php echo $pch['jumlah']; ?></td>
            <td>
               Rp. <?php echo number_format ($pch['harga_product']*$pch['jumlah']); ?>
            </td>
        </tr>
        <?php $nmr++; ?>
        <?php } ?>
    </tbody>
</table>