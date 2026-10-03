<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 7 - Năm âm lịch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf4fb;
        }

        table.bang {
            margin: 40px auto;
            width: 700px;
            border-collapse: collapse;
        }

        table.bang th {
            background-color: #1e6fb8;
            color: #ffffff;
            padding: 12px;
            font-size: 24px;
            text-transform: uppercase;
        }

        table.bang td {
            padding: 12px;
            color: #15508a;
            font-weight: bold;
            text-align: center;
        }

        table.bang input[type="text"] {
            padding: 5px;
            border: 1px solid #666666;
            text-align: center;
        }

        table.bang input[readonly] {
            background-color: #f4faff;
            color: #d9534f;
            font-weight: bold;
        }

        table.bang input[type="submit"] {
            background-color: #2e86de;
            color: #ffffff;
            border: 1px solid #1a5fa8;
            padding: 5px 18px;
            cursor: pointer;
            font-weight: bold;
        }

        table.bang input[type="submit"]:hover {
            background-color: #1a5fa8;
        }

        table.bang td.hinh {
            background-color: #f4faff;
            padding: 15px;
        }

        table.bang td.hinh img {
            border: 3px solid #7fb6e6;
            border-radius: 6px;
        }
    </style>
</head>

<body>

    <?php
    // 3 mảng: can, chi, hình ảnh (theo hướng dẫn của đề)
    $mang_can = array("Quý", "Giáp", "Ất", "Bính", "Đinh", "Mậu", "Kỷ", "Canh", "Tân", "Nhâm");
    $mang_chi = array("Hợi", "Tý", "Sửu", "Dần", "Mão", "Thìn", "Tỵ", "Ngọ", "Mùi", "Thân", "Dậu", "Tuất");
    $mang_hinh = array(
        "hoi.jpg",
        "ty.jpg",
        "suu.jpg",
        "dan.jpg",
        "mao.jpg",
        "thin.gif",
        "ran.jpg",
        "ngo.jpg",
        "mui.jpg",
        "than.gif",
        "dau.jpg",
        "tuat.jpg"
    );

    $nam_dl = isset($_POST['nam']) ? trim($_POST['nam']) : '';
    $nam_al = '';
    $hinh_anh = '';

    if (isset($_POST['tinh'])) {
        if (ctype_digit($nam_dl) && $nam_dl > 0) {
            $nam = intval($nam_dl) - 3;
            $can = $nam % 10;
            $chi = $nam % 12;

            $nam_al = $mang_can[$can] . " " . $mang_chi[$chi];

            $hinh = $mang_hinh[$chi];
            $hinh_anh = "<img src='12con_giap/$hinh' height='150'>";
        } else {
            $nam_al = "Năm không hợp lệ!";
        }
    }
    ?>

    <form name="form_amlich" method="POST" action="bai7_namamlich.php">
        <table class="bang">
            <tr>
                <th colspan="4">Tính năm âm lịch</th>
            </tr>

            <tr>
                <td>Năm dương lịch</td>
                <td>
                    <input type="text" name="nam" size="10" required
                        value="<?php echo htmlspecialchars($nam_dl); ?>">
                </td>
                <td>
                    <input type="submit" name="tinh" value="=>">
                </td>
                <td>
                    Năm âm lịch<br><br>
                    <input type="text" size="15" readonly
                        value="<?php echo htmlspecialchars($nam_al); ?>">
                </td>
            </tr>

            <?php if ($hinh_anh != '') { ?>
                <tr>
                    <td colspan="4" class="hinh"><?php echo $hinh_anh; ?></td>
                </tr>
            <?php } ?>
        </table>
    </form>

</body>

</html>