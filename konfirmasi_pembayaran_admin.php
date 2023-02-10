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
    <?php 
    if(isset($_GET["p"])) {
        $pesan = $_GET["p"];

        echo '<div class="alert alert-secondary alert-dismissible fade show my-3" role="alert">
        <strong>'.$pesan.'</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <h3 class="text-center my-3">Daftar konfirmasi pembayaran</h3>

    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <th>Nama</th>
          <th>Kode Pembayaran</th>
          <th width="20%">Bukti</th>
          <th width="30%">Aksi</th>
        </tr>
        <?php 
        $result = mysqli_query($conn, "SELECT * FROM `tb_pembayaran` INNER JOIN tb_pembelian ON tb_pembayaran.idpembelian = tb_pembelian.idpembelian WHERE tb_pembayaran.status = 1");

        while($row = mysqli_fetch_assoc($result)): 
          $idpembelian = $row["idpembelian"];
          $idproduk = $row["id_produk"];
          $qty = $row["qty"];
        ?>
        <tr>
          <form action="" method="post">
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["kode_pembayaran"]; ?></td>
            <td><img src="assets/bukti/<?= $row["bukti"] ?>" class="card-img-top"></td>
            <td>
              <!-- <button type="submit" name="verifikasi" class="btn btn-success">Konfirmasi</button> -->
              <button type="button" class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#konfirmasi<?= $idpembelian; ?>">Konfirmasi</button>
              <button type="button" class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#tolak<?= $idpembelian; ?>">Tolak</button>
            </td>
          </form>
        </tr>

        <!-- modal konfirmasi -->
        <div class="modal fade" id="konfirmasi<?= $idpembelian; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Transaksi</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                  <p>Apakah ingin mengkonfirmasi transaksi ini?</p>
                  <input type="hidden" name="idpembelian" value="<?= $idpembelian; ?>">
                  <button type="submit" name="verifikasi" class="btn btn-success">Konfirmasi</button>
              </form>
            </div>
          </div>
        </div>
      </div>

        <!-- modal tolak -->
        <div class="modal fade" id="tolak<?= $idpembelian; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Konfirmasi</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                  <p>Apakah yakin ingin menolak transaksi ini?</p>
                  <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                  <input type="hidden" name="kty" value="<?= $qty; ?>">
                  <input type="hidden" name="idpembelian" value="<?= $idpembelian; ?>">
                  <button type="submit" class="btn btn-danger" name="tolak">Tolak</button>
              </form>
            </div>
          </div>
        </div>
      </div>
        <?php endwhile; ?>
      </table>
    </div>

  </div>


  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>