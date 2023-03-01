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
    <title>Detail Produk</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    
<?php include "template/navbar.php"; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card my-3">
                    <div class="card-body">
                        <div class="row">
                            <?php 
                                $id = $_GET["detail"];
                                $result = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk = $id");
                                while($row = mysqli_fetch_assoc($result)):
                                    $produk = $row["judul_produk"];
                                    $harga = $row["harga"];
                                    $stok = $row["stok"];
                                    $gambar = $row["gambar"];
                                    $deskripsi = $row["deskripsi"];
                            ?>
                            <!-- kiri -->
                            <div class="col-md-6">
                                <img src="assets/img/<?= $gambar ?>" alt="gambar printer" width="100%" height="200px">
                            </div>
                            <!-- kanan -->
                            <div class="col-md-6">
                                <h5><?= $produk; ?></h5>
                                <h4><?= "Rp " . number_format($harga,0,',','.'); ?></h4>
                                <p><strong>Stok: <?= $stok; ?></strong></p>
                                <p><?= $deskripsi; ?></p>
                                <?php if($super_user == false): ?>
                                    <a href="form_beli.php?beli=<?= $id; ?>" class="btn btn-primary" name="btnbeli">Beli</a>
                                <?php endif; ?>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>