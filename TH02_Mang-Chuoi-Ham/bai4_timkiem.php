<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bài 4 - Tìm kiếm</title>
</head>

<body>

    <h2>BÀI 4 - TÌM KIẾM TRONG MẢNG</h2>

    <?php

    // Hàm tìm kiếm
    function timKiem($mang, $x)
    {
        for ($i = 0; $i < count($mang); $i++) {

            if ($mang[$i] == $x) {
                return $i;
            }
        }

        return -1;
    }

    ?>

    <form method="POST" action="bai4_timkiem.php">

        Mảng:
        <input type="text" name="mang"
            value="<?php echo isset($_POST['mang']) ? $_POST['mang'] : ''; ?>">

        <br><br>

        Nhập số cần tìm:
        <input type="text" name="x"
            value="<?php echo isset($_POST['x']) ? $_POST['x'] : ''; ?>">

        <br><br>

        <input type="submit" name="tim" value="Tìm kiếm">

    </form>

    <?php

    if (isset($_POST["tim"])) {

        $chuoi = $_POST["mang"];

        $x = $_POST["x"];

        // Tách chuỗi
        $mang = explode(",", $chuoi);

        // Tìm kiếm
        $viTri = timKiem($mang, $x);

        if ($viTri != -1) {

            echo "<p>Đã tìm thấy $x tại vị trí thứ "
                . ($viTri + 1)
                . " của mảng.</p>";
        } else {

            echo "<p>Không tìm thấy $x trong mảng.</p>";
        }
    }

    ?>

</body>

</html>