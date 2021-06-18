<?php

require '../../koneksi.php';


	$koneksi->query("DELETE FROM checkout WHERE id_checkout='$_GET[id]'");

	echo "<script>alert('data pembelian terhapus');</script>";
	echo "<script>location='pembelian.php';</script>";

?>