<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Tổng dãy số</title>
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
            width: 280px;
            padding: 6px;
            border: 1px solid #999;
            border-radius: 4px;
        }

        table.bang input[name="tong"] {
            background-color: #fff8dc;
            color: #d9534f;
            font-weight: bold;
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

        table.bang td.ghichu {
            background-color: #fdf2f2;
            color: #c0392b;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <form name="form_dayso" method="POST" action="">
        <table class="bang">
            <tr>
                <th colspan="2">Nhập và tính trên dãy số</th>
            </tr>

            <tr>
                <td class="nhan">Nhập dãy số:</td>
                <td>
                    <input type="text" name="dayso" required
                        value="<?php echo isset($_POST['dayso']) ? htmlspecialchars($_POST['dayso']) : ''; ?>">
                    (*)
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="thuchien" value="Tổng dãy số">
                </td>
            </tr>

            <tr>
                <td class="nhan">Tổng dãy số:</td>
                <td>
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
                </td>
            </tr>

            <tr>
                <td colspan="2" class="ghichu">(*) Các số được nhập cách nhau bằng dấu ","</td>
            </tr>
        </table>
    </form>
</body>

</html>