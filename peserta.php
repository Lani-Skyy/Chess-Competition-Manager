<?php
    session_start();
    if ($_SESSION["login"] == false)
        header("Location:./login.php");
    include("sambungan.php");

    // Create peserta table
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

    // Check user input
    if ($_POST) {
        // Reset
        if (isset($_POST["reset"])) {
            $sql = "DELETE FROM peserta";
            $result = mysqli_query($sambungan,$sql);
            try {
                $sql = "DROP TABLE matches";
                $result = mysqli_query($sambungan,$sql);
            } catch (Exception $e) {}
            try {
                $sql = "DROP TABLE scores";
                $result = mysqli_query($sambungan,$sql);
            } catch (Exception $e) {}
            $_POST = NULL;
            header("Location:./peserta.php");
            die();
        }

        // Add Peserta 
        if (isset($_POST["submit"])) {
            $not_allowed = [""," ","NULL"];
            // Error Checking
            if (in_array($_POST['peserta'],$not_allowed))
                $error = true;

            // Conversion of input string to arrays of peserta
            $string = $_POST["peserta"];
            $string = trim($string);
            $crlf = chr(13).chr(10);
            $string = explode("$crlf",$string);

            for ($i=0; $i<sizeof($string); $i++) {
                $error = false;
                $string1 = $string[$i];
                // Error Checking
                if (!isset(explode(",",$string1)[0]) or !isset(explode(",",$string1)[1]))
                    $error = true;
                else if ($error == false) {
                    $no_kp = trim(explode(",",$string1)[0]);
                    $nama = trim(explode(",",$string1)[1]);
    
                    // Error Checking
                    if (in_array($no_kp,$not_allowed) or in_array($nama,$not_allowed))
                        $error = true;
                    
                    if ($error == false) {
                        // Insert peserta 
                        $sql = "INSERT INTO peserta (no_kp,nama) VALUES ('$no_kp','$nama')";
                        $result = mysqli_query($sambungan,$sql);
                        $inserted = true;
                    }
                }
            }
        }

        // Upload
        if (isset($_POST["upload"])) {
            $name = $_FILES['file']['name'];
            $type = $_FILES['file']['type'];
            $size = $_FILES['file']['size'];
            $tmp = $_FILES['file']['tmp_name'];

            // Allow certain file formats
            if($type != "text/csv") {
                echo "Hanya .csv diterima.";
            }

            else if (move_uploaded_file($tmp, $name)) {
                echo "The file has been uploaded.";
            }
        }

        $_POST = NULL;
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
    if (isset($inserted)) {
        header("Location:./peserta.php");
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
    </header>
    <div class="center" style="width:50%;margin:auto;">
        <h2>Peserta</h2>
        <div>
            <form action="peserta.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file">
                <input type="submit" name="upload" value="upload">
            </form>
        </div>
        <form action="peserta.php" method="post">
            <table class="table table-bordered">
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
                                <textarea autofocus rows = "10" cols = "60" name="peserta" autocomplete="off" placeholder="$format"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" value="submit"></td>
                        </tr>
                        HEREDOC;
                        echo $string;
                    }

                    // if have peserta
                    else {
                        $string = <<<HEREDOC
                        <input type="submit" name="reset" value="reset" style="width: 100%;"></td>
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>No KP</td>
                                <td>Nama</td>
                            </tr>
                        </thead>
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