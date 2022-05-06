<?php
    session_start();
    if ($_SESSION["login"] == false)
        header("Location:./login.php");
    include("sambungan.php");

    // Get all data
    $nama_pengguna = $_SESSION["urusetia"]["nama_pengguna"];
    $kata_laluan = $_SESSION["urusetia"]["kata_laluan"];
    $id = $_SESSION["urusetia"]["id"];

    if ($_POST) {
        // Update
        if (array_search('update', $_POST)) {
            $mode = array_search('update', $_POST);
            $mode = substr($mode, 7, );
            $string = $_POST["$mode"];

            // Error Checking
            if ($string == "") {
                $_POST = array();
                die("Tolong berikan $mode.");
            }

            $sql = "UPDATE urusetia SET $mode = '$string' WHERE id = $id";
            $result = mysqli_query($sambungan,$sql);
            if ($result) {
                $_SESSION["urusetia"]["$mode"] = $string;

                $_POST = array();
                header("Location:./urusetia.php");
                die();
            }
        }

        // Delete
        if (array_search('delete', $_POST)) {
            $sql = "DELETE FROM urusetia WHERE id = $id";
            $result = mysqli_query($sambungan,$sql);
            if ($result) {
                $_POST = array();
                header("Location:./login.php");
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
        <h2>Urusetia</h2>
    </header>
    <div>
        <form action="urusetia.php" method="post">
            <table>
                <tr>
                    <td>Id</td>
                    <td>
                        <?php
                            echo "$id";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Nama Pengguna</td>
                    <td>
                        <?php
                            echo "$nama_pengguna";
                        ?>
                    </td>
                    <td><input type="text" name="nama_pengguna" autocomplete="off" placeholder="max 30 characters"></td>
                    <td><input type="submit" name="update_nama_pengguna" value="update"></td>
                </tr>
                <tr>
                    <td>Kata Laluan</td>
                    <td>
                        <?php
                            echo "$kata_laluan";
                        ?>
                    </td>
                    <td><input type="password" name="kata_laluan" autocomplete="off" placeholder="max 15 characters"></td>
                    <td><input type="submit" name="update_kata_laluan" value="update"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="delete" value="delete"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>