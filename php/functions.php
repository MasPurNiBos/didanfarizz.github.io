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

function register($data) {
    global $conn;

    $fullname = strtolower(stripslashes($data["name"]));
    $email = mysqli_real_escape_string($conn, $data["email"]);
    $number = mysqli_real_escape_string($conn, $data["number"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 =  mysqli_real_escape_string($conn, $data["passwordCon"]);

    // cek username sudah ada
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$fullname'");
    
    if( mysqli_fetch_assoc($result) ){
        echo "<script>
                alert('username sudah terdaftar!')       
              </script>";
        return false;
    }

    // cek konfirmasi pasword
    if ( $password !== $password2 ){
        echo "<script>
                alert('password tidak sesuai!')       
              </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES('', '$fullname', '$email', '$number', '$password')");

    return mysqli_affected_rows($conn);
}

?>