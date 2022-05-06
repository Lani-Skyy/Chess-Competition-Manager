<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'pertandingan';

    $sambungan = mysqli_connect($host,$user,$password,$database);
    // if(!$sambungan)
    // {
    //     die("<p>Sambungan gagal</p>");
    // }
    // else 
    // {
    //     echo "<p>Sambungan berjaya</p>";
    // }
    $masalah_sambungan = "Terdapat masalah sambungan dengan database."
?>