<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parfum Shop - Nota Pembelian</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- CSS File -->
  <link href="assets/css/setel.css" rel="stylesheet">

  <style>
    #tbl {
      margin-top: 2rem;
    }
  </style>

  </head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        
        <h1>Parfum Shop<span>.</span></h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li><a href="keranjang.php">Keranjang</a></li>
          
          <?php if (isset($_SESSION["pelanggan"])): ?>
           <li><a href="riwayat.php">Riwayat Belanja</a></li>
           <li><a id="ai" href="logout.php">Logout</a></li>
          <?php else: ?>
                <li><a id="ai" href="login.php">Login</a></li>
                <li><a id="ai" href="registrasi.php">Sign Up</a>
            <?php endif ?>

            <li><a id="ai" href="checkout.php">Checkout</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/laura.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Nota Pembelian</h2>
        <ol>
          <li><a href="riwayat.php">Riwayat Pembelian</a></li>
          <li>Nota Pembelian</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Section ======= -->
    <section id="get-started" class="get-started section-bg">
      <div class="container" data-aos="fade-up">
        <div class="container">

            <div class="row">

      <h2>Nota Pembelian</h2>
      <hr>
<?php
$ambl = $kn->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelangganbeli=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambl->fetch_assoc();
?>
 
 <?php 
 $idpelangganyangbeli = $detail["id_pelanggan"];

 $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

 if ($idpelangganyangbeli!==$idpelangganyanglogin)
 {
    echo "<script>alert('Hayo, mau ngapain');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
 }
 ?>
        
<div class="row">

    <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>No. Pembelian: <?php echo $detail['id_pembelian']; ?></strong><br>
        Tanggal: <?php echo date("d F Y",strtotime ($detail['tanggal_pembelian'])); ?><br>
        Total: Rp. <?php echo number_format($detail['total_pembelian']); ?>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
        <p>
           <?php echo $detail['telp_pelanggan']; ?> <br>
           <?php echo $detail['email_pelanggan']; ?>
        </p>
    </div>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong><?php echo $detail['nama_kota'] ?></strong><br>
        Jasa Pengiriman: <?php echo $detail['nama_jasa']; ?><br> 
        Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?><br>
        Alamat: <?php echo $detail['alamat_pengiriman']; ?><br><br>
    </div>
</div>
<hr>
<table id="tbl" class="table">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Jumlah</th>
            <th>Subberat</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $nmr=1; ?>
        <?php $ambl=$kn->query("SELECT * FROM pembelian_product WHERE id_pembelian='$_GET[id]'"); ?>
        <?php while($pch=$ambl->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $pch['nama']; ?></td>
            <td>Rp. <?php echo number_format ($pch['harga']); ?></td>
            <td><?php echo $pch['berat']; ?> ML</td>
            <td><?php echo $pch['jumlah']; ?></td>
            <td><?php echo $pch['subberat']; ?> ML</td>
            <td>Rp. <?php echo number_format ($pch['subharga']); ?> </td>
        </tr>
        <?php $nmr++; ?>
        <?php } ?>
    </tbody>
</table>

        <div class="row">
            <div class="col-md-7">
                <div id="tbl" class="alert alert-success" role="alert">
                    <p>
                        Silahkan transfer pembayaran Rp. <?php echo number_format ($detail['total_pembelian']); ?> ke <br>
                        <strong>BRI 237-201888-3283 AN. Abdul Hidayat</strong>


                    </p>
                </div>

            </div>
        </div>

        </div>
        
    </section>
    <!-- End Section -->

  </main><!-- End #main -->

  <?php include 'footer.php'; ?>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  

  <!-- JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>