<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum"); 

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
    echo "<script>alert('Silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$idpem = $_GET["id"];
$ambl = $kn->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambl->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parfum Shop - Pembayaran</title>
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
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/hero-carousel/white.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

       <h2>Konfirmasi Pembayaran</h2>
        <ol>
          <li><a href="riwayat.php">Riwayat Belanja</a></li>
          <li>Konfirmasi Pembayaran</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->
     
      <section id="get-started" class="get-started section-bg">
      <div class="container" data-aos="fade-up">
        <div class="container">
            
            <div class="row">
       <h2>Konfirmasi Pembayaran</h2>
       <hr>
    <p>Kirim bukti pembayaran Anda disini</p>
    <div class="alert alert-info">Total tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>

    <div class="form signup_form">
    <form method="post" enctype="multipart/form-data">
        <div class="input_box">
            <label id="mt">Nama Penyetor</label> 
            <input id="mb" type="text" class="form-control" name="nama">          
        </div>      
        <div class="input_box">
            <label>Bank</label> 
            <select id="mb" class="form-control" name="bank">
            <option value="BNI">BNI</option> 
            <option value="Bank Mandiri">Bank Mandiri</option> 
            <option value="BCA">BCA</option>
            <option value="BRI">BRI</option>
            </select>        
        </div> 

           <div class="input_box">
            <label>Jumlah</label> 
            <input id="mb" type="text" readonly value="<?php echo ($detpem["total_pembelian"]) ?>" class="form-control" name="jumlah" >          
        </div> 

        <div class="input_box">

            <label>Foto Bukti Transfer</label> 
            <input type="file" class="form-control" name="bukti">
            <p class="text-danger">Foto bukti transfer harus JPG/PNG maksimal 5MB dan <b>FOTO HARUS JELAS</b></p>          
        </div>  
        <button class="btn btn-primary" name="kirim">Kirim</button>     
    </form>
    </div>
    </div>
</div>
 
<?php
date_default_timezone_set("Asia/Jakarta");
if (isset($_POST["kirim"]))
{
  $namabukti = $_FILES["bukti"]["name"];
  $lokasibukti = $_FILES["bukti"]["tmp_name"];
  $namafiks = date("dmY His").$namabukti;
  move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

  $nama = $_POST["nama"];
  $bank = $_POST["bank"];
  $jumlah = $_POST["jumlah"];
  $tanggal = date("Y-m-d");

  $kn->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
  VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

  $kn->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran'
  WHERE id_pembelian='$idpem'");

   echo "<script>alert('Terimakasih sudah mengirimkan bukti pembayaran');</script>";
   echo "<script>location='riwayat.php';</script>";
}
?>
     </div>
     </div>
   </div>
     </section>

       
   

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
  

  <!--  JS File -->
  <script src="assets/js/main.js"></script>
  <script src="script.js"></script>

</body>

</html>