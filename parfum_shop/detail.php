<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum"); ?>

<?php 
$id_produk = $_GET["id"];

$ambl = $kn->query("SELECT * FROM product WHERE id_product='$id_produk'");
$detail = $ambl->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parfum Shop - Detail</title>
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
    section .container {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      padding: 50px;
      margin-bottom: 20px;
    }
    #side {
      padding-top: 20px;
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
          <li><a href="shop.php" class="active">Shop</a></li>
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
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/hero-carousel/zamor.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Detail Produk</h2>
        <ol>
          <li><a href="shop.php">Shop</a></li>
          <li>Detail Produk</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- start section -->
   <section id="get-started" class="get-started section-bg">
    
       <div class="container">
            <div class="row">
           <div class="col-md-6">
            <img id="gbr" src="foto_product/<?php echo $detail['gambar_product']; ?>" alt=""
            class="img-responsive">
           </div>
           <div id="side" class="col-md-6">
            <h2><?php echo $detail["nama_product"] ?></h2>
            <h4>Rp. <?php echo number_format ($detail["harga_product"]); ?></h4>

            <h5>Stok: <?php echo $detail['stok_produk'] ?></h5>

            <p><?php echo $detail["deksripsi_product"]; ?></p>

            <form method="post">
                <div class="form-group">
                    <div class="input-group">
                        <input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail["stok_produk"] ?>">

                         <div class="input-group-btn">
                            <button class="btn btn-primary" name="beli">Beli</button>
            </div>
            </div>
                </div>
            </form>

            <?php
            if (isset($_POST["beli"]))
            {
                $jumlah = $_POST["jumlah"];
                $_SESSION["keranjang"][$id_produk] = $jumlah;

                echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
                echo "<script>location='keranjang.php';</script>";
            }
            ?>

           </div>
            </div>
        </div>
 
    
</section>
<!-- PHP -->

<!-- Akhir PHP -->

  <!-- ======= Footer ======= -->
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
  

  <!--  JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

