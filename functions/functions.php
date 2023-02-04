<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_latihan") or die("gagal koneksi");
$error = "";

function upload() {
    $nama_file = $_FILES["gambar"]["name"];
    $tipe_file = $_FILES["gambar"]["type"];
    $ukuran_file = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmp_file = $_FILES["gambar"]["tmp_name"];

    // cek apakah ada gambar atau tidak
    if( $error == 4 ) {
        return 'nopoto.png';
    }

    // cek ekstensi file
    $daftar_gambar = ["jpg", "jpeg", "png"];
    $ekstensi_file = explode(".", $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));

    if(!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<script>
            alert('yang anda pilih bukan gambar');
            window.location.href = 'produk.php';
        </script>";
    }

    // cek tipe file
    if($tipe_file != "image/jpeg" && $tipe_file != "image/png") {
        echo "<script>
            alert('yang anda pilih bukan gambar');
            window.location.href = 'produk.php';
        </script>";
    }

    // cek ukuran file
    if($ukuran_file > 5000000) {
        echo "<script>
            alert('ukuran gambar terlalu besar');
            window.location.href = 'produk.php';
        </script>";
    }

    $nama_file_baru = uniqid();
    $nama_file_baru .= ".";
    $nama_file_baru .= $ekstensi_file;

    move_uploaded_file($tmp_file, "assets/img/" . $nama_file_baru);

    return $nama_file_baru;

}

// tambah produk
if( isset($_POST["btntambahproduk"]) ) {
    $title_produk = $_POST["produk"];
    $deskripsi = $_POST["deskripsi"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $gambar = upload();

    $result = mysqli_query($conn, "INSERT INTO tb_produk (judul_produk, harga, stok, deskripsi, gambar) VALUES ('$title_produk', '$harga', '$stok', '$deskripsi', '$gambar')");

    if($result) {
        $error = "BERHASIL MELAKUKAN TAMBAH PRODUK";
        header("Location: produk.php");
    }

}

// hapus produk
if( isset($_POST["btnhapusproduk"]) ) {
    $id = $_POST["idproduk"];

    $result = mysqli_query($conn, "DELETE FROM tb_produk WHERE id_produk = $id");

    if($result) {
        header("Location: produk.php");
    }

}

// edit produk
if( isset($_POST["btneditproduk"]) ){
    $id = $_POST["idproduk"];
    $title_produk = $_POST["produk"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $gambar = upload();

    $result = mysqli_query($conn, "UPDATE tb_produk SET judul_produk = '$title_produk', harga = '$harga', stok = '$stok', gambar = '$gambar'  WHERE id_produk = $id");

    if($result) {
        header("Location: produk.php");
    }

}

// tambah form pembelian
if(isset($_GET["beli"])) {
    $id = $_GET["beli"];
    $query = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk = $id");
}

if( isset($_POST["checkout"]) ) {
    $nama = $_POST["nama"];
    $noktp = $_POST["noktp"];
    $kodepos = $_POST["kodepos"];
    $alamat = $_POST["alamat"];
    $pengiriman = $_POST["pengiriman"];

    $query = mysqli_query($conn, "SELECT * FROM tb_pembelian");
    $rows = mysqli_num_rows($query)+1;
    $kode_pembayaran = "K66" . $rows;



    $result = mysqli_query($conn, "INSERT INTO tb_pembelian (id_produk, nama, no_ktp, kode_pos, alamat, jasa_pengiriman, kode_pembayaran, status) VALUES ('$id', '$nama', '$noktp', '$kodepos', '$alamat', '$pengiriman', '$kode_pembayaran', 0)");

    if($result) {
        header("Location: struk.php?beli="."$id");
    }

}

// upload bukti pembayaran
if( isset($_POST["btnbukti"]) ) {
    $idpembelian = $_POST["idpembelian"];
    $direktori = "assets/bukti/";
    $file_name = $_FILES["bukti_pembayaran"]["name"];
    
    $ekstensi_file = explode(".", $file_name);
    $ekstensi_file = strtolower(end($ekstensi_file));

    $nama_file_baru = uniqid();
    $nama_file_baru .= ".";
    $nama_file_baru .= $ekstensi_file;

    move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $direktori.$nama_file_baru);

    $result = mysqli_query($conn, "INSERT INTO tb_pembayaran (idpembelian, bukti, status) VALUES ($idpembelian, '$nama_file_baru', 1)");

    $result2 = mysqli_query($conn, "UPDATE tb_pembayaran, tb_pembelian SET tb_pembelian.status = 1 WHERE tb_pembayaran.status = 1");

    if($result) {
        header("Location: konfirmasi.php");
    }
}

if( isset($_POST["verifikasi"]) ) {
    $idpembelian = $_POST["idpembelian"];
    $result = mysqli_query($conn, "UPDATE tb_pembayaran, tb_pembelian SET tb_pembayaran.status = 2, tb_pembelian.status = 2 WHERE tb_pembayaran.idpembelian = $idpembelian");

    if($result) {
        header("Location: konfirmasi_pembayaran_admin.php");
    }
}

function register($data) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $data["username"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirmpass = mysqli_real_escape_string($conn, $data["confirm_pass"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
            alert('Sudah ada username yang terdaftar');
        </script";
        return false;
    }

    // cek apakah password sama dengan konfimasi password
    if( $password != $confirmpass ) {
        echo "<script>
            alert('Password tidak sama dengan konfirmasi password');
        </script";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // masukkan ke database
    mysqli_query($conn, "INSERT INTO tb_user (username, password, status) VALUES ('$username', '$password', 0)");

    return mysqli_affected_rows($conn);

}

function cek_status($username) {
    global $conn;
  
    $name = mysqli_escape_string($conn, $username);
    $query = "SELECT status FROM tb_user WHERE username = '$name'";
  
    if( $result = mysqli_query($conn, $query) ) {
      while( $row = mysqli_fetch_assoc($result) ) {
        $status = $row["status"];
      }
    }
    return $status;
  }


?>