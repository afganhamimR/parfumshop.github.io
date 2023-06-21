<!--koneksi ke database-->
<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum");


if (!isset($_SESSION['admin']))
{
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman admin</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/newcustom.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<style>
#gam {
            margin-top: 2cm;
            width: 135px;
}
.navbar{
            position: fixed;
            z-index: 9999;
            width: 100%;
        }
.sidebar-collapse{
            position:fixed;
            width: 200px;  
            
}
#page-inner {
            margin-top: 2cm;
          
}
#as{
    font-family: 'Poppins', sans-serif;
}
.navbar-cls-top  {
    background-color:#5189c6;
}
</style>

<body>
    <!--navbar top-->
    <div id="wrapper"> 
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            
  <div id="as" style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> &nbsp; ADMIN </div>
        </nav>   
                 <!--Navbar side-->
            <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img id="gam" src="assets/img/profile.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a id="as"  href="index.php"><i class="fa fa-home "></i> Home </a>
                    </li>
                    <li>
                        <a id="as" href="index.php?halaman=product"><i class="fa fa-folder-open"></i> Produk </a>
                    </li>
                    <li>
                        <a id="as" href="index.php?halaman=pembelian"><i class="fa fa-shopping-cart"></i> Pembelian </a>
                    </li>
                    <li>
                        <a id="as"  href="index.php?halaman=laporan_pembelian"><i class="fa fa-file "></i> Laporan Pembelian </a>
                    </li>
                    <li>
                        <a id="as" href="index.php?halaman=pelanggan"><i class="fa fa-user"></i> Pelanggan </a>
                    </li>
                    <li>
                        <a id="as" href="index.php?halaman=logout"><i class="fa fa-sign-out"></i> Logout </a>
                    </li>
                     
                </ul>
               
            </div>
            
        </nav>  
        <div id="page-wrapper" >
            <div id="page-inner">
               <?php
               if (isset($_GET['halaman'])) 
               {
                 if ($_GET['halaman']=="product")
                 {
                    include 'product.php';
                 }
                 elseif ($_GET['halaman']=="pembelian")
                   {
                     include 'pembelian.php';
                   }
                 elseif ($_GET['halaman']=="pelanggan")
                   {
                    include 'pelanggan.php';
                   }
                 elseif ($_GET['halaman']=="detail")
                 {
                    include 'detail.php';
                 }
                 elseif ($_GET['halaman']=="tambahproduct")
                 {
                    include 'tambahproduct.php';
                 }
                 elseif ($_GET  ['halaman']=="hapusproduct")
                 {
                    include 'hapusproduct.php';
                 }
                 elseif ($_GET['halaman']=="hapuspelanggan")
                 {
                    include 'hapuspelanggan.php';
                 }
                 elseif ($_GET['halaman']=="ubahproduct")
                 {
                    include 'ubahproduct.php';
                 }
                 elseif ($_GET['halaman']=="logout")
                 {
                    include 'logout.php';
                 }
                 elseif ($_GET['halaman']=="pembayaran")
                 {
                    include 'pembayaran.php';
                 }
                 elseif ($_GET['halaman']=="laporan_pembelian")
                 {
                    include 'laporan_pembelian.php';
                 }
                 

               } 
               else
               {
                  include 'home.php';
               } 
               ?>    
    </div>
            
            </div>

        </div>
    </div>
    
    <script src="assets/js/jquery-1.10.2.js"></script>
    
    <script src="assets/js/bootstrap.min.js"></script>
   
    <script src="assets/js/jquery.metisMenu.js"></script>
    
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
     
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
