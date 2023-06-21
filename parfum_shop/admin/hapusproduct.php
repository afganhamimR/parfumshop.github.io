<?php 

$ambl = $kn->query("SELECT * FROM product WHERE id_product='$_GET[id]'");
$pch = $ambl->fetch_assoc();


$kn->query("DELETE FROM product WHERE id_product='$_GET[id]'");

echo "<script>alert('Produk Terhapus');</script>";
echo "<script>location='index.php?halaman=product';</script>";
?>