<?php
include '../../koneksi.php';

$id = $_GET['id'];
$cari = $_GET['cari'];


echo '<table class="table table-bordered">';
echo '<thead>';
echo '<tr>';
echo '<td>No</td>';
echo '<td>Nama</td>';
echo '<td>Harga</td>';
echo '<td>Foto</td>';
echo '<td>Deskripsi</td>';
echo '<td>Aksi</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
$halaman = 10;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori='$_GET[id]'");
$total = mysqli_num_rows($result);
$pages = ceil($total/$halaman);            
if ($_GET['id'] != 0 ) {
    $query=mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori=$id AND nama_produk like '%".$cari."%' LIMIT $mulai, $halaman")or die(mysqli_error);	
    
}else {
    $query=mysqli_query($koneksi, "SELECT * FROM produk WHERE nama_produk like '%".$cari."%' LIMIT $mulai, $halaman")or die(mysqli_error);	
}
$nomor=1;
$count = mysqli_num_rows($query);
if ($count == null) {
    echo '<div id="konten" class="col-lg-6 col-md-6">';
    echo '<h5>Data yang anda cari kosong<h5>';
    echo '</div>';
}
while ($d = mysqli_fetch_array($query)){
    echo '<tr>';
    echo '<td>'.$nomor++.'</td>';
    echo '<td>'.$d['nama_produk'].'</td>';
    echo '<td>'.$d['harga_produk'].'</td>';
    echo '<td><img src="../../foto_produk/'.$d['foto_produk'].'" width="100"></td>';
    echo '<td>'.$d['deskripsi_produk'].'</td>';
    echo '<td class="d-flex justify-content-between">';
    echo '<a href="ubahproduk.php?id='.$d['id_produk'].'" class="btn btn-warning" >Ubah</a>';
    echo '</div>';
    echo '<a href="hapusproduk.php?id='.$d['id_produk'].'" class="btn-danger btn"  >Hapus</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '<div class="row d-flex justify-content-between ml-1 mr-1">';
echo '<div>';
echo '<nav aria-label="...">';
echo '<ul class="pagination">';
for ($i=1; $i<=$pages ; $i++)
{
echo '<li class="page-item"><a class="page-link" href="?halaman='.$i.'">'.$i.'</a></li>';
}
echo '</ul>';
echo '</nav>';
echo '</div>';
echo '<div>';
echo '<button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>';
echo '</div>';
echo '</div>';
?>