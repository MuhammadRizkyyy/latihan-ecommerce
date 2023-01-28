<?php
include "functions/functions.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Toko Printer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="produk.php">Home</a>
                <a class="nav-link active" href="#">Features</a>
                <a class="nav-link active" href="#">Pricing</a>
            </div>
            </div>
        </div>
    </nav>

    
    

    <div class="container">
        <div class="row justify-content-center my-4">
          <div class="col-md-7">
            <div class="card">
              <div class="card-body">
                <h1 class="text-success">Selamat!</h1>
                <h3>Anda berhasil melakukan pemesanan barang!</h3><hr>
                <h5 class="text-center text-danger">Silakan lakukan pembayaran sesuai detail berikut.</h5><br>

                <h3 class="text-center">B03893023</h3>
                <p class="text-center font-weight-bold mb-0">a/n Toko Printer</p>
                <p class="text-center">BCA kode bank: 006</p><hr>

                <?php 
                  $result = mysqli_query($conn, "SELECT * FROM tb_pembelian AS pem, tb_produk AS pro WHERE pem.id_produk = pro.id_produk ORDER BY pem.id DESC LIMIT 1");
                  $row = mysqli_fetch_assoc($result);
                  
                ?>
                <h5 class="text-center">Total yang harus dibayar</h5>
                <h2 class="text-center"><?= "Rp " . number_format($row["harga"],0,',','.'); ?></h2><hr>

                <h5 class="text-center">Kode Pembayaran</h5>
                <h2 class="text-center"><?= $row["kode_pembayaran"]; ?></h2>

                <br><br>
                <p class="text-danger text-center">Jika sudah transfer, lakukan konfirmasi pembayaran pada link <a href="konfirmasi.php" target="_blank">konfirmasi pembayaran</a></p>
                <h4 class="text-center">Terima Kasih!</h4>
              </div>
            </div>
          </div>
        </div>
    </div>



    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>