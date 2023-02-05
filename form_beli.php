<?php 
require 'functions/functions.php';

if( !isset($_SESSION["login"]) ) {
  header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembelian</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    
<?php include "template/navbar.php"; ?>

    <div class="container">
      <div class="card">
        <div class="card-header">Info Produk</div>
        <div class="card-body">
        <?php 
          $id = $_GET["beli"];
          $result = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk = $id");
          while($row = mysqli_fetch_assoc($result)):
              $produk = $row["judul_produk"];
              $harga = $row["harga"];
              $stok = $row["stok"];
              $gambar = $row["gambar"];
              $deskripsi = $row["deskripsi"];
        ?>
        <img src="assets/img/<?= $gambar; ?>" alt="">
        <h5><?= $produk; ?></h5>
        <h4><?= "Rp " . number_format($harga,0,',','.'); ?></h4>
        <?php endwhile; ?>
        </div>
      </div>

      <div class="card my-4">
        <div class="card-header">Form Pembelian</div>
        <div class="card-body">
          <form action="" method="post">
            <div class="col-md-4">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>No. KTP</label>
              <input type="number" name="noktp" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Kode Pos</label>
              <input type="number" name="kodepos" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Alamat Tujuan Pengiriman</label>
              <input type="text" name="alamat" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Jumlah Pembelian</label>
              <input type="number" name="qty" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Jasa Pengiriman</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pengiriman" value="JNE" id="jne" required> <label for="jne">JNE</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pengiriman" value="J&T" id="jnt" required> <label for="jnt">J&T</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pengiriman" value="Sicepat" id="sicepat" required> <label for="sicepat">Sicepat</label>
              </div>
            </div>
              <?php
                $result = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id = $id");
              ?>
              <br>
              <button type="submit" name="checkout" class="btn btn-primary">Checkout</button>
          </form>
        </div>
      </div>
    </div>

</body>
</html>