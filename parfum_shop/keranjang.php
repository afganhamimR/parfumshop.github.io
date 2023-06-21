<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parfum Shop - Keranjang</title>
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
    #tab {
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
          <li><a href="keranjang.php" class="active">Keranjang</a></li>
          
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
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/bglog.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Keranjang</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Keranjang</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Section ======= -->
    <section id="get-started" class="get-started section-bg">
      <div class="container" data-aos="fade-up">
        <div class="container">
            
            <div class="row">

      <h1>Keranjang Belanja</h1>
            <hr>
            <table id="tab" class="table">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nmr=1; ?>
                     <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                        <?php
                        $ambl = $kn->query("SELECT * FROM product WHERE id_product='$id_produk'");
                        $pch = $ambl->fetch_assoc();
                        $subharga = $pch["harga_product"]*$jumlah;
 
                        ?>
                    <tr>
                        <td id="no"><?php echo $nmr; ?></td>
                        <td><?php echo $pch["nama_product"]; ?></td>
                        <td id="no">Rp. <?php echo number_format($pch["harga_product"]); ?></td>
                        <td id="no"><?php echo $jumlah; ?></td>
                        <td id="no">Rp. <?php echo number_format($subharga); ?></td>
                        <td id="no">
                            <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
                        </td>
                    </tr>
                    <?php $nmr++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>

</div>
  <a href="shop.php" class="btn btn-warning">Lanjutkan Belanja</a>
  <a href="checkout.php" class="btn btn-primary">Checkout</a>
</div>
        
    </section>
    <!-- End Section -->

  </main><!-- End #main -->

 <?php include 'footer.html'; ?>

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
