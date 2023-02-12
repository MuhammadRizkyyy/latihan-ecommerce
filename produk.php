<?php
include "functions/functions.php";

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
    <title>Produk</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        .produk {
            color: black;
            text-decoration: none;
        }
        .kartu {
            -webkit-box-shadow: 0px 0px 13px -3px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 13px -3px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 13px -3px rgba(0,0,0,0.75);
        }
    </style>
</head>
<body>
    
<?php include "template/navbar.php"; ?>

    <div class="container mb-5">
        <?php include "template/carousel.php"; ?>
        <?php if($super_user == true): ?>
            <h3 class="mt-4">Tambah Produk</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahproduk">
            Tambah Produk
            </button>
        <?php endif; ?>

        <?php 
            if(isset($_GET["p"])) {
                $pesan = $_GET["p"];

                echo '<div class="alert alert-secondary alert-dismissible fade show my-3" role="alert">
                <strong>'.$pesan.'</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        ?>

        <div class="row">
            <?php 
                $result = mysqli_query($conn, "SELECT * FROM tb_produk");
                while($row = mysqli_fetch_assoc($result)) :
                    $id = $row["id_produk"];
                    $produk = $row["judul_produk"];
                    $harga = $row["harga"];
                    $stok = $row["stok"];
                    $gambar = $row["gambar"];
                    $deskripsi = $row["deskripsi"];
            ?>
            <div class="col g-3">
                <div class="card h-100 border-0 kartu" style="width: 15rem;">
                    <img src="assets/img/<?= $gambar ?>" class="card-img-top" width="100%" height="150px">
                    <div class="card-body">
                        <h5 class="card-"><a href="detail.php?detail=<?= $id ?>" class="produk"><?= $produk ?></a></h5>
                        
                        <p class="card-text"><?= "Rp " . number_format($harga,0,',','.'); ?></p>

                        <?php if($super_user == true): ?>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusproduk<?= $id ?>">
                            <i class="bi bi-trash-fill"></i>
                            </button>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editproduk<?= $id ?>">
                            <i class="bi bi-pencil-square"></i>
                            </button>
                        <?php endif; ?>
                        
                        <?php if($super_user == false): ?>
                            <a href="detail.php?detail=<?= $id ?>" class="btn btn-primary">Beli</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Modal hapus-->
            <div class="modal fade" id="hapusproduk<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                Apakah Yakin ingin menghapus <?= $produk ?>?
                                <input type="hidden" name="idproduk" value="<?= $id ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" name="btnhapusproduk">Hapus</button>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            
            <!-- Modal Edit-->
            <div class="modal fade" id="editproduk<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="text" value="<?= $produk ?>" name="produk" class="form-control" required><br>
                                <input type="text" value="<?= $harga ?>" name="harga" class="form-control" required><br>
                                <input type="number" value="<?= $stok ?>"  name="stok" class="form-control" required><br>
                                <textarea name="deskripsi" cols="30" rows="10" class="form-control"><?= $deskripsi ?></textarea><br>
                                <img src="assets/img/<?= $gambar ?>" class="card-img-top img-preview" width="100%" height="200px"><br><br>
                                <input type="file" value="<?= $gambar ?>" name="gambar" class="form-control gambar" onchange="preview()"><br>
                                <input type="hidden" name="gambar_lama" value="<?= $gambar; ?>">
                                <input type="hidden" name="idproduk" value="<?= $id ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" name="btneditproduk">Edit</button>
                        </div>
                            </form>
                    </div>
                </div>
            </div>

            <?php endwhile;?>
        </div>
    </div>



    <!-- Modal tambah-->
    <div class="modal fade" id="tambahproduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="text" placeholder="Nama Produk" name="produk" class="form-control" required><br>
                        <input type="text" placeholder="Harga" name="harga" class="form-control" required><br>
                        <input type="number" placeholder="Stok" name="stok" class="form-control" required><br>
                        <textarea name="deskripsi" placeholder="Deskripsi" cols="30" rows="10" class="form-control"></textarea><br>
                        <input type="file" name="gambar" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="btntambahproduk">Tambah</button>
                </div>
                    </form>
            </div>
        </div>
    </div>


    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        function preview() {
            const gambar = document.querySelector('.gambar');
            const imgpreview = document.querySelector('.img-preview');
            const oFReader = new FileReader();

            oFReader.readAsDataURL(gambar.files[0]);

            oFReader.onload = function(oFREvent) {
                imgpreview.src = oFREvent.target.result;
            };
        }
    </script>

</body>
</html>