<?php

require 'navbar.php';
require 'koneksi.php';

if (!isset($_SESSION["pembeli"])) {
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet" />

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
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php $ambil = $koneksi->query("SELECT * FROM checkout JOIN produk on checkout.id_produk=produk.id_produk WHERE checkout.id_pembelian='$_GET[id]'"); ?>

                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                    <?php $rating = $koneksi->query("SELECT count(*) as total FROM rating where id_produk='$pecah[id_produk]' AND id_pembeli='$pecah[id_pembeli]'"); ?>
                    <?php $data = mysqli_fetch_assoc($rating);
                    ?>

                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['nama_produk']; ?></td>
                        <td><?php echo $pecah['harga_produk']; ?></td>
                        <td><?php echo $pecah['jumlah']; ?></td>
                        <td>

                            <?php echo $pecah['harga_produk'] * $pecah['jumlah']; ?>
                        </td>

                        <td><button class="btn btn-warning" name="checkout" type="button" data-toggle="modal" data-target="#exampleModal<?php echo $pecah['id_produk'] ?>" <?php if ($data['total'] >= 1) {
                                                                                                                                                                                echo "disabled";
                                                                                                                                                                            } ?>>Beri Ulasan</button></td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $pecah['id_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title text" id="exampleModalLabel">Ulasan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group text-center">
                                            <div>
                                                <label required class="small mb-1" for="">
                                                    <h5 class=""><?php echo $pecah['nama_produk']; ?></h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <div class="container d-flex justify-content-center mt-200">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="stars">                                                                                
                                                            <input class="star star-1<?php echo $pecah['id_produk']; ?>" id="star-1<?php echo $pecah['id_produk']; ?>" type="radio" name="star" value="5" /><label class="star star-1<?php echo $pecah['id_produk']; ?>" for="star-1<?php echo $pecah['id_produk']; ?>"></label>
                                                            <input class="star star-2<?php echo $pecah['id_produk']; ?>" id="star-2<?php echo $pecah['id_produk']; ?>" type="radio" name="star" value="4" /> <label class="star star-2<?php echo $pecah['id_produk']; ?>" for="star-2<?php echo $pecah['id_produk']; ?>"></label>
                                                            <input class="star star-3<?php echo $pecah['id_produk']; ?>" id="star-3<?php echo $pecah['id_produk']; ?>" type="radio" name="star" value="3" /> <label class="star star-3<?php echo $pecah['id_produk']; ?>" for="star-3<?php echo $pecah['id_produk']; ?>"></label>
                                                            <input class="star star-4<?php echo $pecah['id_produk']; ?>" id="star-4<?php echo $pecah['id_produk']; ?>" type="radio" name="star" value="2" /> <label class="star star-4<?php echo $pecah['id_produk']; ?>" for="star-4<?php echo $pecah['id_produk']; ?>"></label>
                                                            <input class="star star-5<?php echo $pecah['id_produk']; ?>" id="star-5<?php echo $pecah['id_produk']; ?>" type="radio" name="star" value="1" /> <label class="star star-5<?php echo $pecah['id_produk']; ?>" for="star-5<?php echo $pecah['id_produk']; ?>"></label>
                                                                                                                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                            <button type="submit" class="btn btn-warning" name="simpan<?php echo $pecah['id_produk'] ?>">Simpan</button>
                                        </div>
                                    </form>

                                

                                </div>
                            </div>
                        </div>

                        <?php
                        if (isset($_POST['simpan' . $pecah['id_produk']])) {
                            $id_produk = $pecah["id_produk"];
                            $id_pembeli = $pecah["id_pembeli"];
                            $star = $_POST["star"];
                            $id_pembeli = $_SESSION["pembeli"]["id_pembeli"];
                            $total_pembelian = $totalbelanja;
                            $tanggal_pembelian = date("Y-m-d");

                            $koneksi->query("INSERT INTO pembelian(id_pembeli, tanggal_pembelian, total_pembelian) VALUES ('$id_pembeli', '$tanggal_pembelian', '$total_pembelian')");

                            $id_pembelian_barusan = $koneksi->insert_id;

                           

                            $d = "INSERT INTO rating (id_pembeli, id_produk, nilai_rating) VALUES ('$id_pembeli', '$id_produk', '$star')";
                            $query = mysqli_query($koneksi, $d);

                            if ($query) {

                                if (mysqli_num_rows($ambil) < 1) {
                                    echo "<script>location='menu.php';</script>";
                                } else {
                                    echo "<script>alert('Berhasil Di Tambahkan!')</script>";
                                    echo "<script>location='notapembelian.php?id=".$_GET['id']."    ';</script>";
                                }
                            } else {
                                echo "<script>alert('Gagal Di Tambahkan!')</script>";
                                echo "<script>location='notapembelian.php?id=".$_GET['id']."';</script>";
                            }
                        }
                        ?>

                        <?php $nomor++; ?>
                    <?php } ?>
            </tbody>
        </table>


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
    .gambar {
        background: url(assets/img/yellow.jpg);
    }


    body {
        background-color: #eee
    }

    div.stars {
        width: 270px;
        display: inline-block
    }

    .mt-200 {
        margin-top: 0px
    }

    input.star {
        display: none
    }

    label.star {
        float: right;
        padding: 10px;
        font-size: 36px;
        color: #F7DC6F;
        transition: all .2s
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s
    }

    input.star-5:checked~label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952
    }

    input.star-1:checked~label.star:before {
        color: #F62
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3)
    }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome
    }
</style>