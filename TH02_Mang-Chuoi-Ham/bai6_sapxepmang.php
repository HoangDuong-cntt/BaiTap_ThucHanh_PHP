<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 6 - Sắp xếp mảng</title>
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

        table.bang td.tieude {
            font-weight: bold;
            color: #1f6b6b;
        }

        table.bang input[type="text"] {
            width: 95%;
            padding: 4px;
            border: 1px solid #666666;
        }

        table.bang input[readonly] {
            background-color: #f5fbf8;
            color: #d9534f;
        }

        table.bang input[type="submit"] {
            background-color: #b9dcf7;
            border: 1px solid #5a8ab0;
            padding: 5px 18px;
            cursor: pointer;
        }

        table.bang input[type="submit"]:hover {
            background-color: #8fc6ee;
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
        <table class="bang">
            <tr>
                <th colspan="2">Sắp xếp mảng</th>
            </tr>

            <tr>
                <td class="nhan">Nhập mảng:</td>
                <td><input type="text" name="mang" required
                        value="<?php echo htmlspecialchars($nhap); ?>"></td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" name="sapxep" value="Sắp xếp tăng/giảm"></td>
            </tr>

            <tr>
                <td colspan="2" class="tieude">Sau khi sắp xếp:</td>
            </tr>

            <tr>
                <td class="nhan">Tăng dần:</td>
                <td><input type="text" readonly
                        value="<?php echo htmlspecialchars($tang); ?>"></td>
            </tr>

            <tr>
                <td class="nhan">Giảm dần:</td>
                <td><input type="text" readonly
                        value="<?php echo htmlspecialchars($giam); ?>"></td>
            </tr>

            <tr>
                <td colspan="2" class="ghichu">(*) Các số được nhập cách nhau bằng dấu ","</td>
            </tr>
        </table>
    </form>

</body>

</html>