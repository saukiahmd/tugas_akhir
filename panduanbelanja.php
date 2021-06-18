<?php
require 'navbar.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>UMKM</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-4 ">
<div class="ml-auto">

  <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item active mr-5">
        <a class="nav-link text-white" href="panduanbelanja.php">Cara Belanja <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mr-5">
        <a class="nav-link text-white" href="panduanbayar.php">Cara Bayar</a>
      </li>
      <li class="nav-item mr-5">
        <a class="nav-link text-white" href="panduanbertanya.php">Cara Bertanya</a>
      </li>
    </ul>
  </div>
  </div>
       
</nav>

<div class="container">
<div class="row">
<div class="card col mr-4" style="width: 18rem; margin-top: 100px; ">
    <h5 class="card-title text-center mt-4">Pembeli</h5>
  <div class="card-body">
  <img class="card-img-top" src="assets/img/rawon.jpeg" alt="Card image cap">
  </div>
</div>

<div class="col">
<div class="row">
 <h5 class="mt-5 pt-5">
 Pilih menu dan lakukan pemesanan ke penjual dengan Wa
 </h5>
 <div class="mt-4">
 <p class="ml-4">
   ------------------------------------------------
 <i class="arrow right "></i>
 </p>

 <p class="ml-4">
   <i class="arrow left "></i>
   ------------------------------------------------
 </p>
 <h5 class="mt-5 text-right">
 Penjual akan menjawab dan mengirimkan  WA  ke pembeli untuk melakukan pembayaran
 </h5>
 </div>
 </div>
</div>

<div class="card col ml-4" style="width: 18rem; margin-top: 100px;   ">
    <h5 class="card-title text-center mt-4">Penjual</h5>
  <div class="card-body">
  <img class="card-img-top" src="assets/img/rawon.jpeg" alt="Card image cap">
  </div>
</div>
</div>
</div>


</body>
</html>

<style>
.arrow {
  border: solid black;
  border-width: 0 3px 3px 0;
  display: inline-block;
  padding: 3px;
}

.right {
  transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
}

.left {
  transform: rotate(135deg);
  -webkit-transform: rotate(135deg);
}

</style>