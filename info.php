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
    <div class="center centered-content">
        <h2>Info</h2>
        <h3>Cara Penggunaan:</h3>
        <ol>
            <li>Daftar atau login urusetia.</li>
            <li>Daftarkan hakim.</li>
            <li>Daftarkan peserta.</li>
            <li>Janakan pusingan seterusnya.</li>
            <li>Rekodkan keputusan pusingan tersebut.</li>
            <li>Ulang sampai semua pusingan habis.</li>
            <li>Dapatkan keputusan akhir.</li>
        </ol>
        <h6 style="text-decoration:overline; ">Lanisha Anusri</h6>
    </div>
</body>
</html>