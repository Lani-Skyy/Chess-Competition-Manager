<?php
    session_start();
    $_SESSION["page"] = "info.php";
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
        <h2>Info</h2>
    </header>
</body>
</html>