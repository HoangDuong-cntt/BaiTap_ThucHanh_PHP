<?php
$chieu_dai = isset($_POST['chieu_dai']) ? $_POST['chieu_dai'] : '';
$chieu_rong = isset($_POST['chieu_rong']) ? $_POST['chieu_rong'] : '';
$dien_tich = '';

if (isset($_POST['tinh'])) {
    if (is_numeric($chieu_dai) && is_numeric($chieu_rong)) {
        $dien_tich = $chieu_dai * $chieu_rong;
    } else {
        $dien_tich = "Vui lòng nhập số!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 1 - Diện tích hình chữ nhật</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 30px;
        }

        table {
            background-color: #ffe8e8;
            margin: 0 auto;
            border-collapse: collapse;
            width: 380px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #ff9800;
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
    <form action="" method="post" name="form_hcn">
        <table border="0">
            <tr>
                <th colspan="2">DIỆN TÍCH HÌNH CHỮ NHẬT</th>
            </tr>
            <tr>
                <td>Chiều dài:</td>
                //lấy đúng giá trị của ô có name
                //ô vẫn hiện số vừa nhập
                <td><input type="text" name="chieu_dai" value="<?php echo htmlspecialchars($chieu_dai); ?>" required></td>
            </tr>
            <tr>
                <td>Chiều rộng:</td>
                <td><input type="text" name="chieu_rong" value="<?php echo htmlspecialchars($chieu_rong); ?>" required></td>
            </tr>
            <tr>
                <td>Diện tích:</td>
                // nhập và bấm Tính -> gửi POST -> PHP ở đầu chạy trước => tính $dien_tich
                <td><input type="text" name="dien_tich" class="bg-result" value="<?php echo htmlspecialchars($dien_tich); ?>" readonly></td>
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