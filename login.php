<?php
    session_start();
    include("sambungan.php");

    // create urusetia table
    try {
        $sql = "SELECT * FROM urusetia";
        $result = mysqli_query($sambungan,$sql);
    } catch (exception $e) {
        $sql = <<<HEREDOC
        CREATE TABLE urusetia (
            id INT(10) NOT NULL AUTO_INCREMENT,
            nama_pengguna VARCHAR(30) NOT NULL,
            kata_laluan VARCHAR(15) NOT NULL,
            PRIMARY KEY (id)
        )
        HEREDOC;
        $result = mysqli_query($sambungan,$sql);
    }

    unset($_SESSION["login"]);
    if ($_POST) {
        $nama_pengguna = $_POST["nama_pengguna"];
        $kata_laluan = $_POST["kata_laluan"];
    
        // daftar
        if (isset($_POST["daftar"])) {
            $sql = "INSERT INTO urusetia (nama_pengguna,kata_laluan) VALUES ('$nama_pengguna','$kata_laluan')";
            $result = mysqli_query($sambungan,$sql);
        }

        // log in
        $sql = "SELECT * FROM urusetia";
        $result = mysqli_query($sambungan,$sql);
        while ($urusetia = mysqli_fetch_array($result)) {
            if (($nama_pengguna == $urusetia["nama_pengguna"]) and ($kata_laluan == $urusetia["kata_laluan"])){
                $_SESSION["login"] = true;
                $_SESSION["urusetia"]["nama_pengguna"] = $nama_pengguna;
                $_SESSION["urusetia"]["kata_laluan"] = $kata_laluan;
                $_SESSION["urusetia"]["id"] = $urusetia["id"];

                $_POST = NULL;
                header("Location:./info.php");
                die();
            }
        }
        $_SESSION["login"] = false;
        $_POST = NULL;
    }
?>

<!DOCTYPE html>
<html>
<?php include("head.php") ?>
<body>
    <header>
        <?php include("navbar_1.php") ?>
    </header>
    <div class="center centered-content" style="width:60%;margin:auto;">
        <h2>Login</h2>
        <?php
            if (isset($_SESSION["login"]) and $_SESSION["login"] == false) {
                echo "<div class='alert alert-danger'>Tidak berjaya log masuk.</div>";
            }
        ?>
        <form action="login.php" method="post">
            <table class="table table-bordered" >
                <tr>
                    <td>Nama Pengguna</td>
                    <td><input style="width:80%" class="text-center" type="text" name="nama_pengguna" autocomplete="off" placeholder="max 30 characters" required></td>
                </tr>
                <tr>
                    <td>Kata Laluan</td>
                    <td><input style="width:80%" class="text-center" type="password" name="kata_laluan" autocomplete="off" placeholder="max 15 characters" required></td>
                </tr>
            </table>
            <input style="margin-top:2%;" type="submit" name="daftar" value="Daftar">
            <input style="margin-top:2%;" type="submit" name="log_masuk" value="Log Masuk">
        </form>
    </div>
</body>
</html>


