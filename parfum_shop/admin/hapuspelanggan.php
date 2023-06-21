<?php 

$ambl = $kn->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

$kn->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('Pelanggan Terhapus');</script>";
echo "<script>location='index.php?halaman=pelanggan';</script>";
?>