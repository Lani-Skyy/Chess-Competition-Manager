<?php
    session_start();
    if ($_SESSION["login"] == false)
        header("Location:./login.php");;
    include("sambungan.php");
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
        <h2>Keputusan</h2>
    </header>
</body>
</html>