<?php
    session_start();
    if ($_SESSION["login"] == false)
        header("Location:./login.php");;
    include("sambungan.php");

    // create peserta table
    try {
        $sql = "SELECT * FROM peserta";
        $result = mysqli_query($sambungan,$sql);
    } catch (exception $e) {
        $sql = <<<HEREDOC
        CREATE TABLE peserta (
            id INT(10) NOT NULL AUTO_INCREMENT,
            no_kp VARCHAR(15) NOT NULL,
            nama VARCHAR(30) NOT NULL,
            PRIMARY KEY (id)
        )
        HEREDOC;
        $result = mysqli_query($sambungan,$sql);
    }

    // Get all peserta
    $peserta = [];
    $sql = "SELECT * FROM peserta";
    $result = mysqli_query($sambungan,$sql);
    if ($result) {
        while ($array = mysqli_fetch_array($result)) {
            $peserta[] = [
                "id" => $array["id"],
                "no_kp" => $array["no_kp"],
                "nama" => $array["nama"]
                ];
        }
    }
    
    // Check user input
    if ($_POST) {

        // Reset
        if (isset($_POST["reset"])) {
            $sql = "DELETE FROM peserta";
            $result = mysqli_query($sambungan,$sql);

            try {
                $sql = "DROP TABLE matches";
                $result = mysqli_query($sambungan,$sql);
            } catch (Exception $e) {
            }
            try {
                $sql = "DROP TABLE scores";
                $result = mysqli_query($sambungan,$sql);
            } catch (Exception $e) {
            }

            $_POST = array();
            header("Location:./peserta.php");
            die();
        }

        // Add Peserta
        if (isset($_POST["submit"])) {
            // Error Checking: If no input
            if ($_POST['peserta'] == "") {
                $_POST = array();
                die("Tolong isikan peserta.");
            }

            // Conversion of input string to arrays of peserta
            $string = $_POST["peserta"];
            $string = trim($string);
            $crlf = chr(13).chr(10);
            $string = explode("$crlf",$string);

            // For each peserta
            for ($i=0; $i<sizeof($string); $i++) {
                $string1 = $string[$i];

                // Error Checking: If no no_kp or nama
                if (!isset(explode(",",$string1)[0]) or !isset(explode(",",$string1)[1])) {
                    $_POST = array();
                    die("Tolong isikan kedua-dua no_kp dan nama");
                }

                $no_kp = trim(explode(",",$string1)[0]);
                $nama = trim(explode(",",$string1)[1]);

                // Error Checking: Both no_kp and nama are empty
                if ($no_kp == "" and $nama == "") {
                    $_POST = array();
                    die("Tolong jangan biarkan kedua-dua no_kp dan nama kosong"); // Problem: Loop continues, valid values are inserted into database.
                }
                
                $sql = "INSERT INTO peserta (no_kp,nama) VALUES ('$no_kp','$nama')";
                $result = mysqli_query($sambungan,$sql);

                // Get all peserta
                $peserta = [];
                $sql = "SELECT * FROM peserta";
                $result = mysqli_query($sambungan,$sql);
                if ($result) {
                    while ($array = mysqli_fetch_array($result)) {
                        $peserta[] = [
                            "id" => $array["id"],
                            "no_kp" => $array["no_kp"],
                            "nama" => $array["nama"]
                            ];
                    }
                }
            }

            $_POST = array();
            header("Location:./peserta.php");
            die();
        }
        $_POST = array();
        die();
    }
?>

<!DOCTYPE html>
<html>
<?php include("head.php") ?>
<body>
    <header>
        <?php 
            include("navbar_1.php");
            include("navbar_2.php");
        ?>
        <h2>Peserta</h2>
    </header>
    <div>
        <form action="peserta.php" method="post">
            <table>
                <?php
                    // if no peserta
                    if (sizeof($peserta) == 0) {
                        $format = <<<HEREDOC
                        No KP, Nama
                        No KP, Nama
                        ...
                        HEREDOC;

                        $string = <<<HEREDOC
                        <tr>
                            <td>
                                <textarea rows = "10" cols = "60" name="peserta" autocomplete="off" placeholder="$format" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" value="submit"></td>
                        </tr>
                        HEREDOC;
                        echo $string;
                    }

                    // if got peserta
                    else {
                        $string = <<<HEREDOC
                        <input type="submit" name="reset" value="reset"></td>
                        <tr>
                            <td>Id</td>
                            <td>No KP</td>
                            <td>Nama</td>
                        </tr>
                        HEREDOC;
                        echo $string;

                        for ($i=0; $i < sizeof($peserta); $i++) {
                            $id = $peserta[$i]["id"];
                            $no_kp = $peserta[$i]["no_kp"];
                            $nama = $peserta[$i]["nama"];
                            $string = <<<HEREDOC
                            <tr>
                                <td>$id</td>
                                <td>$no_kp</td>
                                <td>$nama</td>
                            </tr>
                            HEREDOC;
                            echo $string;
                        }
                    }
                ?>
            </table>
        </form>
    </div>
</body>
</html>