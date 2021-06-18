<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit;
}





require '../../koneksi.php';

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
                        <a class="nav-link" href="Daftar.php">
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
            <div id="team">
                <div class="container">
                    <h5>Data Produk</h5>
                    <div class="row  mb-3 mt-3">
                        <div class="input-group w-50 col-4">
                            <input type="text" class="form-control" name="cari" aria-describedby="basic-addon3" id="cari" onkeyup="cari()">
                        </div>
                        <div class="d-flex justify-content-end mb-2 col-4">
                            <select name="kategori" id="kategori" class="form-control btn btn-secondary  ml-auto" onchange="kategori()">
                                <option value="0">Pilih Kategori Makanan</option>
                                <?php
                                $category = mysqli_query($koneksi, "select * from kategori") or die(mysqli_error);
                                while ($data = $category->fetch_assoc()) { ?>
                                    <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                                <?php } ?>
                                <option value="0">Pilih Semua</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end mb-2 col-4">
                            <select name="kategoriwilayah" id="kategoriwilayah" class="form-control btn btn-secondary  ml-auto" onchange="kategoriwilayah()">
                                <option value="0">Pilih Kategori Makanan</option>
                                <?php
                                $category1 = mysqli_query($koneksi, "select * from kategoriwilayah") or die(mysqli_error);
                                while ($data = $category1->fetch_assoc()) { ?>
                                    <option value="<?php echo $data['id_kategoriwilayah']; ?>"><?php echo $data['nama_kategoriwilayah']; ?></option>
                                <?php } ?>
                                <option value="0">Pilih Semua</option>
                            </select>
                        </div>
                    </div>
                    <div id="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Harga</td>
                                <td>Foto</td>
                                <td>Deskripsi</td>
                                <td>No Hp</td>
                                <td>Alamat</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $halaman = 10;
                            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                            $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
                            $result = mysqli_query($koneksi, "SELECT * FROM produk");
                            $total = mysqli_num_rows($result);
                            $pages = ceil($total / $halaman);
                            $query = mysqli_query($koneksi, "select * from produk LIMIT $mulai, $halaman") or die(mysqli_error);

                            $nomor = 1;
                            $ambil = $query;

                            ?>
                            <?php while ($pecah = $ambil->fetch_assoc()) { ?>

                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $pecah['nama_produk']; ?></td>
                                    <td><?php echo $pecah['harga_produk']; ?></td>
                                    <td><img src="../../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100"></td>
                                    <td><?php echo $pecah['deskripsi_produk']; ?></td>
                                    <td><?php echo $pecah['hp_produk']; ?></td>
                                    <td><?php echo $pecah['alamat_produk']; ?></td>
                                    <td class="d-flex justify-content-between">
                                        <a href="ubahproduk.php?id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning">Ubah</a>

                                        <a href="hapusproduk.php?id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn">Hapus</a>
                                        
                                        
                                    </td>
                                </tr>
                                <?php $nomor++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                       <div class="row d-flex justify-content-between ml-1 mr-1"> 
                        <div>
                            
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <?php for ($i = 1; $i <= $pages; $i++) { ?>
                                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                            
                            <div>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>
                            </div>
                        </div>
                        </div>
            </div>
            </div>
        </div>





        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="small mb-1" for="inputNamaProduk">Nama</label>
                                <input required class="form-control py-4" id="inputNamaProduk" type="text" name="namaproduk" placeholder="Masukan Nama Produk" />
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputHargaProduk">Harga</label>
                                <input required class="form-control py-4" id="inputHargaProduk" type="number" name="hargaproduk" placeholder="Masukan Harga Produk" />
                            </div>
                            <div class="form-group">
                                <label required class="small mb-1" for="inputFotoProduk">Foto</label>
                            </div>
                            <input class="mb-3" id="inputFotoProduk" type="file" name="file" />
                            <div class="form-group">
                                <label class="small mb-1" for="inputDeskripsiProduk">Deskripsi</label>
                                <input required class="form-control py-4" id="inputDeskripsiProduk" type="text" name="deskripsiproduk" placeholder="Masukan Deskripsi Produk" />
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputNoHp">No Hp</label>
                                <input class="form-control py-4" id="inputNoHp" type="number" name="nohp" placeholder="Masukan No Hp" >
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputDeskripsiProduk">Alamat</label>
                                <textarea class="form-control py-4" id="inputDeskripsiProduk" type="textarea" name="alamatproduk" placeholder="Masukan Alamat" ></textarea>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputKategoriProduk">Kategori Makanan</label>
                                <select name="KategoriProduk" id="inputKategoriProduk" class="form-control">
                                    <?php
                                    $category = mysqli_query($koneksi, "select * from kategori") or die(mysqli_error);
                                    while ($data = $category->fetch_assoc()) { ?>
                                        <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputKategoriWilayah">Kategori Wilayah</label>
                                <select name="KategoriWilayah" id="inputKategoriWilayah" class="form-control">
                                    <?php
                                    $category1 = mysqli_query($koneksi, "select * from kategoriwilayah") or die(mysqli_error);
                                    while ($data = $category1->fetch_assoc()) { ?>
                                        <option value="<?php echo $data['id_kategoriwilayah']; ?>"><?php echo $data['nama_kategoriwilayah']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>


    <?php
    if (isset($_POST['simpan'])) {



        $id_admin=$_SESSION["admin"]["id_admin"];
        $nama = $_FILES['file']['name'];
        $lokasi = $_FILES['file']['tmp_name'];

        move_uploaded_file($lokasi, "../../foto_produk/" . $nama);
        $koneksi->query("INSERT INTO produk (id_admin, id_kategori, id_kategoriwilayah, nama_produk, harga_produk, foto_produk, deskripsi_produk ,hp_produk ,alamat_produk) VALUES('$id_admin', '$_POST[KategoriProduk]', '$_POST[KategoriWilayah]', '$_POST[namaproduk]', '$_POST[hargaproduk]', '$nama', '$_POST[deskripsiproduk]', '$_POST[nohp]', '$_POST[alamatproduk]')");

        if ($koneksi) {
            echo "<script>alert('Berhasil Di Tambahkan!')</script>";
            echo "<meta http-equiv='refresh'content='1;url=produk.php'>";
        } else {
            echo "<script>alert('gagal Di Tambahkan!')</script>";
            echo "<meta http-equiv='refresh'content='1;url=produk.php'>";
        }
    }
    ?>


</body>





</html>



<script>
    function kategori() {

        var kategori = $("#kategori").val();
        $.ajax({
            type: 'GET',
            url: 'get_kategori.php?id=' + kategori,
            success: function(res) {
                console.log(kategori);
                if (kategori == 0) {
                    window.location.href = "produk.php";
                }
                console.log(res);
                $('#row').html(res);
            }
        });
    }

    function kategoriwilayah() {

    var kategoriwilayah = $("#kategoriwilayah").val();
    $.ajax({
        type: 'GET',
        url: 'get_kategoriwilayah.php?id=' + kategoriwilayah,
        success: function(res) {
            console.log(kategoriwilayah);
            if (kategoriwilayah == 0) {
                window.location.href = "produk.php";
            }
            console.log(res);
            $('#row').html(res);
        }
    });
    }

    function cari() {
    var cari = $("#cari").val();
    var kategori = $("#kategori").val();
    $.ajax({
      type: 'GET',
      url: 'get_cari.php?id=' + kategori + '&cari=' + cari,
      success: function(res) {
        console.log(res);
        $('#row').html(res);
      }
    });
  }
</script>