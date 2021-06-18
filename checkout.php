<?php

require 'navbar.php';
require 'koneksi.php';

if(!isset($_SESSION["pembeli"]))
{
	echo "<script>alert('silahkan login');</script>";
    echo "<script>location='keranjang.php';</script>";
}

if(empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"]) )
{
    echo "<script>alert('keranjang kosong, silahkan belanja dulu');</script>";
	echo "<script>location='menu.php';</script>";
}
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>UMKM</title>
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
        <div class="page-header mb-0 gambar">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        
        <!-- Food Start -->
        <div class="container">
            <table class="table mt-4 text-center">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Produk</td>
                        <td>Harga</td>
                        <td>Jumlah</td>
                        <td>Subharga</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor=1;
                        $totalbelanja=0;
                        foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):
                        
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $pecah = $ambil->fetch_assoc();
                        $subharga = $pecah["harga_produk"]* $jumlah;
                    ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah["nama_produk"]; ?></td>
                        <td><?php echo number_format($pecah["harga_produk"]); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                    </tr>
                    <?php
                        $nomor++;
                        $totalbelanja+=$subharga;
                        endforeach
                    ?>
                </tbody>
                <tfoot>
                        <th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja); ?></th>
                </tfoot>
            </table>

            <form method="post">
				
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" readonly value="<?php echo $_SESSION["pembeli"]['nama_pembeli'] ?>" class="form-control">
						</div>
				</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" readonly value="<?php echo $_SESSION["pembeli"]['nomor_pembeli'] ?>" class="form-control">
						</div>
					</div>
				</div>
			    <button class="btn btn-warning" name="checkout">Bayar</button>
            </form>

        </div>
        <!-- Food End -->
        

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

<?php 
				if(isset($_POST["checkout"]))
				{
					$id_pembeli=$_SESSION["pembeli"]["id_pembeli"];
                    $total_pembelian = $totalbelanja;
					$tanggal_pembelian = date("Y-m-d");
                    
                    $koneksi->query("INSERT INTO pembelian(id_pembeli, tanggal_pembelian, total_pembelian) VALUES ('$id_pembeli', '$tanggal_pembelian', '$total_pembelian')");
                    
					$id_pembelian_barusan = $koneksi->insert_id;
					

					foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
					{
                        $ambil=$koneksi->query("SELECT * FROM produk where id_produk='$id_produk'");
                        $ambil1=$koneksi->query("SELECT * FROM pembeli where id_pembeli='$id_pembeli'");
                            $perproduk = $ambil->fetch_assoc();
                            $nama_produk=$perproduk['nama_produk'];
                            $harga_produk=$perproduk['harga_produk'];

                            $subharga = $perproduk['harga_produk']*$jumlah;

                            $perpembeli = $ambil1->fetch_assoc();
                            $nama_pembeli = $perpembeli['nama_pembeli'];
                            $nomor_pembeli = $perpembeli['nomor_pembeli'];
                            $alamat_pembeli = $perpembeli['alamat_pembeli'];

                        
						$koneksi->query("INSERT INTO checkout(id_pembelian, id_pembeli, nama_pembeli, nomor_pembeli, alamat_pembeli, id_produk,nama_produk, harga_produk, jumlah, subharga, tanggal_pembelian) 
                        VALUES ('$id_pembelian_barusan', '$id_pembeli', '$nama_pembeli', '$nomor_pembeli', '$alamat_pembeli', '$id_produk', '$nama_produk', '$harga_produk', '$jumlah', '$subharga', '$tanggal_pembelian')");
					}

					unset($_SESSION["keranjang"]);

					echo "<script>alert('pembelian sukses');</script>";
					echo "<script>location='notapembelian.php?id=$id_pembelian_barusan';</script>";
				}

?>