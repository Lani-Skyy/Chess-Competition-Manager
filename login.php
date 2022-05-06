<?php
    session_start();
    include("sambungan.php");
    $_SESSION["login"] = false;

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

                $_POST = array();
                header("Location:./info.php");
                die();
            }
        }
        $_POST = array();
        die("Tidak berjaya");
    }
?>

<!DOCTYPE html>
<html>
<?php include("head.php") ?>
<body>
    <header>
        <?php include("navbar_1.php") ?>
    </header>
    <div>
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td>Nama Pengguna</td>
                    <td><input type="text" name="nama_pengguna" autocomplete="off" placeholder="max 30 characters" required></td>
                </tr>
                <tr>
                    <td>Kata Laluan</td>
                    <td><input type="password" name="kata_laluan" autocomplete="off" placeholder="max 15 characters" required></td>
                </tr>
            </table>
            <input type="submit" name="daftar" value="Daftar">
            <input type="submit" name="log_masuk" value="Log Masuk">
        </form>
    </div>
</body>
</html>


