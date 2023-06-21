<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum"); ?>
<?php $keyword = $_GET["keyword"];

$semuadata=array();
$ambl = $kn->query("SELECT * FROM product WHERE nama_product LIKE '%$keyword%'
OR deksripsi_product LIKE '%$keyword%'");
while($pch = $ambl->fetch_assoc())
{
    $semuadata[]=$pch;
}


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parfum Shop - Shop</title>
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
  #card {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      padding: 10px;
      margin-left: 3rem;
      margin-bottom: 2rem;
    }
    #btn {
      margin-left: 15rem;
      margin-top: -3rem ;
      padding-right: 2rem;
    }
    .row h3 {
        margin-bottom: 2rem;
        margin-left: 2.1rem;
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
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/blue.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Search</h2>
        <ol>
          <li><a href="shop.php">Shop</a></li>
          <li>Search</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Section ======= -->
    <section id="get-started" class="get-started section-bg">
      <div class="container" data-aos="fade-up">
        <div class="container">
        
            <div class="row">
            <h3>Hasil Pencarian : <?php echo $keyword ?></h3>

<?php if (empty($semuadata)): ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
  <div>
  Pencarian <strong><?php echo $keyword ?></strong> tidak ditemukan
  </div>
<?php endif ?>

<?php foreach ($semuadata as $key => $value): ?>

    
          <div id="card" class="card col-md-3" style="width: 18rem;">
  <img id="gmbr" src="foto_product/<?php echo $value['gambar_product']; ?>" alt="" img>
  <div class="card-body">
   <h5><?php  echo $value['nama_product']; ?></h5>
   <h6>Rp. <?php echo number_format($value['harga_product']); ?></h6>
   <a href="beli.php?id=<?php echo $value['id_product']; ?>" class="btn btn-primary">Beli</a>
   <a href="detail.php?id=<?php echo $value['id_product']; ?>" class="btn btn-warning">Detail</a>
    
    </div>
</div>
<?php endforeach ?>

</div>
</div>
        
    </section>
    <!-- End Section -->

  </main><!-- End #main -->

  <?php include 'footer.php'; ?>

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