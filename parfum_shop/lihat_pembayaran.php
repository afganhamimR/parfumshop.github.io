<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum"); 

$id_pembelian = $_GET["id"];

$ambl = $kn->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
 WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambl->fetch_assoc();


if (empty($detbay))
{
    echo "<script>alert('Belum ada data pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parfum Shop - Lihat Pembayaran</title>
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
    #mb {
      margin-bottom: 1.4rem
    }
    #mt {
      margin-top: 1rem
    }
    section #con {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
      padding: 50px;
      margin-bottom: 20px;
    }

    section .container {

      border-radius: 1px;
      box-shadow:  1px 1px rgba(0, 0, 0, 0.0);
      }
      #tab {
        padding-top: 1.5rem;
      }
      #img {
        padding-top: 1.2rem;
      }

      .gallery {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.gallery img {
    /*width: 20rem;
    height: 20rem;*/
    object-fit: cover;
    cursor: pointer;
    margin-bottom: 10px;
}

.modal {
    display: none;
    position: fixed;
    z-index: 999;
    padding-top: 50px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.9);
}

.modal img {
    display: block;
    margin: 0 auto;
    max-width: 80%;
    max-height: 80%;
}

.close {
    color: #fff;
    position: absolute;
    top: 10px;
    right: 25px;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
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
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/hero-carousel/vanesa.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

       <h2>Bukti Pembayaran</h2>
        <ol>
          <li><a href="riwayat.php">Riwayat Belanja</a></li>
          <li>Lihat Pembayaran</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->
     
      <section id="get-started" class="get-started section-bg">
      <div class="container" data-aos="fade-up">
        <div id="con" class="container">
 
 <h3>Bukti Pembayaran <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>
 <hr>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                <tr>
                <th id="tab">Nama</th>
                <td id="tab"><?php echo $detbay["nama"] ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?php echo $detbay["bank"] ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?php echo date("d F Y",strtotime ($detbay["tanggal"])) ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
            </tr>
                </table>
            </div>
            <div class="col-md-6 gallery">
                <img id="img" src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive" onclick="openModal('bukti_pembayaran/<?php echo $detbay["bukti"] ?>')" >

                 <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img src="" id="modalImage">
        </div>
            </div>
        </div>
    </div>

       
   

  </main><!-- End #main -->

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
 

  <!-- JS File -->
  <script src="assets/js/main.js"></script>
  <script src="javabox.js"></script>

</body>

</html>