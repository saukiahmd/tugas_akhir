<?php

require '../../koneksi.php';


	$koneksi->query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");

	echo "<script>alert('kategori terhapus');</script>";
	echo "<script>location='kategori.php';</script>";

?>