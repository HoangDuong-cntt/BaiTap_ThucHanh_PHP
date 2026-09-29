<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bài 5 - Thay thế</title>
</head>

<body>

    <h2>BÀI 5 - THAY THẾ PHẦN TỬ</h2>

    <?php

    // Hàm xuất mảng
    function xuatMang($mang)
    {
        return implode(", ", $mang);
    }


    // Hàm thay thế
    function thayThe(&$mang, $cu, $moi)
    {
        for ($i = 0; $i < count($mang); $i++) {

            if ($mang[$i] == $cu) {
                $mang[$i] = $moi;
            }
        }
    }

    ?>

    <form method="POST">

        Mảng:
        <input type="text" name="mang">

        <br><br>

        Giá trị cần thay:
        <input type="text" name="cu">

        <br><br>

        Giá trị mới:
        <input type="text" name="moi">

        <br><br>

        <input type="submit" name="thay"
            value="Thay thế">

    </form>

    <?php

    if (isset($_POST["thay"])) {

        // Tách chuỗi
        $mang = explode(",", $_POST["mang"]);

        $cu = $_POST["cu"];
        $moi = $_POST["moi"];

        // Lưu mảng cũ
        $mangCu = $mang;

        // Thay thế
        thayThe($mang, $cu, $moi);

        echo "<p>Mảng cũ: "
            . xuatMang($mangCu)
            . "</p>";

        echo "<p>Mảng mới: "
            . xuatMang($mang)
            . "</p>";
    }

    ?>

</body>

</html>