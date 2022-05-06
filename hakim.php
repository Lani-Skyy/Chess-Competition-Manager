<?php 
    session_start();
    if ($_SESSION["login"] == false)
        header("Location:./login.php");
    include("sambungan.php");

    // create hakim table
    try {
        $sql = "SELECT * FROM hakim";
        $result = mysqli_query($sambungan,$sql);
    } catch (exception $e) {
        $sql = <<<HEREDOC
        CREATE TABLE hakim (
            id INT(10) NOT NULL AUTO_INCREMENT,
            nama VARCHAR(30) NOT NULL,
            PRIMARY KEY (id)
        )
        HEREDOC;
        $result = mysqli_query($sambungan,$sql);
    }

    // Get all hakim
    $hakim = [];
    $sql = "SELECT * FROM hakim";
    $result = mysqli_query($sambungan,$sql);
    if ($result) {
        while ($array = mysqli_fetch_array($result)) {
            $hakim[] = [
            "id" => $array["id"],
            "nama" => $array["nama"]
            ];
        }
    }

    // Check user input
    if ($_POST) {
        // Create
        if (array_search('create', $_POST)) {
            // Error Checking
            if ($_POST['insert'] == "") {
                $_POST = array();
                die("Tolong isikan nama hakim.");
            }

            $string = $_POST['insert'];
            $sql = "INSERT INTO hakim (nama) VALUES ('$string')";
            $result = mysqli_query($sambungan,$sql);
            if ($result) {
                $_POST = array();
                header("Location:./hakim.php");
                die();
            }
        }
        // Reset
        if (array_search('reset', $_POST)) {
            $sql = "DELETE FROM hakim";
            $result = mysqli_query($sambungan,$sql);
            if ($result) {
                $_POST = array();
                header("Location:./hakim.php");
                die();
            }
        }
        // Update
        if (array_search('update', $_POST)) {
            // Error Checking
            if ($_POST['insert'] == "") {
                $_POST = array();
                die("Tolong isikan nama hakim.");
            }

            $new_nama = $_POST['insert'];
            $index = substr(array_search('update', $_POST), 7, );
            $hakim_id = $hakim[$index]["id"];
            $sql = "UPDATE hakim SET nama = '$new_nama' WHERE id = $hakim_id";
            $result = mysqli_query($sambungan,$sql);
            if ($result) {
                $_POST = array();
                header("Location:./hakim.php");
                die();
            }
        }
        // Delete
        if (array_search('delete', $_POST)) {
            $index = substr(array_search('delete', $_POST), 7, );
            $hakim_id = $hakim[$index]["id"];
            $sql = "DELETE FROM hakim WHERE id = $hakim_id";
            $result = mysqli_query($sambungan,$sql);
            if ($result) {
                $_POST = array();
                header("Location:./hakim.php");
                die();
            }
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
    </header>
    <div class="center">
        <h2>Hakim</h2>
        <form action="hakim.php" method="post">
            <table class="table table-bordered" style="width:70%;margin:auto;">
                <thead>
                    <tr>
                        <td>
                            <input style="width:80%" class="text-center" type="text" name="insert" autocomplete="off" placeholder="taip sini" style="width:60%">
                        </td>
                        <td>
                            <input type="submit" name="create" value="create">
                        </td>
                        <td>
                            <input type="submit" name="reset" value="reset">
                        </td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    for ($i=0; $i < sizeof($hakim); $i++) {
                        $string1 = $hakim[$i]["nama"];
                        $string2 = <<<HEREDOC
                        <tr>
                            <td>$string1</td>
                            <td><input type="submit" name="update_$i" value="update"></td>
                            <td><input type="submit" name="delete_$i" value="delete"></td>
                        </tr>
                        HEREDOC;
                        echo $string2;
                    }
                ?>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>