<?php
    session_start();
    $_SESSION["page"] = "info.php";
    include("sambungan.php");

    // create tables if dont have
    // urusetia
    try {
        $sql = "SELECT * FROM urusetia";
        $result = mysqli_query($sambungan,$sql);
    } catch (exception $e) {
        $sql = <<<HEREDOC
        CREATE TABLE urusetia (
            id INT(10) NOT NULL AUTO_INCREMENT,
            nama_pengguna VARCHAR(30) NOT NULL,
            kata_laluan VARCHAR(15) NOT NULL
        )
        HEREDOC;
        $result = mysqli_query($sambungan,$sql);
    }
    // hakim
    try {
        $sql = "SELECT * FROM hakim";
        $result = mysqli_query($sambungan,$sql);
    } catch (exception $e) {
        $sql = <<<HEREDOC
        CREATE TABLE hakim (
            id INT(10) NOT NULL AUTO_INCREMENT,
            nama VARCHAR(30) NOT NULL
        )
        HEREDOC;
        $result = mysqli_query($sambungan,$sql);
    }
    // peserta
    try {
        $sql = "SELECT * FROM peserta";
        $result = mysqli_query($sambungan,$sql);
    } catch (exception $e) {
        $sql = <<<HEREDOC
        CREATE TABLE peserta (
            id INT(10) NOT NULL AUTO_INCREMENT,
            no_kp VARCHAR(15) NOT NULL,
            nama VARCHAR(30) NOT NULL
        )
        HEREDOC;
        $result = mysqli_query($sambungan,$sql);
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
        <h2>Info</h2>
    </header>
</body>
</html>