<?php
    session_start();
    if ($_SESSION["login"] == false)
        header("Location:./login.php");;
    include("sambungan.php");

    // Get all peserta
    try {
        $sql = "SELECT * FROM peserta";
        $result = mysqli_query($sambungan,$sql);
        while ($array = mysqli_fetch_array($result)) {
            $peserta[$array["id"]] = [
                "no_kp" => $array["no_kp"],
                "nama" => $array["nama"]
                ];
            $peserta_id[] = $array["id"];
        }
    } catch (Exception $e) {}
    $is_peserta = isset($peserta);
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
        <h2>Keputusan</h2>
        <table class="table table-bordered">
            <?php
                if ($is_peserta) {
                    $string = <<<HEREDOC
                    <thead>
                        <tr>
                            <td style="width:15%">Kedudukan</td>
                            <td style="width:15%">Id</td>
                            <td style="width:15%">No. KP</td>
                            <td>Nama</td>
                            <td style="width:15%">Skor</td>
                        <tr>
                    </thead>
                    HEREDOC;
                    echo $string;
                    echo "<tbody>";

                    try {
                        $sql = "SELECT * FROM scores";
                        $result = mysqli_query($sambungan,$sql);
                        $num_col = mysqli_num_fields($result)-1;
                        while ($array = mysqli_fetch_array($result)) {
                            $id = $array["id_peserta"];
                            $skor = 0;
                            for ($i=1;$i<$num_col+1;$i++) {
                                $r = "r$i";
                                if ($array[$r] !== "NULL") {
                                    $skor = $skor + floatval($array[$r]);
                                }
                            }
                            $scores[$id] = $skor;
                        }
                        arsort($scores);
                        $i = 1;
                        foreach (array_keys($scores) as $id) {
                            $score = $scores[$id];
                            $no_kp = $peserta["$id"]["no_kp"];
                            $nama = $peserta["$id"]["nama"];
                            $string = <<<HEREDOC
                            <tr>
                                <td>$i</td>
                                <td>$id</td>
                                <td>$no_kp</td>
                                <td>$nama</td>
                                <td>$score</td>
                            <tr>
                            HEREDOC;
                            echo $string;
                            $i++;
                        }
                    } catch (Exception $e) {}

                    echo "</tbody>";
                } else {
                    echo "<div class='alert alert-warning'>Tolong daftarkan peserta.</div>";
                }
            ?>
        </table>
    </div>
</body>
</html>