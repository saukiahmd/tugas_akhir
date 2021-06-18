
<?php
include 'koneksi.php';


// echo '<div class="container">';
// echo '<div class="row">';
// echo '<div class="col-9">';
// echo '<div class="input-group w-50 mb-5">';
// echo '<input type="text" class="form-control" id="cari" name="cari" aria-describedby="basic-addon3" onkeyup=cari()>';
// echo '</div>';
// echo '</div>';
// echo '<div class="col-3">';
// echo '<select name="kategori" id="kategori" class="form-control btn btn-warning" onchange="kategori()">';
// echo '<option value="">Pilih Kategori</option>';
// $category = mysqli_query($koneksi, "select * from kategori")or die(mysqli_error);
// while($data = $category->fetch_assoc()){
//     echo '<option value="'.$data['id_kategori'].'">'.$data['nama_kategori'].'</option>';
// }
// echo '<option value="0">Pilih Semua</option>';
// echo '</select>';
// echo '</div>';
// echo '</div>';
// echo '<div class="row">';
$halaman = 8;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori='$_GET[id]'");
$total = mysqli_num_rows($result);
$pages = ceil($total/$halaman);            
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori='$_GET[id]' LIMIT $mulai, $halaman")or die(mysqli_error);

$no =$mulai+1;

    // $bebas=$koneksi->query("SELECT * FROM produk WHERE id_kategori='$_GET[id]'");

    // $data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori=$id AND nama_produk like $cari");				


    echo '<div class="row">';
$no = 1;
while($d = mysqli_fetch_array($query))
{
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
// echo '</div>';

?>
