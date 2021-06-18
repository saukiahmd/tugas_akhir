<?php
  session_start();

  if(isset($_SESSION["admin"])){
    header("location: index.php");
    exit;
  }
require("../../koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputNama">Nama</label>
                                                <input class="form-control py-4" id="inputNama" type="name" name="username" placeholder="Masukan Nama" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Masukan password" />
                                            </div>
                                            <div class="form-group">
                                            
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a href="../../menu.php" class="btn btn-primary ml-0 mr-4 w-25">Kembali</a>
                                                <button class="btn btn-primary mr-auto w-25" name="login" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>


        <?php 
        
        
        
        if(isset($_POST['login']))
        {
            if(!preg_match("/^[a-zA-Z0-9]*$/", $_POST['username'])){
                echo "<script>alert('Login Gagal')</script>";
                echo "<meta http-equiv='refresh' content='1;url=login.php'>";
            }else{
            $ambil=$koneksi->query("SELECT * FROM admin WHERE nama_admin='$_POST[username]' AND password_admin ='$_POST[password]'");
            $yangcocok = $ambil->num_rows;
            if($yangcocok > 0){

                    $akun = $ambil->fetch_assoc();
                    $_SESSION["admin"] = $akun;
                    $_SESSION["login"] = true;
                    
                    
                    echo "<div class='alert alert-info'>Login Sukses</div>";
                    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                  }
                  else
                  {
                    echo "<div class='alert alert-danger'>Login Gagal</div>";
                    echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                  }
        }
    }

        ?>


    </body>
</html>