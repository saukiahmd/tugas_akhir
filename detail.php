
<?php include 'koneksi.php';
require 'navbar.php' ?>
<?php
$id_produk = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

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


        <div class="container">
            <div class="row">
            <div class="card col" style="width: 25rem; margin-top: 100px; ">
            
                    <img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="">
                </div>
                <div class="col mt-5 pt-5">
                    <h2><?php echo $detail["nama_produk"] ?></h2>
                    <h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
                    <p><?php echo $detail["deskripsi_produk"]; ?></p>
                    
                    <a href="belanja.php" class="btn btn-primary">Selesai</a>
                    



                </div>        
            </div>
        </div>

</body>
</html>


