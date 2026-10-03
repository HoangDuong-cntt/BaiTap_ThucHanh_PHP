<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 1 - Mảng ngẫu nhiên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf4fb;
        }

        table.bang {
            margin: 40px auto;
            width: 700px;
            border-collapse: collapse;
            background-color: #d6e9f8;
        }

        table.bang th {
            background-color: #1e6fb8;
            color: #ffffff;
            padding: 12px;
            font-size: 24px;
            text-transform: uppercase;
        }

        table.bang td {
            padding: 8px 12px;
            color: #333333;
            border-bottom: 1px solid #b6d3ee;
        }

        table.bang td.nhan {
            width: 230px;
            font-weight: bold;
            color: #15508a;
        }

        table.bang input[type="text"] {
            width: 120px;
            padding: 4px;
            border: 1px solid #666666;
        }

        table.bang input[type="submit"] {
            background-color: #2e86de;
            color: #ffffff;
            border: 1px solid #1a5fa8;
            padding: 5px 18px;
            cursor: pointer;
        }

        table.bang input[type="submit"]:hover {
            background-color: #1a5fa8;
        }

        table.bang td.ketqua {
            background-color: #f4faff;
            color: #d9534f;
            font-weight: bold;
            word-break: break-word;
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

    <form name="form_bai1" method="POST" action="">
        <table class="bang">
            <tr>
                <th colspan="2">Bài 1 - Mảng ngẫu nhiên</th>
            </tr>

            <tr>
                <td class="nhan">Nhập n:</td>
                <td>
                    <input type="text" name="n"
                        value="<?php echo isset($_POST['n']) ? htmlspecialchars($_POST['n']) : ''; ?>">
                    <input type="submit" name="thuchien" value="Thực hiện">
                </td>
            </tr>

            <?php

            if (isset($_POST["thuchien"])) {

                $n = $_POST["n"];

                // a.Kiểm tra n có phải số nguyên dương
                if (!is_numeric($n) || $n <= 0 || $n != intval($n)) {
                    echo '<tr><td colspan="2" class="loi">n phải là số nguyên dương!</td></tr>';
                } else {

                    $n = intval($n);

                    // b.Tạo mảng ngẫu nhiên
                    $mang = [];

                    for ($i = 0; $i < $n; $i++) {
                        $mang[$i] = rand(-100, 200);
                    }

                    echo '<tr><td class="nhan">Mảng ban đầu:</td><td class="ketqua">'
                        . implode(", ", $mang) . '</td></tr>';

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

                    echo '<tr><td class="nhan">Số phần tử chẵn:</td><td class="ketqua">'
                        . $demChan . '</td></tr>';

                    echo '<tr><td class="nhan">Số phần tử nhỏ hơn 100:</td><td class="ketqua">'
                        . $demNho100 . '</td></tr>';

                    echo '<tr><td class="nhan">Tổng các số âm:</td><td class="ketqua">'
                        . $tongAm . '</td></tr>';

                    if (count($viTriSo0) > 0) {
                        echo '<tr><td class="nhan">Vị trí các số 0:</td><td class="ketqua">'
                            . implode(", ", $viTriSo0) . '</td></tr>';
                    } else {
                        echo '<tr><td class="nhan">Vị trí các số 0:</td><td class="ketqua">Không có số 0 trong mảng.</td></tr>';
                    }

                    // g.Sắp xếp tăng dần
                    sort($mang);

                    echo '<tr><td class="nhan">Mảng sau khi sắp xếp tăng dần:</td><td class="ketqua">'
                        . implode(", ", $mang) . '</td></tr>';
                }
            }

            ?>
        </table>
    </form>

</body>

</html>