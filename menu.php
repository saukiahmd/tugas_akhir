<?php
require 'navbar.php';
require 'koneksi.php';
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
  
  <!-- css bintang -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">


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
  <div class="team" id="team">
    <div class="container">

      <div class="row">

        <div class="col-3">

          <div class="input-group w-100 mb-5">
            <input type="text" class="form-control" name="cari" aria-describedby="basic-addon3" id="cari" onkeyup="cari()">
          </div>
        </div>

        <div class="col-3">
          <select name="kategori" id="kategori" class="form-control btn btn-warning filter" onchange="kategori()">
            <option value="0">Pilih Kategori Makanan</option>
            <?php
            $category = mysqli_query($koneksi, "select * from kategori") or die(mysqli_error);
            while ($data = $category->fetch_assoc()) { ?>
              <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
            <?php } ?>
            <option value="0">Pilih Semua</option>
          </select>
        </div>
        
        <div class="col-3">
          <select name="kategoriwilayah" id="kategoriwilayah" class="form-control btn btn-warning filter" onchange="kategoriwilayah()">
            <option value="0">Pilih Kategori wilayah</option>
            <?php
            $category1 = mysqli_query($koneksi, "select * from kategoriwilayah") or die(mysqli_error);
            while ($data = $category1->fetch_assoc()) { ?>
              <option value="<?php echo $data['id_kategoriwilayah']; ?>"><?php echo $data['nama_kategoriwilayah']; ?></option>
            <?php } ?>
            <option value="0">Pilih Semua</option>
          </select>
        </div>
        
        <div class="col-3">
          <select name="kategori" id="kategori" class="form-control btn btn-warning filter" onchange="kategori()">
            <option value="0">Harga Tertinggi</option>
            <?php
            $category = mysqli_query($koneksi, "select * from kategori") or die(mysqli_error);
            while ($data = $category->fetch_assoc()) { ?>
              <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
            <?php } ?>
            <option value="0">Pilih Semua</option>
          </select>
        </div>
            
      </div>



      <div id="row">
        
      <div class="row">
        <?php
        $halaman = 8;
        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
        $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
        $result = mysqli_query($koneksi, "SELECT * FROM produk");
        $total = mysqli_num_rows($result);
        $pages = ceil($total / $halaman);
        $query = mysqli_query($koneksi, "select * from produk LIMIT $mulai, $halaman") or die(mysqli_error);
        $no = $mulai + 1;


        $no = 1;
        while ($d = mysqli_fetch_array($query)) {
        ?>
        
          <div id="konten" class="col-lg-3 col-md-6 ">
          
            <div class="team-item" style="width: 100%;">
              <div class="team-img" style="height: 200px">
                <a id="id" href="tampildetail.php?id=<?php echo $d['id_produk']; ?>">
                  <img id="foto" src="foto_produk/<?php echo $d['foto_produk']; ?>">
                </a>
              </div>
              <div class="team-text">
                <h2 id="nama" style="font-size: 20px;"><?php echo $d['nama_produk']; ?></h2>
                <p id="harga">Rp. <?php echo number_format($d['harga_produk']); ?></p>
                <a href="beli.php?id=<?php echo $d['id_produk']; ?>" class="btn btn-warning mt-3">Beli</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>

      <nav aria-label="..." style="" class="d-flex justify-content-center">
        <ul class="pagination text-warning">
          <?php for ($i = 1; $i <= $pages; $i++) { ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php } ?>
        </ul>
      </nav>
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


    <!-- script bintang -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

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


  /* Dropdown Button */
  .dropbtn {
    background-color: #3498DB;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }

  /* Dropdown button on hover & focus */
  .dropbtn:hover,
  .dropbtn:focus {
    background-color: #2980B9;
  }

  /* The container <div> - needed to position the dropdown content */
  .dropdown {
    position: relative;
    display: inline-block;
  }

  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  /* Links inside the dropdown */
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {
    background-color: #ddd
  }

  /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
  .show {
    display: block;
  }

  .filter{
    width: 210px;
    margin-left: 45px;
  }

 
</style>

<script>
  /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }

  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }



  function kategori() {
    var kategori = $("#kategori").val();
    $.ajax({
      type: 'GET',
      url: 'get_kategori.php?id=' + kategori,
      success: function(res) {
        if (kategori == 0) {
          window.location.href = "menu.php";
        }
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
        if (kategoriwilayah == 0) {
          window.location.href = "menu.php";
        }
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