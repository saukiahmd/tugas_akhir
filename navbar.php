<?php 
session_start();
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">UMKM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto mr-5">
        
        <li class="nav-item">
          <a class="nav-link text-dark" href="menu.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="keranjang.php">Keranjang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="about.php">About</a>
        </li>
            <?php if(isset($_SESSION["pembeli"])): ?>
              <li class="nav-item dropdown mr-5">
            <a class="nav-link dropdown-toggle text-dark" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>
            </a>
            
              <div class="dropdown-menu" style="padding: 15px; padding-bottom: 10px;">
                <form class="form-horizontal" method="post" accept-charset="UTF-8">
                    <div class="card">
                      <div class="card-body">
                        <p class="">Halo <?php echo $_SESSION['username']; ?></p>
                        <a href="">Ubah Profile</a></br>
                        <a href="checkout.php"> Checkout</a>
                      </div>
                    </div>
                        <a href="logout.php">Logout</a><br>
                </form>
              </div>
        </li>
            <?php else: ?>
        <li class="nav-item dropdown mr-5">
            <a class="nav-link dropdown-toggle text-dark" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>
            </a>
            
              <div class="dropdown-menu" style="padding: 15px; padding-bottom: 10px;">
                <form class="form-horizontal" method="post" accept-charset="UTF-8">
                    <input class="form-control login" type="text" name="username" placeholder="Username.."><br>
                    <input class="form-control login" type="password" name="password" placeholder="Password..">
                    <a href="admin/dist/login.php">Login sebagai Penjual</a><br>
                    <input class="btn btn-warning mt-3 mb-2" type="submit" name="login" value="Login">
                    <a href="daftar.php" class="btn btn-warning mt-3 mb-2">Daftar</a><br>
                </form>
              </div>
        </li>
              <?php endif ?>
      </ul>
    </div>
  </nav>


<?php 
  if (isset($_POST["login"]))
  {
    $ambil = $koneksi->query("SELECT * FROM pembeli WHERE nama_pembeli='$_POST[username]' AND password_pembeli='$_POST[password]'");
    $yangcocok = $ambil->num_rows;

    if($yangcocok > 0)
    {
      $akun = $ambil->fetch_assoc();
      $_SESSION["pembeli"] = $akun;
      $_SESSION["login"] = true;
      $_SESSION["username"] = $_POST['username'];
      echo "<script>alert('anda sukses login');</script>";
		  echo "<script>location='menu.php';</script>";
    }
    else
    {
      echo "<script>alert('anda gagal login,periksa akun anda');</script>";
		  echo "<script>location='menu.php';</script>";
    }
  }

?>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <!-- Always remember to call the above files first before calling the bootstrap.min.js file -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>

<style>
.login {
    margin-bottom:5px;
}
.dropdown-menu {
    width: 240px !important;
}
</style>