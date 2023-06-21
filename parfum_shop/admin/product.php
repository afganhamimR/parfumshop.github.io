<head>
       <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<style>
    h2{
        font-family: 'Poppins', sans-serif;
        color:#045497;
    }
    #ad{
        font-family: 'Poppins', sans-serif;                                     
    }
    
</style>
<h2>Data Produk</h2>
<hr>
<table id="ad" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Berat (ML)</th> 
            <th>Stok Produk</th>
            <th>Foto</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $nmr=1; ?>
        <?php $ambl=$kn->query("SELECT * FROM product"); ?>
        <?php while($pch = $ambl->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $pch['nama_product']; ?></td>
            <td>Rp. <?php echo number_format ($pch['harga_product']); ?></td>
            <td><?php echo $pch['berat_product']; ?></td>
            <td><?php echo $pch['stok_produk']; ?></td>
            <td>
                <img src="../foto_product/<?php echo $pch['gambar_product']; ?>" width="100">
            </td>
            <td>
                <a href="index.php?halaman=hapusproduct&id=<?php echo $pch['id_product']; ?>" class="btn-danger btn">Hapus</a>
                <a href="index.php?halaman=ubahproduct&id=<?php  echo $pch['id_product']; ?>" class="btn-warning btn">Ubah</a>
            </td>
        </tr>
        <?php $nmr++; ?>
        <?php } ?>
    </tbody>
</table>
<a id="ad" href="index.php?halaman=tambahproduct" class="btn btn-primary">Tambah Data</a>