
<?php
    session_start();

    if(!isset($_SESSION["admin"])){
        header("location: login.php");
        exit;
    }
        
    include '../../koneksi.php';
    $ambil=$koneksi->query("SELECT * FROM kategoriwilayah WHERE id_kategoriwilayah='$_GET[id]'");
	$pecah=$ambil->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin UMKM</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand"><?php echo $_SESSION['admin']['nama_admin']; ?></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="produk.php">
                                <div class="sb-nav-link-icon"></div>
                                Produk
                            </a>
                            <a class="nav-link" href="daftar.php">
                                <div class="sb-nav-link-icon"></div>
                                Anggota
                            </a>
                            <a class="nav-link" href="kategori.php">
                                <div class="sb-nav-link-icon"></div>
                                Kategori Makanan
                            </a>
                            <a class="nav-link" href="kategoriwilayah.php">
                                <div class="sb-nav-link-icon"></div>
                                Kategori Wilayah
                            </a>
                            <a class="nav-link" href="pembelian.php">
                                <div class="sb-nav-link-icon"></div>
                                Pembelian
                            </a>
                            <a class="nav-link" href="statuspembelian.php">
                                <div class="sb-nav-link-icon"></div>
                                Status Pembelian
                            </a>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <!-- dashboard isi -->
                <div class="container">
                <h5 class="mb-4 mt-4">Ubah Produk</h5>
                <form method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputNamaKategori">Nama</label>
                                                <input class="form-control py-4" value="<?php echo $pecah['nama_kategoriwilayah']; ?>" id="inputNamaProduk" type="text" name="namakategori" placeholder="Masukan Nama Produk" />
                                            </div>
                <div class="modal-footer">
                    <a href="kategoriwilayah.php" class="btn btn-secondary">Keluar</a>
                    <button type="submit" class="btn btn-primary" name="ubah" >Simpan</button>
                    
                    
                </div>
                </form>
                </div>

                
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>






<?php
	if(isset($_POST['ubah']))
	{
		

                $koneksi->query("UPDATE kategoriwilayah SET nama_kategoriwilayah='$_POST[namakategori]' WHERE id_kategoriwilayah='$_GET[id]'");
                echo "<script>alert('data kategori telah diubah');</script>";
			    echo "<script>location='kategoriwilayah.php';</script>";
			}
	
?>
	
