<?php
session_start();
$kn = new mysqli("localhost","root","","tokoparfum");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />
  
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    
    <link href="assets/css/custom.css" rel="stylesheet" />
    
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>
<style>
    h2, h3{
        color:#000;
    }
    body{
        background-image: url(../assets/img/jessi.jpg);
        background-size: cover;
        padding: 70px 0 15px 0;
        position: relative;
    }
    .container {
        font-family: 'Poppins', sans-serif;
    }
    .row {
        font-family: 'Poppins', sans-serif;
    }
    #a {
    color: blue;
}
</style>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> Login Admin</h2>
                <h3>Parfum Shop</h3>
               <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div  class="panel-heading">
                        <strong>   Login Admin </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-log-in"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Username" name="user" />
                                        </div>
                                            <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Password"  name="pass" />
                                        </div><br>
                                    
                                    <!-- <div class="login_signup">Don't have an account? <a id="a" href="signup.php" id="signup">Signup</a></div> -->
                                    <button class="btn btn-primary" name="login">Login</button>
                                    <hr />
                        
                                    </form>
                                    <?php 
                                    if (isset($_POST['login']))
                                    {
                                        $ambl = $kn->query("SELECT * FROM admin WHERE username='$_POST[user]'
                                         AND password ='$_POST[pass]'");
                                        $cocok = $ambl->num_rows;
                                        if ($cocok==1)
                                        {
                                            $_SESSION['admin']=$ambl->fetch_assoc();
                                            echo "<div class='alert alert-info'>Login Sukses</div>";
                                            echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                                        }
                                        else
                                        {
                                            echo "<div class='alert alert-danger'>Login Gagal</div>";
                                            echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                        }
                                    }
                                    ?>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>


    
    <script src="assets/js/jquery-1.10.2.js"></script>
     
    <script src="assets/js/bootstrap.min.js"></script>
   
    <script src="assets/js/jquery.metisMenu.js"></script>
    
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
