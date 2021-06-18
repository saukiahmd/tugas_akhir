<?php
require 'navbar.php';
require 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>UMKM</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    

  <div class="input-group w-25 mt-5 ml-5">
      <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3"><a href="" class="text-dark">Pencarian</a></span>
      </div>
</div>

<div class="row">
                <?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
				<?php while($perproduk=$ambil->fetch_assoc()) { ?>
<div class="col-3">
    <div class="card col mx-auto" style="width: 18rem; margin-top: 50px;">
        <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>">
    <div class="card-body">
        <img class="card-img-top" src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="Card image cap">
        <h4 class="card-title text-center mt-4 text-dark"><?php echo $perproduk['nama_produk']; ?></h5>
        <h5 class="text-center mt-4 text-dark">Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
        </div>
        </a>
        
</div>

</div>
<?php } ?>  
</div>

</body>
</html>
