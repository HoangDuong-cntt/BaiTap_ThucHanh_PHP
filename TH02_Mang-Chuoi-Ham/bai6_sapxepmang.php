<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 6 - Sắp xếp mảng</title>
</head>

<body>
    <h2>SẮP XẾP MẢNG</h2>

    <?php
    // Hàm hoán vị hai số (truyền tham chiếu)
    function hoan_vi(&$a, &$b)
    {
        $tam = $a;
        $a = $b;
        $b = $tam;
    }

    // Hàm sắp tăng: 2 vòng for lồng nhau
    function sap_tang($mang)
    {
        $n = count($mang);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                if ($mang[$i] > $mang[$j]) {
                    hoan_vi($mang[$i], $mang[$j]);
                }
            }
        }
        return $mang;
    }

    // Hàm sắp giảm: làm tương tự, đổi dấu so sánh
    function sap_giam($mang)
    {
        $n = count($mang);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                if ($mang[$i] < $mang[$j]) {
                    hoan_vi($mang[$i], $mang[$j]);
                }
            }
        }
        return $mang;
    }

    $nhap = isset($_POST['mang']) ? $_POST['mang'] : '';
    $tang = '';
    $giam = '';

    if (isset($_POST['sapxep'])) {
        // Tách chuỗi và gán vào mảng
        $mang = explode(",", $nhap);
        $hople = true;

        for ($i = 0; $i < count($mang); $i++) {
            $mang[$i] = trim($mang[$i]);
            if (!is_numeric($mang[$i])) {
                $hople = false;
                break;
            }
            $mang[$i] = $mang[$i] + 0; // đổi sang kiểu số
        }

        if ($hople) {
            $tang = implode(", ", sap_tang($mang));
            $giam = implode(", ", sap_giam($mang));
        } else {
            $tang = $giam = "Dãy số không hợp lệ!";
        }
    }
    ?>

    <form name="form_sapxep" method="POST" action="bai6_sapxepmang.php">
        Nhập mảng:
        <input type="text" name="mang" size="40" required
            value="<?php echo htmlspecialchars($nhap); ?>">
        (*)
        <br><br>

        <input type="submit" name="sapxep" value="Sắp xếp tăng/giảm">
        <br><br>

        <b>Sau khi sắp xếp:</b>
        <br><br>

        Tăng dần:
        <input type="text" size="40" readonly
            value="<?php echo htmlspecialchars($tang); ?>">
        <br><br>

        Giảm dần:
        <input type="text" size="40" readonly
            value="<?php echo htmlspecialchars($giam); ?>">
        <br><br>

        <small>(*) Các số được nhập cách nhau bằng dấu ","</small>
    </form>
</body>

</html>