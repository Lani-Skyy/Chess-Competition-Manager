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
    </header>
    <div class="center centered-content">
        <h2>Urusetia</h2>
        <form action="urusetia.php" method="post">
            <table class="table table-bordered" style="width:70%;margin:auto;">
                <tr>
                    <td style="width:10%;color: var(--ltext);background-color: var(--dark2);">Id</td>
                    <td style="color: var(--ltext);background-color: var(--dark2);">Nama Pengguna</td>
                    <td style="color: var(--ltext);background-color: var(--dark2);">Kata Laluan</td>
                </tr>
                <tr>
                     <td>
                        <?php
                            echo "$id";
                        ?>
                    </td>
                    <td>
                        <?php
                            echo "$nama_pengguna";
                        ?>
                    </td>
                    <td>
                        <?php
                            echo "$kata_laluan";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input style="width:100%" class="text-center" type="text" name="nama_pengguna" autocomplete="off" placeholder="max 30 characters"></td>
                    <td><input style="width:100%" class="text-center" type="password" name="kata_laluan" autocomplete="off" placeholder="max 15 characters"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="update_nama_pengguna" value="update"></td>
                    <td><input type="submit" name="update_kata_laluan" value="update"></td>
                </tr>
            </table>
            <input style="margin-top:1%;" type="submit" name="delete" value="delete">
        </form>
    </div>
</body>
</html>