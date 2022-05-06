<?php
    session_start();
    if ($_SESSION["login"] == false)
        header("Location:./login.php");
    include("sambungan.php");
    include("algorithm.php");

    // Get all peserta
    try {
        $sql = "SELECT * FROM peserta";
        $result = mysqli_query($sambungan,$sql);
        while ($array = mysqli_fetch_array($result)) {
            $peserta[] = [
                "id" => $array["id"],
                "no_kp" => $array["no_kp"],
                "nama" => $array["nama"]
                ];
            $peserta_id[] = $array["id"];
        }
    } catch (Exception $e) {}
    $is_peserta = isset($peserta_id);

    if ($is_peserta) {
        @$schedule = scheduler($peserta_id); // Problem: Unorthodox
        $num_rounds = sizeof($schedule);

        if (isset($_POST["round"])) {
            $_SESSION["round"] = ((int) $_POST["round"]) - 1;
            $_POST = NULL;
        }
    } else {
        unset($_SESSION["round"]);
    }

    if (isset($_SESSION["round"])) {
        // make string for columns
        $col_create = NULL;
        $col = [];
        for ($i=1; $i<$num_rounds+1; $i++) {
            if ($i == $num_rounds) {
                $col_create = $col_create . <<<HEREDOC
                r$i VARCHAR(5)
                HEREDOC;
            } else {
                $col_create = $col_create . <<<HEREDOC
                r$i VARCHAR(5), 
                HEREDOC;
            }
            $tmp = "r$i";
            $col[] = $tmp;
        }

        $round = $_SESSION["round"];
        $games = $schedule[$round];
        $num_games = sizeof($games);
        $r = $col["$round"];

        try {
            $sql = "SELECT * FROM matches";
            $result = mysqli_query($sambungan,$sql);
        } 
        catch (Exception $e) {
            // Create table matches
            $sql = "CREATE TABLE matches (id_peserta INT(10), $col_create)";
            $result = mysqli_query($sambungan,$sql);

            // Insert into matches
            $matches = [];
            foreach($schedule AS $rounds => $games){
                foreach($peserta_id AS $id) {
                    foreach($games AS $play){
                        if ($play["Home"] == $id) {
                            $matches[$id][$rounds] = $play["Away"];
                        }
                        else if ($play["Away"] == $id) {
                            $matches[$id][$rounds] = $play["Home"];
                        }
                    }
                }
            }
            foreach($matches AS $id => $opponents) {
                $string = NULL;
                foreach($opponents as $opponent) {
                    if ($opponent == "bye") {
                        $string = $string . <<<HEREDOC
                        NULL, 
                        HEREDOC;
                    } else {
                        $string = $string . <<<HEREDOC
                        $opponent, 
                        HEREDOC;
                    }
                }
                $string = substr($string,0,-2);
                $sql = "INSERT INTO matches VALUES ($id, $string)";
                $result = mysqli_query($sambungan,$sql);
            }
        }

        try {
            $sql = "SELECT * FROM scores";
            $result = mysqli_query($sambungan,$sql);
        }
        catch (Exception $e) {
            // create scores table
            $sql = "CREATE TABLE scores (id_peserta INT(10), $col_create)";
            $result = mysqli_query($sambungan,$sql);
            $string = NULL;
            for ($i=0;$i<$num_rounds;$i++) {
                $string = $string . <<<HEREDOC
                "NULL", 
                HEREDOC;
            }
            $string = SUBSTR($string, 0, -2);
            foreach ($peserta_id as $p) {
                $sql = "INSERT INTO scores VALUES ($p,$string)";
                $result = mysqli_query($sambungan,$sql);
            }
        }

        // Submit
        if (isset($_POST["submit"])) {
            for ($i=0; $i<sizeof($_POST); $i++) {
                $key = array_keys($_POST)[$i];
                if (str_contains($key, 'keputusan')) {
                    if ($key !== "keputusan_NULL") {
                        $id = substr($key,10,);
                        $skor = $_POST["$key"];

                        // Error Checking
                        $not_allowed = [""," ", "NULL", "null", NULL];
                        if (in_array($skor,$not_allowed)) {
                            $skor = "NULL";
                        }
                        // Insert skor
                        $sql = "UPDATE scores SET $r = '$skor' WHERE id_peserta = $id";
                        $result = mysqli_query($sambungan,$sql);
                    }
                }
            }
            $_POST = NULL;
        }

        // Clear
        if (isset($_POST["clear"])){
            try {
                $sql = <<<HEREDOC
                UPDATE scores SET $r = "NULL"
                HEREDOC;
                $result = mysqli_query($sambungan,$sql);
            } catch (Exception $e) {
            }
            $_POST = NULL;
        }

        // Reset
        if (isset($_POST["reset"])){
            try {
                $sql = "DROP TABLE scores";
                $result = mysqli_query($sambungan,$sql);
            } catch (Exception $e) {
            }
            $_POST = NULL;
            unset($_SESSION["round"]);
            $round = "0";
        }
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
    <div class="center">
        <h2>Pusingan</h2>
        <form action="pusingan.php" method="post">
            <table class="table table-bordered">
                <tr>
                    <?php
                        if (isset($_SESSION["round"])) {
                            $temp = $round+1;
                            echo "<h3>Pusingan $temp</h3>";
                        }
                        if ($is_peserta) {
                            echo "<td>Pusingan: </td>";
                            for ($i=1; $i < $num_rounds+1; $i++) {
                                $string = <<<HEREDOC
                                <td><input style="min-width: 50px;" type="submit" class="round" name="round" value="$i"></td>
                                HEREDOC;
                                echo $string;
                            }
                        } else {
                            echo "Tolong daftarkan peserta";
                        }
                    ?>
                </tr>
            </table>
            <table class="table table-bordered">
                <?php
                    if (isset($_SESSION["round"])) {
                        $string = <<<HEREDOC
                        <thead>
                            <tr>
                                <td></td>
                                <td>Putih</td>
                                <td></td>
                                <td></td>
                                <td>Hitam</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>No. KP</td>
                                <td>Nama</td>
                                <td>Keputusan</td>
                                <td>Keputusan</td>
                                <td>Nama</td>
                                <td>No. KP</td>
                            </tr>
                        </thead>

                        HEREDOC;
                        echo $string;

                        foreach($games AS $play){
                            $w = array_search($play["Home"],$peserta_id,true);
                            $b = array_search($play["Away"],$peserta_id,true);
                            if ($w === false) {
                                $w_no_kp = "-";
                                $w_nama = "bye";
                                $w_kid = "keputusan_NULL";
                                $w_skor = "no skor";
                            } else {
                                $w_no_kp = $peserta[$w]["no_kp"];
                                $w_nama = $peserta[$w]["nama"];
                                $w_id = $peserta[$w]["id"];
                                $w_kid = "keputusan_" . "$w_id";
                                $sql = "SELECT $r FROM scores WHERE id_peserta = $w_id";
                                $result = mysqli_query($sambungan,$sql);
                                while ($array = mysqli_fetch_array($result)) {
                                    if ($array[0] == "NULL") {
                                        $w_skor = "no skor";
                                    } else {
                                        $w_skor = $array[0];
                                    }
                                }
                            }
                            if ($b === false) {
                                $b_no_kp = "-";
                                $b_nama = "bye";
                                $b_kid = "keputusan_NULL";
                                $b_skor = "no skor";
                            } else {
                                $b_no_kp = $peserta[$b]["no_kp"];
                                $b_nama = $peserta[$b]["nama"];
                                $b_id = $peserta[$b]["id"];
                                $b_kid = "keputusan_" . "$b_id";
                                $sql = "SELECT $r FROM scores WHERE id_peserta = $b_id";
                                $result = mysqli_query($sambungan,$sql);
                                while ($array = mysqli_fetch_array($result)) {
                                    if ($array[0] == "NULL") {
                                        $b_skor = "no skor";
                                    } else {
                                        $b_skor = $array[0];
                                    }
                                }
                            }

                            if ($w_skor == "no skor" and $b_skor == "no skor") {
                                $string = <<<HEREDOC
                                <tr>
                                    <td>$w_no_kp</td>
                                    <td>$w_nama</td>
                                    <td>
                                        <select name="$w_kid" id="cars">
                                            <option disabled selected value="NULL">select</option>
                                            <option value="1">win</option>
                                            <option value="0.5">draw</option>
                                            <option value="0">lose</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="$b_kid" id="cars">
                                            <option disabled selected value="NULL">select</option>
                                            <option value="1">win</option>
                                            <option value="0.5">draw</option>
                                            <option value="0">lose</option>
                                        </select>
                                    </td>
                                    <td>$b_nama</td>
                                    <td>$b_no_kp</td>
                                </tr>
                                HEREDOC;
                            } else {
                                $string = <<<HEREDOC
                                <tr>
                                    <td>$w_no_kp</td>
                                    <td>$w_nama</td>
                                    <td>$w_skor</td>
                                    <td>$b_skor</td>
                                    <td>$b_nama</td>
                                    <td>$b_no_kp</td>
                                </tr>
                                HEREDOC;
                            }
                            echo $string;
                        }
                    }
                ?>
            </table>
            <?php
                if (isset($_SESSION["round"])) {
                    $string = <<<HEREDOC
                    <input type="submit" name="submit" value="submit">
                    <input type="submit" name="clear" value="clear">
                    <input type="submit" name="reset" value="reset">
                    HEREDOC;
                    echo $string;
                }
            ?>
        </form>
    </div>
</body>
</html>