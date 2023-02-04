<?php 

require "functions/functions.php";

if( isset($_POST["submit"]) ) {
  if(register($_POST) > 0) {
    echo "<script>
            alert('user baru berhasil ditambahkan');
        </script";
    header("Location: index.php");
  } else {
    echo mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>

  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4 class="text-center">Registrasi</h4>

            <form action="" method="post">
              <input type="text" class="form-control" name="username" placeholder="Username"><br>
              <input type="password" class="form-control" name="password" placeholder="Password"><br>
              <input type="password" class="form-control" name="confirm_pass" placeholder="Konfirmasi Password">
              <p>Sudah punya akun? <a href="index.php">Login</a></p>

              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
    </div>
  </div>
  </div>

  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>