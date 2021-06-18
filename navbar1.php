<html>
<head>
    <title>Tutorial Validasi Input Hanya Huruf dan Angka di PHP</title>
</head>
<body>
    <h3>Form Input Data</h3>
    <form method="POST">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Submit">
                    <input type="reset" name="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <hr />
    <h3>Hasil :</h3>
    <?php
        if(isset($_POST['submit'])){
            $nama = $_POST['username'];
            
            // validasi input data
            if(!preg_match("/^[a-zA-Z0-9]*$/", $nama)){
                echo "Input hanya huruf dan angka yang diijinkan, dan tidak boleh menggunakan spasi ...!<br>";
            }
        
            // jika validasi input hanya huruf dan angka terpenuhi
            else if(!empty($_POST['username'])){
                //Tulis query disini
                echo "Good! input data telah diisi dengan benar ...<br>";
            }    
        }    
    ?>
</body>
</html>