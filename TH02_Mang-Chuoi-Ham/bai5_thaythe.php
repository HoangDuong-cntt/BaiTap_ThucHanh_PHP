<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 5 - Thay thế</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }

        table.bang {
            margin: 40px auto;
            width: 640px;
            border-collapse: collapse;
            background-color: #fdeefb;
        }

        table.bang th {
            background-color: #9c2f8a;
            color: #ffffff;
            padding: 12px;
            font-size: 26px;
            font-style: italic;
            text-transform: uppercase;
        }

        table.bang td {
            padding: 8px 12px;
            color: #444444;
            font-size: 14px;
        }

        table.bang td.nhan {
            width: 170px;
        }

        /* các hàng xen kẽ nền hồng đậm hơn */
        table.bang tr.hang-dam td {
            background-color: #f6dff2;
        }

        table.bang input[type="text"] {
            width: 95%;
            padding: 4px;
            border: 1px solid #888888;
            background-color: #ffffff;
        }

        table.bang input[name="cu"],
        table.bang input[name="moi"] {
            width: 120px;
        }

        table.bang input[readonly] {
            background-color: #f4a6a6;
            border: 1px solid #777777;
        }

        table.bang input[type="submit"] {
            background-color: #fff6a8;
            border: 1px solid #888888;
            padding: 5px 18px;
            cursor: pointer;
        }

        table.bang input[type="submit"]:hover {
            background-color: #ffee55;
        }

        table.bang td.ghichu {
            text-align: center;
            background-color: #fffafe;
        }

        table.bang td.ghichu b {
            color: #c0392b;
        }
    </style>
</head>

<body>

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

    $phantu = isset($_POST['mang']) ? $_POST['mang'] : '';
    $cu = isset($_POST['cu']) ? $_POST['cu'] : '';
    $moi = isset($_POST['moi']) ? $_POST['moi'] : '';
    $chuoiCu = '';
    $chuoiMoi = '';

    if (isset($_POST["thay"])) {

        // Tách chuỗi và bỏ khoảng trắng từng phần tử
        $mang = explode(",", $phantu);
        for ($i = 0; $i < count($mang); $i++) {
            $mang[$i] = trim($mang[$i]);
        }

        $giaTriCu = trim($cu);
        $giaTriMoi = trim($moi);

        // Lưu mảng cũ
        $mangCu = $mang;

        // Thay thế
        thayThe($mang, $giaTriCu, $giaTriMoi);

        $chuoiCu = xuatMang($mangCu);
        $chuoiMoi = xuatMang($mang);
    }

    ?>

    <form name="form_thaythe" method="POST" action="">
        <table class="bang">
            <tr>
                <th colspan="2">Thay thế</th>
            </tr>

            <tr>
                <td class="nhan">Nhập các phần tử:</td>
                <td><input type="text" name="mang" required
                        value="<?php echo htmlspecialchars($phantu); ?>"></td>
            </tr>

            <tr class="hang-dam">
                <td class="nhan">Giá trị cần thay thế:</td>
                <td><input type="text" name="cu" required
                        value="<?php echo htmlspecialchars($cu); ?>"></td>
            </tr>

            <tr>
                <td class="nhan">Giá trị thay thế:</td>
                <td><input type="text" name="moi" required
                        value="<?php echo htmlspecialchars($moi); ?>"></td>
            </tr>

            <tr class="hang-dam">
                <td></td>
                <td><input type="submit" name="thay" value="Thay thế"></td>
            </tr>

            <tr>
                <td class="nhan">Mảng cũ:</td>
                <td><input type="text" name="mangcu" readonly
                        value="<?php echo htmlspecialchars($chuoiCu); ?>"></td>
            </tr>

            <tr class="hang-dam">
                <td class="nhan">Mảng sau khi thay thế:</td>
                <td><input type="text" name="mangmoi" readonly
                        value="<?php echo htmlspecialchars($chuoiMoi); ?>"></td>
            </tr>

            <tr>
                <td colspan="2" class="ghichu">
                    (<b>Ghi chú:</b> Các phần tử trong mảng sẽ cách nhau bằng dấu ",")
                </td>
            </tr>
        </table>
    </form>

</body>

</html>