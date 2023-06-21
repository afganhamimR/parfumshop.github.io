<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum");


if (!isset($_SESSION['pelanggan']))
{
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parfum Shop - Checkout</title>
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
    #btn {
      margin-top: 2rem;
    }
    #tab {
      margin-top: 1.2rem;
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

            <li><a id="ai" href="checkout.php" class="active">Checkout</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

     <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/jessi.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Checkout</h2>
        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Checkout</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Section ======= -->
    <section id="get-started" class="get-started section-bg">
      <div class="container" data-aos="fade-up">
        <div class="container">
    
            <div class="row">
             <h2>Checkout</h2>
            <hr>
            <table id="tab" class="table">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
            
                    </tr>
                </thead>
                <tbody>
                    <?php $nmr=1; ?>
                    <?php $totalbelanja= 0; ?>
                     <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                        <?php
                        $ambl = $kn->query("SELECT * FROM product WHERE id_product='$id_produk'");
                        $pch = $ambl->fetch_assoc();
                        $subharga = $pch["harga_product"]*$jumlah;
 
                        ?>
                    <tr>
                        <td id="no"><?php echo $nmr; ?></td>
                        <td><?php echo $pch["nama_product"]; ?></td>
                        <td>Rp. <?php echo number_format($pch["harga_product"]); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                       
                    </tr>
                    <?php $nmr++; ?>
                    <?php $totalbelanja+=$subharga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <th colspan="4">Total Belanja</th>
                    <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                </tfoot>
            </table>
           <form method="post">
            
            <div class="row">
                <div id="btn" class="col-md-3"><div class="form-group">
                <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>"
                class="form-control">
            </div></div>
                <div id="btn" class="col-md-3"><div class="form-group">
                <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telp_pelanggan'] ?>"
                class="form-control">
            </div></div>
                <div class="col-md-3">
                    <select id="btn" class="form-control" name="id_ongkir">
                        <option value=""> Pilih daerah & ongkos kirim</option>
                        <?php 
                        $ambl = $kn->query("SELECT * FROM ongkir");
                        while ($perongkir = $ambl->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $perongkir["id_ongkir"] ?>">
                            <?php echo $perongkir['nama_kota'] ?> -
                            Rp. <?php echo number_format ($perongkir['tarif']) ?> 
                        </option>
       
                        <?php } ?>
                    </select>
                </div>
            <div class="col-md-3">
                    <select id="btn" class="form-control" name="id_jasa">
                        <option value="">Pilih Jasa Pengiriman</option>
                        <?php 
                        $ambl = $kn->query("SELECT * FROM jasa_pengiriman");
                        while ($perjasa = $ambl->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $perjasa["id_jasa"] ?>">
                            <?php echo $perjasa['nama_jasa'] ?> 
                        </option>
       
                        <?php } ?>
                        
                    </select>
                </div>
            </div>
            <div id="btn" class="form-group">
                <label>Alamat Lengkap Pengiriman</label>
                <textarea class="form-control" name="alamat_pengiriman" placeholder="Masukan alamat lengkap pengiriman(termasuk kode pos)"></textarea>
            </div>
            <button id="btn" class="btn btn-primary" name="checkout">Checkout</button>
           </form>

           <?php 
           if (isset($_POST["checkout"]))
           {
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_ongkir = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");
            $alamat_pengiriman = $_POST['alamat_pengiriman'];

            $ambl = $kn->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
            $arrayongkir=$ambl->fetch_assoc();
            $nama_kota = $arrayongkir['nama_kota'];
            $tarif = $arrayongkir['tarif'];

            $total_pembelian = $totalbelanja + $tarif;

           if (isset($_POST["checkout"]))
           {
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_jasa = $_POST["id_jasa"];
            $nama_jasa = $_POST['nama_jasa'];

            $ambl = $kn->query("SELECT * FROM jasa_pengiriman WHERE id_jasa='$id_jasa'");
            $arrayjasa=$ambl->fetch_assoc();
            $nama_jasa = $arrayjasa['nama_jasa'];
          
            

            $kn->query("INSERT INTO pembelian (
                id_pelangganbeli,id_ongkir,id_jasa,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman,nama_jasa)
            VALUES ('$id_pelanggan','$id_ongkir','$id_jasa','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman','$nama_jasa') ");

            $id_pembelian_barusan = $kn->insert_id;

            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
            {
                $ambl=$kn->query("SELECT * FROM product WHERE id_product='$id_produk'");
                $perproduk = $ambl->fetch_assoc();
                
                $nama = $perproduk['nama_product'];
                $harga = $perproduk['harga_product'];
                $berat = $perproduk['berat_product'];

                $subberat = $perproduk['berat_product']*$jumlah;
                $subharga = $perproduk['harga_product']*$jumlah;
                $kn->query("INSERT INTO pembelian_product (id_pembelian,id_product,nama,harga,berat,subberat,subharga,jumlah)
                VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah') ");


                $kn->query("UPDATE product SET stok_produk=stok_produk -$jumlah
                WHERE id_product='$id_produk'");


            }

            unset($_SESSION["keranjang"]);

            echo "<script>alert('Pembelian berhasil');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

           }
        }


           ?>

         </div>
       </div>
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
