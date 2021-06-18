<?php include 'koneksi.php';
require 'navbar.php' ?>
<?php
$id_produk = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Burger King - Food Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Nunito:600,700" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        
        
        <!-- Page Header Start -->
        <div class="page-header gambar">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Produk</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        

        <!-- Team Start -->
        <div class="team">
            <div class="container">
                <div class="section-header text-center">
                    <h2><?php echo $detail["nama_produk"] ?></h2>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="team-item">
                            <div class="team-img rounded">
                            <a href="tampildetail.php">
                                <img src="foto_produk/<?php echo $detail["foto_produk"]; ?>">
                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 card">
                    <div class="">
                        <h4 class="mt-4">Harga : <?php echo number_format($detail["harga_produk"]); ?></h4>
                        <h5 class="mt-2">Deskripsi : <?php echo $detail["deskripsi_produk"] ?></h5>
                        <h5>Nomor Telp : <?php echo $detail["hp_produk"] ?></h5>
                        <h5>Alamat : <?php echo $detail["alamat_produk"] ?></h5>
                        <p>Stok :</p>
                        </div>
                        <div>
                    <a href="menu.php" class="btn btn-warning col-3">Beli</a>
                    
                    <a href="menu.php" class="btn btn-warning col-3 ml-2">Kembali</a>
                    </div>
                    </div>
                </div> 
            </div>   
        </div>
        <!-- Team End -->



        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>

<style>
.gambar{
    background: url(assets/img/yellow.jpg);
}
</style>