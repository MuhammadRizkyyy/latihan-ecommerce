<?php 
require "functions/functions.php";

if( isset($_SESSION["login"]) ) {
  header("Location: produk.php");
}

if( isset($_POST["submit"]) ) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

  // cek username
  if( mysqli_num_rows($result) === 1 ) {
    // cek password
    $row = mysqli_fetch_assoc($result);
    if( password_verify($password, $row["password"]) ) {
      $_SESSION["login"] = true;
      $_SESSION["name"] = $username;
      header("Location: produk.php");
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>

  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4 class="text-center">Login</h4>

            <form action="" method="post">
              <input type="text" class="form-control" name="username" placeholder="Username"><br>
              <input type="password" class="form-control" name="password" placeholder="Password">
              <p>Belum punya akun? <a href="register.php">Registrasi Akun</a></p>

              <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
        </div>
    </div>
  </div>
  </div>

  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>