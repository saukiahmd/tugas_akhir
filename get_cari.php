<?php 
include 'koneksi.php';

$id = $_GET['id'];
$cari = $_GET['cari'];
// echo $id;


$halaman = 8;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori='$_GET[id]'");
$total = mysqli_num_rows($result);
$pages = ceil($total/$halaman);            
// $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori='$_GET[id]' LIMIT $mulai, $halaman")or die(mysqli_error);
if ($_GET['id'] != 0 ) {
    $query=mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori=$id AND nama_produk like '%".$cari."%' LIMIT $mulai, $halaman")or die(mysqli_error);	
    
}else {
    $query=mysqli_query($koneksi, "SELECT * FROM produk WHERE nama_produk like '%".$cari."%' LIMIT $mulai, $halaman")or die(mysqli_error);	
}

$no =$mulai+1;

echo '<div class="row">';
$no = 1;
$count = mysqli_num_rows($query);
if ($count == null) {
    echo '<div id="konten" class="col-lg-6 col-md-6">';
    echo '<h5>Data yang anda cari kosong<h5>';
    echo '</div>';
}
while ($d = mysqli_fetch_array($query)){
    echo '<div id="konten" class="col-lg-3 col-md-6">';
    echo '<div class="team-item" style="width: 100%">';
    echo '<div class="team-img" style="height: 200px">';
    echo '<a id="id" href="tampildetail.php?id='.$d['id_produk'].'">';
    echo '<img id="foto" src="foto_produk/'.$d['foto_produk'].'">';
    echo '</a>';
    echo '</div>';
    echo '<div class="team-text">';
    echo '<h2 id="nama">'.$d['nama_produk'].'</h2>';
    echo '<p id="harga">RP.'.number_format($d['harga_produk']).'</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '<nav aria-label="..." style="" class="d-flex justify-content-center">';
echo '<ul class="pagination">';
for ($i=1; $i<=$pages ; $i++){ 
echo '<li class="page-item"><a class="page-link" href="?halaman='.$i.'">'.$i.'</a></li>';
}
echo '</ul>';
echo '</nav>';



?>