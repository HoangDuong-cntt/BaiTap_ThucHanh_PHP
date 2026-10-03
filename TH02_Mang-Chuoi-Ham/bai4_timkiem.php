<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 4 - Tìm kiếm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f3;
        }

        table.bang {
            margin: 40px auto;
            width: 620px;
            border-collapse: collapse;
            background-color: #c9ddd5;
        }

        table.bang th {
            background-color: #2e8b8b;
            color: #ffffff;
            padding: 12px;
            font-size: 24px;
            text-transform: uppercase;
        }

        table.bang td {
            padding: 8px 12px;
            color: #333333;
        }

        table.bang td.nhan {
            width: 150px;
        }

        table.bang input[type="text"] {
            width: 95%;
            padding: 4px;
            border: 1px solid #666666;
        }

        table.bang input[name="x"] {
            width: 120px;
        }

        table.bang input[readonly] {
            background-color: #f5fbf8;
        }

        table.bang input[name="ketqua"] {
            color: #d9534f;
        }

        table.bang input[type="submit"] {
            background-color: #b9dcf7;
            border: 1px solid #5a8ab0;
            padding: 5px 18px;
            cursor: pointer;
        }

        table.bang td.ghichu {
            background-color: #6fb7b7;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <?php

    // Hàm tìm kiếm: trả về vị trí (bắt đầu từ 0) nếu thấy, ngược lại trả về -1
    function tim_kiem($mang, $gia_tri)
    {
        for ($i = 0; $i < count($mang); $i++) {
            if ($mang[$i] == $gia_tri) {
                return $i;
            }
        }
        return -1;
    }

    $nhap_mang = isset($_POST['nhapmang']) ? $_POST['nhapmang'] : '';
    $x = isset($_POST['x']) ? $_POST['x'] : '';
    $chuoi_mang = '';
    $ket_qua = '';

    if (isset($_POST['timkiem'])) {
        // Tách chuỗi và gán vào mảng
        $mang = explode(",", $nhap_mang);
        for ($i = 0; $i < count($mang); $i++) {
            $mang[$i] = trim($mang[$i]);
        }
        $gia_tri = trim($x);

        // In mảng
        $chuoi_mang = implode(", ", $mang);

        // Gọi hàm tìm kiếm
        $vi_tri = tim_kiem($mang, $gia_tri);

        if ($vi_tri != -1) {
            $ket_qua = "Đã tìm thấy $gia_tri tại vị trí thứ " . ($vi_tri + 1) . " của mảng";
        } else {
            $ket_qua = "Không tìm thấy $gia_tri trong mảng";
        }
    }

    ?>

    <form name="form_timkiem" method="POST" action="bai4_timkiem.php">
        <table class="bang">
            <tr>
                <th colspan="2">Tìm kiếm</th>
            </tr>

            <tr>
                <td class="nhan">Nhập mảng:</td>
                <td><input type="text" name="nhapmang" required
                        value="<?php echo htmlspecialchars($nhap_mang); ?>"></td>
            </tr>

            <tr>
                <td class="nhan">Nhập số cần tìm:</td>
                <td><input type="text" name="x" required
                        value="<?php echo htmlspecialchars($x); ?>"></td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" name="timkiem" value="Tìm kiếm"></td>
            </tr>

            <tr>
                <td class="nhan">Mảng:</td>
                <td><input type="text" name="mang" readonly
                        value="<?php echo htmlspecialchars($chuoi_mang); ?>"></td>
            </tr>

            <tr>
                <td class="nhan">Kết quả tìm kiếm:</td>
                <td><input type="text" name="ketqua" readonly
                        value="<?php echo htmlspecialchars($ket_qua); ?>"></td>
            </tr>

            <tr>
                <td colspan="2" class="ghichu">(Các phần tử trong mảng sẽ cách nhau bằng dấu ",")</td>
            </tr>
        </table>
    </form>

</body>

</html>