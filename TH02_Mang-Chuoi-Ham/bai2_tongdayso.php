<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Tổng dãy số</title>
</head>

<body>
    <h2>NHẬP VÀ TÍNH TRÊN DÃY SỐ</h2>

    <form name="form_dayso" method="POST" action="">
        Nhập dãy số:
        <input type="text" name="dayso" required
            value="<?php echo isset($_POST['dayso']) ? htmlspecialchars($_POST['dayso']) : ''; ?>">
        (*)
        <br><br>

        <input type="submit" name="thuchien" value="Tổng dãy số">
        <br><br>

        Tổng dãy số:
        <input type="text" name="tong" readonly
            value="<?php
                    if (isset($_POST['thuchien'])) {
                        // Tách chuỗi và gán vào mảng
                        $mang = explode(",", $_POST['dayso']);
                        $tong = 0;
                        $hople = true;

                        // Duyệt mảng bằng for để tính tổng
                        for ($i = 0; $i < count($mang); $i++) {
                            $so = trim($mang[$i]);
                            if (is_numeric($so)) {
                                $tong += $so;
                            } else {
                                $hople = false;
                                break;
                            }
                        }

                        echo $hople ? $tong : "Dãy số không hợp lệ!";
                    }
                    ?>">
        <br><br>

        <small>(*) Các số được nhập cách nhau bằng dấu ","</small>
    </form>
</body>

</html>