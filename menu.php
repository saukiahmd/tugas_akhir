<?php
require 'navbar.php';
require 'koneksi.php';
require 'CosineSimiliarity.php';






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
  <link href="fontawesome/css/all.css" rel="stylesheet">
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
      <h2>Pilihan Produk</h2>
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


                <!-- rating -->
                <?php
                //TOTAL DATA PENJUMLAHAN RATING
                $rating = mysqli_query($koneksi, "SELECT SUM(nilai_rating) AS nilai FROM rating WHERE id_produk = '$d[id_produk]' ");

                //DATA JUMLAH YANG MEMBERIKAN NILAI
                $count = mysqli_query($koneksi, "SELECT count(nilai_rating) AS nilai FROM rating WHERE id_produk = '$d[id_produk]' ");

                $r = mysqli_fetch_assoc($rating);
                $c = mysqli_fetch_assoc($count);
                if ($c['nilai'] == 0) {
                  $result = 0;
                } else {

                  $result = $r['nilai'] / $c['nilai'];
                  $result = number_format((float)$r['nilai'] / $c['nilai'], 1, '.', '');
                }

                ?>
                <div class="form-group text-center mt-3 mb-1">
                  <div class="container d-flex justify-content-center mt-200">
                    <div class="row">
                      <div class="col-md-12">

                        <?php

                        for ($x = 1; $x <= 5; $x++) {
                          if ($result >= $x) {

                            echo '<i class="fas fa-star text-warning"></i>';
                          } else {
                            echo '<i class="far fa-star text-warning"></i>';
                          }
                        }

                        echo $result;

                        echo '</br>';

                        echo ' Dari (' . $c['nilai'] . ') User';
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- rating -->


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


              
      <!-- rekomendasi page -->

      <div id="row">
        <h2>Rekomendasi Untuk Kamu</h2>
        <div class="row">
          <?php

          $result = mysqli_query($koneksi, "SELECT * FROM produk");

          $query = $result;

          if(!isset($_SESSION["pembeli"]))
          {
          }else{
             
            $hasilRating = mysqli_query($koneksi, "with norms as (
              select id_pembeli,
                  sum(nilai_rating * nilai_rating) as w2
              from rating
              group by id_pembeli
          )
          select 
              x.id_pembeli as ego,y.id_pembeli as v,nx.w2 as x2, ny.w2 as y2,
              sum(x.nilai_rating * y.nilai_rating) as innerproduct,
              sum(x.nilai_rating * y.nilai_rating) / sqrt(nx.w2 * ny.w2) as cosinesimilarity
          from rating as x
          join rating as y
              on (x.id_produk=y.id_produk)
          join norms as nx
              on (nx.id_pembeli=x.id_pembeli)
          join norms as ny
              on (ny.id_pembeli=y.id_pembeli)
          where x.id_pembeli < y.id_pembeli
          group by 1,2,3,4
          order by 6 desc");

            // var_dump($hasilRating->fetch_array());
            
            while ($ratings = $hasilRating->fetch_array()){
              if ($ratings['ego'] == $_SESSION['id_pembeli']|| $ratings['v'] == $_SESSION['id_pembeli'] ) {
                if ($ratings['cosinesimilarity'] >= 0.5 ){
                  $queryrating = mysqli_query($koneksi, "SELECT * FROM rating WHERE '$ratings[ego]'=rating.id_pembeli AND '$ratings[v]'=rating.id_pembeli")->fetch_array();
                  var_dump($queryrating);
                  // if ($ratings['v'] || $ratings['ego']) {
                  //   // echo $queryrating;
                  // }
                  // echo '('.$ratings['ego'].')','('.$ratings['v'].')','('.$ratings['innerproduct'].')','('.$ratings['cosinesimilarity'].')<br>';
                 
                  // echo $queryrating;
                  // while($qr = mysqli_fetch_assoc($queryrating)){
                    
                    
                      
     
          
                  //   }
                  
                  }
                }
              }
            }

          
          
          
          

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


                <!-- rating -->
                <?php
                //TOTAL DATA PENJUMLAHAN RATING
                $rating = mysqli_query($koneksi, "SELECT SUM(nilai_rating) AS nilai FROM rating WHERE id_produk = '$d[id_produk]' ");

                //DATA JUMLAH YANG MEMBERIKAN NILAI
                $count = mysqli_query($koneksi, "SELECT count(nilai_rating) AS nilai FROM rating WHERE id_produk = '$d[id_produk]' ");

                $r = mysqli_fetch_assoc($rating);
                $c = mysqli_fetch_assoc($count);
                if ($c['nilai'] == 0) {
                  $result = 0;
                } else {

                  $result = $r['nilai'] / $c['nilai'];
                  $result = number_format((float)$r['nilai'] / $c['nilai'], 1, '.', '');
                }

                ?>
                <div class="form-group text-center mt-3 mb-1">
                  <div class="container d-flex justify-content-center mt-200">
                    <div class="row">
                      <div class="col-md-12">

                        <?php

                        for ($x = 1; $x <= 5; $x++) {
                          if ($result >= $x) {

                            echo '<i class="fas fa-star text-warning"></i>';
                          } else {
                            echo '<i class="far fa-star text-warning"></i>';
                          }
                        }

                        echo $result;

                        echo '</br>';

                        echo ' Dari (' . $c['nilai'] . ') User';
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- rating -->


                <div class="team-text">
                  <h2 id="nama" style="font-size: 20px;"><?php echo $d['nama_produk']; ?></h2>
                  <p id="harga">Rp. <?php echo number_format($d['harga_produk']); ?></p>
                  <a href="beli.php?id=<?php echo $d['id_produk']; ?>" class="btn btn-warning mt-3">Beli</a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>


      </div>

      <!-- akhir rekomendasi page -->




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

  .filter {
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