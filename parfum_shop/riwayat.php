<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum"); 

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
    echo "<script>alert('Silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parfum Shop - Riwayat Belanja</title>
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
    .table {
      margin-top: 1.5rem;
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
           <li><a href="riwayat.php" class="active">Riwayat Belanja</a></li>
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
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/kuning.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Riwayat Belanja</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Riwayat Belanja</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

       
    <section id="get-started" class="get-started section-bg">
      <div class="container" data-aos="fade-up">
      <div class="container">
        <div class="row">
            <h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>
            <hr>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <th>Tanggal</th>
                         <th>Status</th>    
                         <th>Total</th> 
                         <th>Opsi</th>                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nmr=1;
                    $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

                    $ambl = $kn->query("SELECT * FROM pembelian WHERE id_pelangganbeli='$id_pelanggan'");
                    while($pch = $ambl->fetch_assoc()){
                    ?>
                    <tr>
                        <td id="no"><?php echo $nmr; ?></td>
                        <td><?php echo date("d F Y",strtotime ($pch["tanggal_pembelian"])) ?></td>
                        <td>
                            <?php echo $pch["status_pembelian"] ?>
                            <br>
                            <?php if (!empty($pch['resi_pengiriman'])): ?>
                            Resi: <?php echo $pch['resi_pengiriman']; ?>
                            <?php endif ?>
                        </td>
                        <td>Rp. <?php echo number_format($pch["total_pembelian"]) ?></td>
                        <td>
                            <a href="nota.php?id=<?php echo $pch["id_pembelian"] ?>" class="btn btn-info">Nota</a>

                            <?php if ($pch['status_pembelian']=="pending"): ?>
                            <a href="pembayaran.php?id=<?php echo $pch["id_pembelian"]; ?>" class="btn btn-warning">Input Pembayaran</a>
                            <?php else: ?>
                            <a href="lihat_pembayaran.php?id=<?php echo $pch["id_pembelian"]; ?>" class="btn btn-success">
                                Lihat Pembayaran
                            </a>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php $nmr++; ?>
                   <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
    </section>
    <!-- End Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.html'; ?>
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
