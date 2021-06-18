<?php

require '../../koneksi.php';

	$fotoproduk = $pecah['foto_produk'];
	if (file_exists("../../foto_produk/$fotoproduk"))
	{
		unlink("../../foto_produk/$fotoproduk");
	}

	$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

	echo "<script>alert('produk terhapus');</script>";
	echo "<script>location='produk.php';</script>";

?>