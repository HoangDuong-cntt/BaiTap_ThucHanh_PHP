<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bài 3 - Phát sinh mảng</title>
</head>

<body>

    <h2>BÀI 3 - PHÁT SINH MẢNG VÀ TÍNH TOÁN</h2>

    <?php

    // Hàm tạo mảng
    function taoMang($n)
    {
        $mang = [];

        for ($i = 0; $i < $n; $i++) {
            $mang[$i] = rand(0, 20);
        }

        return $mang;
    }


    // Hàm xuất mảng
    function xuatMang($mang)
    {
        return implode(" ", $mang);
    }


    // Hàm tính tổng
    function tinhTong($mang)
    {
        $tong = 0;

        foreach ($mang as $so) {
            $tong += $so;
        }

        return $tong;
    }


    // Hàm tìm nhỏ nhất
    function timMin($mang)
    {
        $min = $mang[0];

        foreach ($mang as $so) {

            if ($so < $min) {
                $min = $so;
            }
        }

        return $min;
    }


    // Hàm tìm lớn nhất
    function timMax($mang)
    {
        $max = $mang[0];

        foreach ($mang as $so) {

            if ($so > $max) {
                $max = $so;
            }
        }

        return $max;
    }

    ?>

    <form method="POST">

        Nhập số phần tử:
        <input type="text" name="n">

        <input type="submit" name="thuchien"
            value="Phát sinh và tính toán">

    </form>

    <?php

    if (isset($_POST["thuchien"])) {

        $n = $_POST["n"];

        if (!is_numeric($n) || $n <= 0 || $n != intval($n)) {

            echo "<p>Vui lòng nhập số nguyên dương!</p>";
        } else {

            $n = intval($n);

            // Gọi hàm tạo mảng
            $mang = taoMang($n);

            echo "<p>Mảng: " . xuatMang($mang) . "</p>";

            echo "<p>Tổng: " . tinhTong($mang) . "</p>";

            echo "<p>GTLN: " . timMax($mang) . "</p>";

            echo "<p>GTNN: " . timMin($mang) . "</p>";
        }
    }

    ?>

</body>

</html>