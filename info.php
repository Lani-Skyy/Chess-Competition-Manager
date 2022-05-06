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
    </header>
    <div class="center">
        <h2>Info</h2>
        <h3>Cara Penggunaan:</h3>
        <ol>
            <li>daftar atau login urusetia</li>
            <li>daftarkan hakim</li>
            <li>daftarkan peserta</li>
            <li>janakan pusingan seterusnya</li>
            <li>rekodkan keputusan pusingan tersebut</li>
            <li>ulang sampai semua pusingan habis</li>
            <li>dapatkan keputusan akhir</li>
        </ol>
        <h6 style="text-decoration:overline; ">Lanisha Anusri</h6>
    </div>
</body>
</html>