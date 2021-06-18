<?php

require 'navbar.php';
require 'koneksi.php';

if(!isset($_SESSION["pembeli"]))
{
	echo "<script>alert('silahkan login');</script>";
    echo "<script>location='keranjang.php';</script>";
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
                        <h2>Nota Pembelian</h2>
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
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor telp</th>
                    <th>Alamat</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $ambil=$koneksi->query("SELECT * FROM checkout JOIN produk on checkout.id_produk=produk.id_produk WHERE checkout.id_pembelian='$_GET[id]'"); ?>
                <?php while($pecah=$ambil->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah['nama_pembeli']; ?></td>
                    <td><?php echo $pecah['nomor_pembeli']; ?></td>
                    <td><?php echo $pecah['alamat_pembeli']; ?></td>
                    <td><?php echo $pecah['nama_produk']; ?></td>
                    <td><?php echo $pecah['harga_produk']; ?></td>
                    <td><?php echo $pecah['jumlah']; ?></td>
                    <td>
                        <?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
                    </td>
                    <td></td>
                </tr>
                <?php $nomor++; ?>
                <?php } ?>
            </tbody>
            </table>

            <form method="post">
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" readonly value="<?php echo $_SESSION["pembeli"]['nama_pembeli'] ?>" class="form-control">
						</div>
				</div>
				<div class="container">
			    <button class="btn btn-warning" name="checkout" type="button" data-toggle="modal" data-target="#exampleModal">Bayar</button>
                <a href="ulasan.php" class="btn btn-warning ml-2">Pesanan diterima</a>
                </div>
            </form>

        </div>
        <!-- Food End -->
        

        

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kirim Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div>
                                <label required class="small mb-1" for="inputFotoPembayaran">Foto</label>
                            </div>
                            <input class="mb-3" id="inputFotoPembayaran" type="file" name="file" />
                        </div>
                    </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-warning" name="simpan">Simpan</button>
                </div>
                </div>
            </div>
            </div>

            <?php
            if (isset($_POST['simpan'])) {



                
                $nama = $_FILES['file']['name'];
                $lokasi = $_FILES['file']['tmp_name'];

                move_uploaded_file($lokasi, "../../foto_produk/" . $nama);
                $koneksi->query("INSERT INTO checkout (foto_pembayaran) VALUES('$nama')");

                if ($koneksi) {
                    echo "<script>alert('Berhasil Di Tambahkan!')</script>";
                    echo "<meta http-equiv='refresh'content='1;url=notapembelian.php'>";
                } else {
                    echo "<script>alert('gagal Di Tambahkan!')</script>";
                    echo "<meta http-equiv='refresh'content='1;url=notapembelian.php'>";
                }
            }
            ?>

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
