<?php
$gio_bat_dau = isset($_POST['gio_bat_dau']) ? $_POST['gio_bat_dau'] : '';
$gio_ket_thuc = isset($_POST['gio_ket_thuc']) ? $_POST['gio_ket_thuc'] : '';
$tien_thanh_toan = '';

if (isset($_POST['tinh_tien'])) {
    if (is_numeric($gio_bat_dau) && is_numeric($gio_ket_thuc)) {
        if ($gio_ket_thuc <= $gio_bat_dau) {
            $tien_thanh_toan = "Giờ kết thúc phải > Giờ bắt đầu";
        } elseif ($gio_bat_dau < 10 || $gio_ket_thuc > 24) {
            $tien_thanh_toan = "Quán nghỉ từ 0h-10h sáng!";
        } else {
            // Khung 1: 10h - 17h (20.000 VNĐ/h)
            $gio_k1 = max(0, min(17, $gio_ket_thuc) - max(10, $gio_bat_dau));
            $tien_k1 = $gio_k1 * 20000;

            // Khung 2: 17h - 24h (45.000 VNĐ/h)
            $gio_k2 = max(0, min(24, $gio_ket_thuc) - max(17, $gio_bat_dau));
            $tien_k2 = $gio_k2 * 45000;

            $tien_thanh_toan = $tien_k1 + $tien_k2;
        }
    } else {
        $tien_thanh_toan = "Vui lòng nhập giờ hợp lệ!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 5 - Tính tiền Karaoke</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding-top: 30px; }
        table { background-color: #b2ebf2; margin: 0 auto; border-collapse: collapse; width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th { background-color: #00838f; color: white; padding: 12px; font-size: 18px; }
        td { padding: 8px 15px; }
        .bg-result { background-color: #fff9c4; }
        input[type="text"] { width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 3px; }
        input[type="submit"] { background-color: #e0e0e0; border: 1px solid #999; padding: 5px 15px; cursor: pointer; border-radius: 3px; font-weight: bold; }
        input[type="submit"]:hover { background-color: #ccc; }
        .unit { font-size: 13px; color: #555; }
    </style>
</head>
<body>
    <form action="" method="post" name="form_karaoke">
        <table border="0">
            <tr>
                <th colspan="3">TÍNH TIỀN KARAOKE</th>
            </tr>
            <tr>
                <td>Giờ bắt đầu:</td>
                <td><input type="text" name="gio_bat_dau" value="<?php echo htmlspecialchars($gio_bat_dau); ?>" required></td>
                <td class="unit">(h)</td>
            </tr>
            <tr>
                <td>Giờ kết thúc:</td>
                <td><input type="text" name="gio_ket_thuc" value="<?php echo htmlspecialchars($gio_ket_thuc); ?>" required></td>
                <td class="unit">(h)</td>
            </tr>
            <tr>
                <td>Tiền thanh toán:</td>
                <td><input type="text" name="tien_thanh_toan" class="bg-result" value="<?php echo htmlspecialchars($tien_thanh_toan); ?>" readonly></td>
                <td class="unit">(VNĐ)</td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <input type="submit" name="tinh_tien" value="Tính tiền">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
