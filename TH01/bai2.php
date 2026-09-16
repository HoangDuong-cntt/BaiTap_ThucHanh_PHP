<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng cửu chương</title>
</head>
<html>

<body>
    <?php
    echo "<h2>BẢNG CỬU CHƯƠNG TỪ 1 ĐẾN 10</h2>";
    echo "<table border='1' cellspacing='0' cellpadding='8' style='border-collapse: collapse;'>";
    echo "<tr>";

    for ($i = 1; $i <= 10; $i++) {
        echo "<td valign='top'>";
        echo "<b>Bảng $i</b><br><br>";

        for ($j = 1; $j <= 10; $j++) {
            echo "$i x $j = " . ($i * $j) . "<br>";
        }

        echo "</td>";
        if ($i == 5) {
            echo "</tr><tr>";
        }
    }

    echo "</tr>";
    echo "</table>";
    ?>
</body>

</html>