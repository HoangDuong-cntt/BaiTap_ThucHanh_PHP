<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 3 - Phát sinh mảng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
        }

        table.bang {
            margin: 40px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 2px solid #2c7be5;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            min-width: 450px;
        }

        table.bang th {
            background-color: #2c7be5;
            color: #ffffff;
            padding: 12px;
            font-size: 18px;
            text-transform: uppercase;
        }

        table.bang td {
            padding: 10px 15px;
            border: 1px solid #b6d0f5;
        }

        table.bang td.nhan {
            background-color: #e8f1fd;
            color: #1a4f9c;
            font-weight: bold;
            width: 130px;
        }

        table.bang input[type="text"] {
            width: 200px;
            padding: 6px;
            border: 1px solid #999;
            border-radius: 4px;
        }

        table.bang input[type="submit"] {
            background-color: #28a745;
            color: #ffffff;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
        }

        table.bang input[type="submit"]:hover {
            background-color: #1e7e34;
        }

        table.bang td.ketqua {
            background-color: #fff8dc;
            color: #d9534f;
            font-weight: bold;
        }

        table.bang td.loi {
            background-color: #fdf2f2;
            color: #c0392b;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>

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
        <table class="bang">
            <tr>
                <th colspan="2">Bài 3 - Phát sinh mảng và tính toán</th>
            </tr>

            <tr>
                <td class="nhan">Nhập số phần tử:</td>
                <td>
                    <input type="text" name="n"
                        value="<?php echo isset($_POST['n']) ? htmlspecialchars($_POST['n']) : ''; ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="thuchien" value="Phát sinh và tính toán">
                </td>
            </tr>

            <?php

            if (isset($_POST["thuchien"])) {

                $n = $_POST["n"];

                if (!is_numeric($n) || $n <= 0 || $n != intval($n)) {

                    echo '<tr><td colspan="2" class="loi">Vui lòng nhập số nguyên dương!</td></tr>';
                } else {

                    $n = intval($n);

                    // Gọi hàm tạo mảng
                    $mang = taoMang($n);

                    echo '<tr><td class="nhan">Mảng:</td><td class="ketqua">' . xuatMang($mang) . '</td></tr>';

                    echo '<tr><td class="nhan">Tổng:</td><td class="ketqua">' . tinhTong($mang) . '</td></tr>';

                    echo '<tr><td class="nhan">GTLN:</td><td class="ketqua">' . timMax($mang) . '</td></tr>';

                    echo '<tr><td class="nhan">GTNN:</td><td class="ketqua">' . timMin($mang) . '</td></tr>';
                }
            }

            ?>
        </table>
    </form>

</body>

</html>