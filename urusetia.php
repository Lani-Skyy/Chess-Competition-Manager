<?php
    session_start();
    if ($_SESSION["login"] == false)
        header("Location:./login.php");
    include("sambungan.php");
    include("functions.php");

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
            $readable = str_replace("_"," ","$mode");

            // Error Checking
            if ($string == "") {
                $_SESSION["alert"]["message"] = "Tolong berikan $readable.";
                $_SESSION["alert"]["type"] = "warning";
            } else {
                $sql = "UPDATE urusetia SET $mode = '$string' WHERE id = $id";
                $result = mysqli_query($sambungan,$sql);
                if ($result) {
                    $_SESSION["urusetia"]["$mode"] = $string;
                    
                    $_SESSION["alert"]["message"] = "Berjaya update $readable.";
                    $_SESSION["alert"]["type"] = "success";
                    $_POST = NULL;
                    header("Location:./urusetia.php");
                    die();
                }
            }
        }

        // Delete
        if (array_search('delete', $_POST)) {
            $sql = "DELETE FROM urusetia WHERE id = $id";
            $result = mysqli_query($sambungan,$sql);
            if ($result) {
                $_SESSION["alert"]["message"] = "Berjaya delete urusetia.";
                $_SESSION["alert"]["type"] = "success";
                $_POST = NULL;
                header("Location:./login.php");
                die();
            }
        }

        $_POST = NULL;
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
    <div class="center centered-content" style="width:70%;margin:auto;">
        <h2>Urusetia</h2>
        <?php alert(); ?>
        <form action="urusetia.php" method="post">
            <table class="table table-bordered">
                <tr>
                    <td style="width:10%;color: var(--ltext);background-color: var(--dark2);">Id</td>
                    <td style="color: var(--ltext);background-color: var(--dark2);">Nama Pengguna</td>
                    <td style="color: var(--ltext);background-color: var(--dark2);">Kata Laluan</td>
                </tr>
                <tr>
                    <td><?php echo "$id";?></td>
                    <td><?php echo "$nama_pengguna";?></td>
                    <td><?php echo "$kata_laluan";?></td>
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
            <input style="margin-top:0.5%;" type="submit" name="delete" value="delete">
        </form>
    </div>
</body>
</html>