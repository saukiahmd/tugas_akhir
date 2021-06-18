<?php

require '../../koneksi.php';


	$koneksi->query("DELETE FROM kategoriwilayah WHERE id_kategoriwilayah='$_GET[id]'");

	echo "<script>alert('kategori terhapus');</script>";
	echo "<script>location='kategoriwilayah.php';</script>";

?>