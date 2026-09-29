<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bài 1 - Mảng ngẫu nhiên</title>
</head>

<body>

    <h2>BÀI 1 - MẢNG NGẪU NHIÊN</h2>

    <form method="POST">
        Nhập n:
        <input type="text" name="n">

        <input type="submit" name="thuchien" value="Thực hiện">
    </form>

    <?php

    if (isset($_POST["thuchien"])) {

        $n = $_POST["n"];

        // a.Kiểm tra n có phải số nguyên dương
        if (!is_numeric($n) || $n <= 0 || $n != intval($n)) {
            echo "<p>n phải là số nguyên dương!</p>";
        } else {

            $n = intval($n);

            // b.Tạo mảng ngẫu nhiên
            $mang = [];

            for ($i = 0; $i < $n; $i++) {
                $mang[$i] = rand(-100, 200);
            }

            echo "<p>Mảng ban đầu: ";
            echo implode(", ", $mang);
            echo "</p>";

            //c. Đếm số chẵn
            $demChan = 0;

            //d.Đếm số nhỏ hơn 100
            $demNho100 = 0;

            // e.Tổng số âm
            $tongAm = 0;

            // f.Vị trí số 0
            $viTriSo0 = [];

            for ($i = 0; $i < $n; $i++) {

                // Số chẵn
                if ($mang[$i] % 2 == 0) {
                    $demChan++;
                }

                // Số nhỏ hơn 100
                if ($mang[$i] < 100) {
                    $demNho100++;
                }

                // Số âm
                if ($mang[$i] < 0) {
                    $tongAm += $mang[$i];
                }

                // Số bằng 0
                if ($mang[$i] == 0) {
                    $viTriSo0[] = $i;
                }
            }

            echo "<p>Số phần tử chẵn: $demChan</p>";

            echo "<p>Số phần tử nhỏ hơn 100: $demNho100</p>";

            echo "<p>Tổng các số âm: $tongAm</p>";

            if (count($viTriSo0) > 0) {
                echo "<p>Vị trí các số 0: ";
                echo implode(", ", $viTriSo0);
                echo "</p>";
            } else {
                echo "<p>Không có số 0 trong mảng.</p>";
            }

            // g.Sắp xếp tăng dần
            sort($mang);

            echo "<p>Mảng sau khi sắp xếp tăng dần: ";
            echo implode(", ", $mang);
            echo "</p>";
        }
    }

    ?>

</body>

</html>