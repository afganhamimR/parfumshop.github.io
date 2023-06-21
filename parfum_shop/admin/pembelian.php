<head>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<style>
    h2{
        font-family: 'Poppins', sans-serif;
        color:#045497;
    }
    #yt{
        font-family: 'Poppins', sans-serif;
    }
</style>
<h2>Data Pembelian</h2>
<hr>
<table id="yt" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal</th>
            <th>Status Pembelian</th>
            <th>Total</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $nmr=1; ?>
        <?php $ambl=$kn->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelangganbeli=pelanggan.id_pelanggan"); ?>
        <?php while($pch = $ambl->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $pch['nama_pelanggan']; ?></td>
            <td><?php echo date("d F Y",strtotime ($pch['tanggal_pembelian'])); ?></td>
            <td><?php echo $pch['status_pembelian']; ?></td>
            <td>Rp. <?php echo number_format ($pch['total_pembelian']); ?></td>
            <td>
                <a href="index.php?halaman=detail&id=<?php echo $pch ['id_pembelian']; ?>" class="btn btn-info">Detail</a>

                <?php if ($pch['status_pembelian']=="sudah kirim pembayaran"): ?>
                    <a href="index.php?halaman=pembayaran&id=<?php echo $pch['id_pembelian'] ?>" class="btn btn-success">Lihat Pembayaran</a>
                <?php endif ?>

                <?php if ($pch['status_pembelian']=="barang dikirim"): ?>
                    <a href="index.php?halaman=pembayaran&id=<?php echo $pch['id_pembelian'] ?>" class="btn btn-success">Lihat Pembayaran</a>
                <?php endif ?>

                <?php if ($pch['status_pembelian']=="lunas"): ?>
                    <a href="index.php?halaman=pembayaran&id=<?php echo $pch['id_pembelian'] ?>" class="btn btn-success">Lihat Pembayaran</a>
                <?php endif ?>

                <?php if ($pch['status_pembelian']=="barang telah diterima"): ?>
                    <a href="index.php?halaman=pembayaran&id=<?php echo $pch['id_pembelian'] ?>" class="btn btn-success">Lihat Pembayaran</a>
                <?php endif ?>

                <?php if ($pch['status_pembelian']=="batal"): ?>
                    <a href="index.php?halaman=pembayaran&id=<?php echo $pch['id_pembelian'] ?>" class="btn btn-success">Lihat Pembayaran</a>
                <?php endif ?> 
            </td>
        </tr>
        <?php $nmr++; ?>  
        <?php } ?>
    </tbody>
</table>