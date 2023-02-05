<?php 
require "functions/functions.php";

$id_user = $_SESSION["id_user"];
$username = $_SESSION["name"];

$result = mysqli_query($conn, "SELECT * FROM `tb_pembelian` INNER JOIN tb_produk ON tb_pembelian.id_produk = tb_produk.id_produk WHERE id_user = '$id_user' ORDER BY idpembelian DESC");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
  <?php include "template/navbar.php"; ?>

  <div class="container">
    <h2 class="text-center">Daftar Transaksi</h2>

    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <th>Nama</th>
          <th>Produk</th>
          <th>Jumlah Beli</th>
          <th>Kode Pembayaran</th>
          <th>Status</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): 
          $status = $row["status"];
          
          $statustext = "";
          if($status == 1 || $status == 0) {
            $statustext = "Belum di Konfirmasi";
          } else {
            $statustext = "Sudah di Konfirmasi";
          }
          
        ?>
        <tr>
          <td><?= $row["nama"]; ?></td>
          <td><?= $row["judul_produk"]; ?></td>
          <td><?= $row["qty"]; ?></td>
          <td><?= $row["kode_pembayaran"]; ?></td>
          <td><?= $statustext ?></td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>

  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>