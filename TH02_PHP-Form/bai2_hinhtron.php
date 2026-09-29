<?php
define('PI', 3.14);

$ban_kinh = isset($_POST['ban_kinh']) ? $_POST['ban_kinh'] : '';
$dien_tich = '';
$chu_vi = '';

if (isset($_POST['tinh'])) {
    if (is_numeric($ban_kinh) && $ban_kinh > 0) {
        $dien_tich = PI * pow($ban_kinh, 2);
        $chu_vi = 2 * PI * $ban_kinh;
    } else {
        $dien_tich = "Vui lòng nhập bán kính hợp lệ!";
        $chu_vi = "Vui lòng nhập bán kính hợp lệ!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Diện tích và chu vi hình tròn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 30px;
        }

        table {
            background-color: #fff9c4;
            margin: 0 auto;
            border-collapse: collapse;
            width: 380px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #f57f17;
            color: white;
            padding: 12px;
            font-size: 18px;
        }

        td {
            padding: 8px 15px;
        }

        .bg-result {
            background-color: #ffcdd2;
        }

        input[type="text"] {
            width: 95%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #e0e0e0;
            border: 1px solid #999;
            padding: 5px 15px;
            cursor: pointer;
            border-radius: 3px;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <form action="" method="post" name="form_ht">
        <table border="0">
            <tr>
                <th colspan="2">DIỆN TÍCH và CHU VI HÌNH TRÒN</th>
            </tr>
            <tr>
                <td>Bán kính:</td>
                <td><input type="text" name="ban_kinh" value="<?php echo htmlspecialchars($ban_kinh); ?>" required></td>
            </tr>
            <tr>
                <td>Diện tích:</td>
                <td><input type="text" name="dien_tich" class="bg-result" value="<?php echo htmlspecialchars($dien_tich); ?>" readonly></td>
            </tr>
            <tr>
                <td>Chu vi:</td>
                <td><input type="text" name="chu_vi" class="bg-result" value="<?php echo htmlspecialchars($chu_vi); ?>" readonly></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="tinh" value="Tính">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>