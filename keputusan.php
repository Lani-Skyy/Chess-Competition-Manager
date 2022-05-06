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
        <h2>Keputusan</h2>
    </header>
    <div>
        <table>
            <?php
                if ($is_peserta) {
                    $string = <<<HEREDOC
                    <tr>
                        <td>Id</td>
                        <td>No. KP</td>
                        <td>Nama</td>
                        <td>Skor</td>
                    <tr>
                    HEREDOC;
                    echo $string;

                    try {
                        $sql = "SELECT * FROM scores";
                        $result = mysqli_query($sambungan,$sql);
                        $num_col = mysqli_num_fields($result)-1;
                        while ($array = mysqli_fetch_array($result)) {
                            $id = $array["id_peserta"];
                            $no_kp = $peserta[$id]["no_kp"];
                            $nama = $peserta[$id]["nama"];
                            $skor = 0;
                            for ($i=1;$i<$num_col+1;$i++) {
                                $r = "r$i";
                                $accepted = ["0","0.5","1"];
                                if (in_array($array[$r],$accepted)) {
                                    $skor = $skor + (int)$array[$r];
                                }
                            }
                            $string = <<<HEREDOC
                            <tr>
                                <td>$id</td>
                                <td>$no_kp</td>
                                <td>$nama</td>
                                <td>$skor</td>
                            <tr>
                            HEREDOC;
                            echo $string;
                        }
                    } catch (Exception $e) {}
                } else {
                    echo "Tolong daftarkan peserta";
                }
            ?>
        </table>
    </div>
</body>
</html>