<?php 
require "functions/functions.php";



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi Pembayaran</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
  
  <?php include "template/navbar.php"; ?>

  <div class="container">
    <h3 class="text-center my-3">Daftar konfirmasi pembayaran</h3>

    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <th>Nama</th>
          <th>Kode Pembayaran</th>
          <th width="20%">Bukti</th>
          <th>Aksi</th>
        </tr>
        <?php 
        $result = mysqli_query($conn, "SELECT * FROM tb_pembayaran bayar, tb_pembelian beli WHERE bayar.status = 1");

        while($row = mysqli_fetch_assoc($result)): 
        ?>
        <tr>
          <td><img src="assets/bukti/<?= $row["bukti"] ?>" class="card-img-top"></td>
          <td>
            <a href="" class="btn btn-success">Verifikasi</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>

  </div>


  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>