<nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Toko Printer</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="produk.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="konfirmasi.php">Konfirmasi</a>
        </li>
        <?php if($super_user == true): ?>
        <li class="nav-item">
          <a class="nav-link active" href="konfirmasi_pembayaran_admin.php">Konfirmasi Pembayaran</a>
        </li>
        <?php endif; ?>
      </ul>
        <a href="logout.php" class="btn btn-outline-primary text-dark" type="submit">Logout</a>
    </div>
  </div>
</nav>