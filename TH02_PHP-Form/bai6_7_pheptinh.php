<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 6 & 7 - Phép tính trên 2 số</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding-top: 30px; }
        table { background-color: #e3f2fd; margin: 0 auto; border-collapse: collapse; width: 420px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th { background-color: #1976d2; color: white; padding: 12px; font-size: 18px; }
        td { padding: 10px 15px; }
        .radio-group { color: #d32f2f; font-weight: bold; }
        input[type="text"] { width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 3px; }
        input[type="submit"] { background-color: #e0e0e0; border: 1px solid #999; padding: 5px 15px; cursor: pointer; border-radius: 3px; font-weight: bold; }
        input[type="submit"]:hover { background-color: #ccc; }
    </style>
</head>
<body>
    <form action="bai6_7_ketqua.php" method="post" name="form_pheptinh">
        <table border="0">
            <tr>
                <th colspan="2">PHÉP TÍNH TRÊN HAI SỐ</th>
            </tr>
            <tr>
                <td><strong>Chọn phép tính:</strong></td>
                <td class="radio-group">
                    <input type="radio" name="phep_tinh" value="cong" checked> Cộng
                    <input type="radio" name="phep_tinh" value="tru"> Trừ
                    <input type="radio" name="phep_tinh" value="nhan"> Nhân
                    <input type="radio" name="phep_tinh" value="chia"> Chia
                </td>
            </tr>
            <tr>
                <td>Số thứ nhất:</td>
                <td><input type="text" name="so1" required></td>
            </tr>
            <tr>
                <td>Số thứ hai:</td>
                <td><input type="text" name="so2" required></td>
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
