<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'test'; // Tukar nama jika berlainan

    $sambungan = mysqli_connect($host,$user,$password,$database);
    // if(!$sambungan)
    // {
    //     die("<p>Sambungan gagal</p>");
    // }
    // else 
    // {
    //     echo "<p>Sambungan berjaya</p>";
    // }
?>