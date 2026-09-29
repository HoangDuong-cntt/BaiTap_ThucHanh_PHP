<?php
$ten_chu_ho = isset($_POST['ten_chu_ho']) ? $_POST['ten_chu_ho'] : '';
$chi_so_cu = isset($_POST['chi_so_cu']) ? $_POST['chi_so_cu'] : '';
$chi_so_moi = isset($_POST['chi_so_moi']) ? $_POST['chi_so_moi'] : '';
$don_gia = isset($_POST['don_gia']) ? $_POST['don_gia'] : '20000';
$so_tien_thanh_toan = '';

if (isset($_POST['tinh'])) {
    if (is_numeric($chi_so_cu) && is_numeric($chi_so_moi) && is_numeric($don_gia)) {
        if ($chi_so_moi >= $chi_so_cu) {
            $so_tien_thanh_toan = ($chi_so_moi - $chi_so_cu) * $don_gia;
        } else {
            $so_tien_thanh_toan = "Chỉ số mới phải >= Chỉ số cũ!";
        }
    } else {
        $so_tien_thanh_toan = "Vui lòng nhập đầy đủ chỉ số hợp lệ!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 3 - Thanh toán tiền điện</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding-top: 30px; }
        table { background-color: #ffe0b2; margin: 0 auto; border-collapse: collapse; width: 420px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th { background-color: #e65100; color: white; padding: 12px; font-size: 18px; }
        td { padding: 8px 15px; }
        .bg-result { background-color: #ffcdd2; }
        input[type="text"] { width: 95%; padding: 5px; border: 1px solid #ccc; border-radius: 3px; }
        input[type="submit"] { background-color: #e0e0e0; border: 1px solid #999; padding: 5px 15px; cursor: pointer; border-radius: 3px; font-weight: bold; }
        input[type="submit"]:hover { background-color: #ccc; }
        .unit { font-size: 13px; color: #555; }
    </style>
</head>
<body>
    <form action="" method="post" name="form_tiendien">
        <table border="0">
            <tr>
                <th colspan="3">THANH TOÁN TIỀN ĐIỆN</th>
            </tr>
            <tr>
                <td>Tên chủ hộ:</td>
                <td colspan="2"><input type="text" name="ten_chu_ho" value="<?php echo htmlspecialchars($ten_chu_ho); ?>" required></td>
            </tr>
            <tr>
                <td>Chỉ số cũ:</td>
                <td><input type="text" name="chi_so_cu" value="<?php echo htmlspecialchars($chi_so_cu); ?>" required></td>
                <td class="unit">(Kw)</td>
            </tr>
            <tr>
                <td>Chỉ số mới:</td>
                <td><input type="text" name="chi_so_moi" value="<?php echo htmlspecialchars($chi_so_moi); ?>" required></td>
                <td class="unit">(Kw)</td>
            </tr>
            <tr>
                <td>Đơn giá:</td>
                <td><input type="text" name="don_gia" value="<?php echo htmlspecialchars($don_gia); ?>" required></td>
                <td class="unit">(VNĐ)</td>
            </tr>
            <tr>
                <td>Số tiền thanh toán:</td>
                <td><input type="text" name="so_tien_thanh_toan" class="bg-result" value="<?php echo htmlspecialchars($so_tien_thanh_toan); ?>" readonly></td>
                <td class="unit">(VNĐ)</td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <input type="submit" name="tinh" value="Tính">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
