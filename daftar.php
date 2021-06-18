<?php
require 'koneksi.php';
require 'navbar.php';
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
                        <h2>Daftar</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        
        <!-- Food Start -->
        <div class="card mt-5 mb-3 container col-5">
            <div class="card-body">
                <form action="" method="post">
                <input class="form-control login" type="text" name="username" placeholder="Masukan Nama Anda" required><br>
                <input class="form-control login" type="password" name="password" placeholder="Masukan Password Anda" required><br>
                <input class="form-control login" type="email" name="email" placeholder="Masukan Email Anda" required><br>
                <input class="form-control login" type="number" name="number" placeholder="Masukan Nomer Hp Anda" required><br>
                <textarea class="form-control login" name="alamat" placeholder="Masukan Alamat Anda" required></textarea>

                <input class="btn btn-warning mt-3 mb-2" type="submit" name="daftar" value="Daftar">
                <a href="menu.php" class="btn btn-warning mt-3 mb-2">Kembali</a>
                </form>
            </div>
        </div>
        <!-- Food End -->
        

        <?php 
            if(isset($_POST['daftar'])){
                $nama = $_POST["username"];
                $password = $_POST["password"];
                $email = $_POST["email"];
                $nomor = $_POST["number"];
                $alamat = $_POST["alamat"];

                $d = "INSERT INTO pembeli (nama_pembeli, password_pembeli, email_pembeli, nomor_pembeli, alamat_pembeli) VALUES ('$nama', '$password', '$email', '$nomor', '$alamat')";
                $query = mysqli_query($koneksi, $d);

                
                if(!preg_match("/^[a-zA-Z]*$/", $nama)){
                    echo "<script>alert('Masukkan Nama Hanya Huruf!')</script>";
                    echo "<script>location='daftar.php';</script>";
                }else{
                    if(!preg_match("/^[a-zA-Z0-9]*$/", $password)){
                        echo "<script>alert('Masukkan Password Hanya Huruf dan Angka!')</script>";
                        echo "<script>location='daftar.php';</script>";
                    }else{
                        if(!preg_match("/^[0-9]*$/", $nomor)){
                            echo "<script>alert('Masukkan Nomor Telp Hanya Angka!')</script>";
                            echo "<script>location='daftar.php';</script>";
                        }else{
                            if($query){

                                echo "<script>alert('Berhasil Di Tambahkan!')</script>";
                                echo "<script>location='menu.php';</script>";
                            }else{
                                echo "<script>alert('Gagal Menambahkan Akun!')</script>";
                            }
                        }
                    }
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