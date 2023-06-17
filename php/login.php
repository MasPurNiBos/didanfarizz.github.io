<?php
$host="localhost";
$user="root";
$password="";
$database="login_fullgame";


$koneksi = mysqli_connect("localhost","root","","login_fullgame");

if ($koneksi){
   echo "berhasil";
}else{
   echo"gagal";
}

require 'functions.php';

if( isset($_POST["signup"]) ) {

    if( register($_POST) > 0 ) {
        echo "<script>
                alert('new user has been added!');
                </script>";

    } else {
        echo mysqli_error($conn);
    }

}

if( isset($_POST["login"]) ) {

   $email = $_POST["email"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

   // cek username
   if( mysqli_num_rows($result) === 1 ) {

      // cek password
      $row = mysqli_fetch_assoc($result);
      if( password_verify($password, $row["password"]) ) {
         header("location: index.html");
         exit;
      }
   }

   $error = true;

}

?>

<?php if( isset($error) ) : ?>
   <p style="color: red; font-style: italic;">username / password salah! </p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Responsive Signup/Login form | Nothing4us</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'><link rel="stylesheet" href="login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
   <section id="formHolder">

      <div class="row">

         <!-- Brand Box -->
         <div class="col-sm-6 brand">
            <a href="#" class="logo"><span></span></a>

            <div class="heading">
               <h2>FUll<span>game</span></h2>
               <p>Play it till done</p>
            </div>

            <div class="success-msg">
               <p>Great! You are one of our members now</p>
               <a href="#" class="profile">Your Profile</a>
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">

            <!-- Login Form -->
            <div class="login form-peice switched">
               <form class="login-form" action="#" method="post">
                  <div class="form-group">
                     <label for="loginemail">Email Adderss</label>
                     <input type="email" name="email" id="email" required>
                  </div>

                  <div class="form-group">
                     <label for="loginPassword">Password</label>
                     <input type="password" name="password" id="password" required>
                  </div>

                  <div class="CTA">
                     <input type="submit" name="login" value="Login" id="login">
                     <a href="#" class="switch">I'm New</a>
                  </div>
               </form>
            </div><!-- End Login Form -->


            <!-- Signup Form -->
            <div class="signup form-piece">
               <form class="signup-form" action="#" method="post">

                  <div class="form-group">
                     <label for="name">Full Name</label>
                     <input type="text" name="fullname" id="fullname" class="name">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="email">Email Adderss</label>
                     <input type="email" name="email" id="email" class="email">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="phone">Phone Number - <small>Optional</small></label>
                     <input type="text" name="number" id="number">
                  </div>

                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" class="pass">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="passwordCon">Confirm Password</label>
                     <input type="password" name="password2" id="password2" class="passConfirm">
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                     <input type="submit" name='signup' value="Signup Now" id="signup">
                     <a href="#" class="switch">I have an account</a>
                  </div>
                  
               </form>
            </div><!-- End Signup Form -->
         </div>
      </div>

   </section>

</div>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script><script src="login.js"></script>

</body>
</html>
