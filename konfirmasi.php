<?php
include "functions/functions.php";
error_reporting(E_ERROR);

if( isset($_POST["cek"]) ) {
    $kodepembayaran = $_POST["kodepembayaran"];

    header("Location: konfirmasi.php?kode=".$kodepembayaran);
}

$kode = $_GET['kode'];

$result = mysqli_query($conn, "SELECT * FROM `tb_pembelian` INNER JOIN tb_pembayaran ON tb_pembelian.idpembelian = tb_pembayaran.idpembelian WHERE tb_pembelian.kode_pembayaran='$kode'");
$data = mysqli_fetch_assoc($result);
$status = $data['status'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>konfirmasi Pembayaran</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    
    <?php include "template/navbar.php"; ?>

    <div class="container">
        <div class="row justify-content-center my-4">
            <div class="col-md-6">
            <?php 
            if(isset($_GET["p"])) {
                $pesan = $_GET["p"];

                echo '<div class="alert alert-secondary alert-dismissible fade show my-3" role="alert">
                <strong>'.$pesan.'</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        ?>
                <div class="card">
                    <div class="card-header bg-info">Konfirmasi Pembayaran</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <label>Kode Pembayaran</label>
                            <input type="text" name="kodepembayaran" class="form-control"><br>
                            <button type="submit" class="btn btn-primary" name="cek">Cek</button>
                        </form>
                    </div>
                </div>

                <?php if(isset($_GET["kode"])) : ?>
                <div class="card mt-5">
                    <div class="card-header">Konfirmasi Pembayaran</div>
                    <div class="card-body">
                        <h1 class="text-center">
                            <?php if(is_null($status) || $status == 0): ?>
                                <i class="bi bi-x-lg text-danger"></i> Belum dibayar
                            <?php elseif($status == 1): ?>
                                <i class="bi bi-stopwatch text-warning"></i> Menunggu Konfirmasi
                            <?php elseif($status == 2): ?>
                                <i class="bi bi-check-circle text-success"></i> Sudah dibayar
                            <?php endif; ?>
                        </h1>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th>
                                    <th>Produk</th>
                                    <th>Kode Pembayaran</th>
                                </tr>
                                    <?php  
                                    if(isset($_GET["kode"])) {
                                        $kode = $_GET["kode"];
                                        $result = mysqli_query($conn, "SELECT * FROM `tb_pembelian` INNER JOIN tb_produk ON tb_pembelian.id_produk = tb_produk.id_produk WHERE kode_pembayaran = '$kode'");
                                    }

                                    $row = mysqli_fetch_assoc($result);
                                    $harga = $row["harga"];
                                    $qty = $row["qty"];
                                    $total = $harga * $qty;

                                    if(is_null($row)) {
                                        header("Location:konfirmasi.php");
                                    }

                                    ?>
                                    <tr>
                                        <td><?= $row["nama"]; ?></td>
                                        <td><?= $row["judul_produk"]; ?></td>
                                        <td><?= $row["kode_pembayaran"]; ?></td>
                                    </tr>
                            </table>
                        </div>
                        <?php if($status != 2): ?>
                        <p><b>Total Pembayaran Anda: <?= "Rp " . number_format($total,0,',','.'); ?></b></p>
                        <?php if($status != 1): ?>
                        <p class="text-danger">Silahkan kirim bukti Pembayaran di bawah ini.</p>
                        <p>Upload foto bukti pembayaran</p>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="file" name="bukti_pembayaran" class="form-control"><br>
                            <input type="hidden" name="idpembelian" value="<?= $row["idpembelian"]; ?>">
                            <button type="submit" class="btn btn-primary" name="btnbukti">Kirim</button>
                        </form>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>