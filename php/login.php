<?php
require 'functions.php';

if( isset($_POST["submit"]) ) {

    if( register($_POST) > 0 ) {
        echo "<script>
                alert('new user has been added!');
                </script>";

    } else {
        echo mysqli_error($conn);
    }

}

if( isset($_POST["login"]) ) {

   $loginemail = $_POST["email"];
   $loginPassword = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$loginemail'");

   // cek username
   if( mysqli_num_rows($result) === 1 ) {

      // cek password
      $row = mysqli_fetch_assoc($result);
      if( password_verify($loginPassword, $row["password"]) ) {
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
  <title>FULLGAME - The Best Sports Center</title>
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
               <form class="login-form" action="" method="post">
                  <div class="form-group">
                     <label for="loginemail">Email Address</label>
                     <input type="email" name="loginemail" id="loginemail" required>
                  </div>

                  <div class="form-group">
                     <label for="loginPassword">Password</label>
                     <input type="password" name="loginPassword" id="loginPassword" required>
                  </div>

                  <div class="CTA">
                     <input type="submit" value="Login" id="login">
                     <a href="#" class="switch">I'm New</a>
                  </div>
               </form>
            </div><!-- End Login Form -->


            <!-- Signup Form -->
            <div class="signup form-peice">
               <form class="signup-form" action="" method="post">

                  <div class="form-group">
                     <label for="name">Full Name</label>
                     <input type="text" name="name" id="name" class="name">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="email">Email Address</label>
                     <input type="email" name="email" id="email" class="email">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="phone">Phone Number</label>
                     <input type="text" name="phone" id="phone">
                  </div>

                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" class="pass">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="passwordCon">Confirm Password</label>
                     <input type="password" name="passwordCon" id="passwordCon" class="passConfirm">
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                     <input type="submit" value="Signup Now" name="submit" id="submit">
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
