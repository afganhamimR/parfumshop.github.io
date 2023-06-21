<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <title>Parfume Shop | SignUp</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap');
*{
    font-family: 'poppins' ,sans-serif;
}
body{
    background-image: url("assets/img/blackbg.jpg");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    
}
.box{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 90vh;
}
.container{
    width: 350px;
    display: flex;
    flex-direction: column;
    padding: 0 15px 0 15px;
    
}
span{
    color: #fff;
    font-size: small;
    display: flex;
    justify-content: center;
    padding: 10px 0 10px 0;
}
header{
    color: #fff;
    font-size: 30px;
    display: flex;
    justify-content: center;
    padding: 10px 0 10px 0;
}

.input-field .input{
    height: 45px;
    width: 87%;
    border: none;
    border-radius: 30px;
    color: #fff;
    font-size: 15px;
    padding: 0 0 0 45px;
    background: rgba(255,255,255,0.1);
    outline: none;
}
i{
    position: relative;
    top: -33px;
    left: 17px;
    color: #fff;
}
::-webkit-input-placeholder{
    color: #fff;
}
.submit{
    border: none;
    border-radius: 30px;
    font-size: 15px;
    height: 45px;
    outline: none;
    width: 100%;
    color: black;
    background: rgba(255,255,255,0.7);
    cursor: pointer;
    transition: .3s ;
}
.submit:hover{
    box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
}
.two-col{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    color: #fff;
    font-size: small;
    margin-top: 10px;
}
.one{
    display: flex;
}
label a{
    text-decoration: none;
    color: #fff;
}
.login_signup {
    margin-top: 1.2rem;
    color: #fff;
    text-align: center;

}
#a {
    color: yellow;
}
header {
    margin-bottom: 1rem;
    size: 15px;
}

    </style>

</head>
<body>
   <div class="box">
    <div class="container">

        <div class="top">
           
            <header>Sign Up</header>
        </div>
        <form method="post">
        <div class="input-field">
            <input type="text" class="input" placeholder="Nama Lengkap" name="nama" required>
            <i class='bx bx-user' ></i>
        </div>
        <div class="input-field">
            <input type="email" class="input" placeholder="Email" name="email" required>
            <i class="bi bi-envelope"></i>
        </div>
        <div class="input-field">
            <input type="Password" class="input" placeholder="Password" name="password" minlength="5" required>
            <i class='bx bx-lock-alt'></i>
        </div>
        <div class="input-field">
            <input type="text" class="input" placeholder="Alamat" name="alamat" required>
            <i class="bi bi-house"></i>
        </div>
        <div class="input-field">
            <input type="number" class="input" placeholder="Telp/WhatsApp" name="telepon" required>
            <i class="bi bi-whatsapp"></i>
        </div>
        <div class="input-field">
            <input type="submit" class="submit" name="sign" value="Sign Up">
        </div>
        <div class="login_signup">Already have an account? <a id="a" href="login.php" id="login">Login</a></div>
        </form>

        <?php
                       if (isset($_POST["sign"]))
                       {
                        $nama = $_POST["nama"];
                        $email = $_POST["email"];
                        $password = md5($_POST["password"]);
                        $alamat = $_POST["alamat"];
                        $telepon = $_POST["telepon"];

                        $ambil = $kn->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                        $yangcocok = $ambil->num_rows;
                        if ($yangcocok==1) 
                        {
                            echo "<script>alert('Sign Up gagal, email sudah digunakan');</script>";
                            echo "<script>location='registrasi.php';</script>";
                        }
                        else 
                        {
                            $kn->query("INSERT INTO pelanggan
                            (email_pelanggan,password_pelanggan,nama_pelanggan,
                            telp_pelanggan,alamat_pelanggan)
                            VALUES('$email','$password','$nama','$telepon','$alamat')");

                            echo "<script>alert('Sign Up berhasil, silahkan login');</script>";
                            echo "<script>location='login.php';</script>";
                        }
                       }
                        ?>  
        </div>
    </div>
    </div>
</div>  
</body>
</html>