
<head>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<style>
    h2{
        font-family: 'Poppins', sans-serif;
        color:#045497;
    }
    #mn{
        font-family: 'Poppins', sans-serif;
    }
</style>
<h2>Ubah Produk</h2>
<?php
$ambl=$kn->query("SELECT * FROM product WHERE id_product='$_GET[id]'");
$pch = $ambl->fetch_assoc();

?>

<form id="mn" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $pch['nama_product']; ?>">
    </div>
    <div class="form-group">
        <label>Harga Rp</label>
        <input type="number" name="harga" class="form-control" value="<?php echo $pch['harga_product']; ?>">
    </div>
    <div class="form-group">
        <label>Berat (ML)</label>
        <input type="number" name="berat" class="form-control" value="<?php echo $pch['berat_product']; ?>">
    </div>
    <div class="form-group">
        <label>Stok Produk</label>
        <input type="number" name="stok" class="form-control" value="<?php echo $pch['stok_produk']; ?>">
    </div>
    <img src="../foto_product/<?php echo $pch['gambar_product'] ?>" width="200">
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="10"><?php echo $pch['deksripsi_product']; ?>
        </textarea>    
    </div>
    <button class="btn btn-primary" name="ubah">Simpan Perubahan</button>
</form>

<?php
if (isset($_POST['ubah']))
{
    $namafoto=$_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    //jika mengubah foto
    if (!empty($lokasifoto))
    {
        move_uploaded_file($lokasifoto, "../foto_product/$namafoto");

        $kn->query("UPDATE product SET nama_product='$_POST[nama]',
        harga_product='$_POST[harga]',berat_product='$_POST[berat]',stok_produk='$_POST[stok]',
        gambar_product='$namafoto',deksripsi_product='$_POST[deskripsi]'
        WHERE id_product='$_GET[id]'");

    }
    else
    {
        $kn->query("UPDATE product SET nama_product='$_POST[nama]',
        harga_product='$_POST[harga]',berat_product='$_POST[berat]',stok_produk='$_POST[stok]',
        deksripsi_product='$_POST[deskripsi]'
        WHERE id_product='$_GET[id]'");
    }
    echo "<script>alert('Data Produk Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=product';</script>";
    
}
?>
