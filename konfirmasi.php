<?php
include "functions/functions.php";

$result = mysqli_query($conn, "SELECT status FROM tb_pembelian");
$row = mysqli_fetch_assoc($result);
$status = $row["status"];

if( isset($_POST["cek"]) ) {
    $kodepembayaran = $_POST["kodepembayaran"];

    header("Location: konfirmasi.php?kode=".$kodepembayaran);

    

}


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
                            <?php 
                                if(isset($_GET["kode"])) {
                                    $kode = $_GET["kode"];
                                    $result = mysqli_query($conn, "SELECT * FROM tb_pembelian AS pem, tb_produk AS pro WHERE pem.kode_pembayaran = '$kode'");

                                }
                                $row = mysqli_fetch_assoc($result);
                                $status = $row["status"];
                            ?>
                            <?php if($status == 0): ?>
                                <i class="bi bi-x-lg text-danger"></i> Belum dibayar
                            <?php elseif($status == 1): ?>
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
                                        $result = mysqli_query($conn, "SELECT * FROM tb_pembelian AS pem, tb_produk AS pro WHERE pem.kode_pembayaran = '$kode'");

                                        $result2 = mysqli_query($conn, "SELECT * FROM tb_pembelian AS pem, tb_produk AS pro WHERE pem.id_produk = pro.id_produk ORDER BY pem.id DESC LIMIT 1");

                                    }

                                    $row = mysqli_fetch_assoc($result);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    ?>
                                    <tr>
                                        <td><?= $row["nama"]; ?></td>
                                        <td><?= $row2["judul_produk"]; ?></td>
                                        <td><?= $row["kode_pembayaran"]; ?></td>
                                    </tr>
                            </table>
                        </div>
                        <p><b>Total Pembayaran Anda: <?= "Rp " . number_format($row2["harga"],0,',','.'); ?></b></p>
                        <p class="text-danger">Silahkan kirim bukti Pembayaran di bawah ini.</p>
                        <p>Upload foto bukti pembayaran</p>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="file" name="bukti_pembayaran" class="form-control"><br>
                            <button type="submit" class="btn btn-primary" name="btnbukti">Kirim</button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>



    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>