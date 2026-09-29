<?php
$toan = isset($_POST['toan']) ? $_POST['toan'] : '';
$ly = isset($_POST['ly']) ? $_POST['ly'] : '';
$hoa = isset($_POST['hoa']) ? $_POST['hoa'] : '';
$diem_chuan = isset($_POST['diem_chuan']) ? $_POST['diem_chuan'] : '20';
$tong_diem = '';
$ket_qua_thi = '';

if (isset($_POST['xem_ket_qua'])) {
    if (is_numeric($toan) && is_numeric($ly) && is_numeric($hoa) && is_numeric($diem_chuan)) {
        $tong_diem = $toan + $ly + $hoa;
        if ($toan > 0 && $ly > 0 && $hoa > 0 && $tong_diem >= $diem_chuan) {
            $ket_qua_thi = "Đậu";
        } else {
            $ket_qua_thi = "Rớt";
        }
    } else {
        $tong_diem = "Dữ liệu không hợp lệ!";
        $ket_qua_thi = "Vui lòng nhập điểm hợp lệ";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 4 - Kết quả thi đại học</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding-top: 30px; }
        table { background-color: #f8bbd0; margin: 0 auto; border-collapse: collapse; width: 380px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th { background-color: #c2185b; color: white; padding: 12px; font-size: 18px; }
        td { padding: 8px 15px; }
        .bg-result { background-color: #fff9c4; }
        input[type="text"] { width: 95%; padding: 5px; border: 1px solid #ccc; border-radius: 3px; }
        input[type="submit"] { background-color: #e0e0e0; border: 1px solid #999; padding: 5px 15px; cursor: pointer; border-radius: 3px; font-weight: bold; }
        input[type="submit"]:hover { background-color: #ccc; }
    </style>
</head>
<body>
    <form action="" method="post" name="form_ketquathi">
        <table border="0">
            <tr>
                <th colspan="2">KẾT QUẢ THI ĐẠI HỌC</th>
            </tr>
            <tr>
                <td>Toán:</td>
                <td><input type="text" name="toan" value="<?php echo htmlspecialchars($toan); ?>" required></td>
            </tr>
            <tr>
                <td>Lý:</td>
                <td><input type="text" name="ly" value="<?php echo htmlspecialchars($ly); ?>" required></td>
            </tr>
            <tr>
                <td>Hóa:</td>
                <td><input type="text" name="hoa" value="<?php echo htmlspecialchars($hoa); ?>" required></td>
            </tr>
            <tr>
                <td>Điểm chuẩn:</td>
                <td><input type="text" name="diem_chuan" value="<?php echo htmlspecialchars($diem_chuan); ?>" required></td>
            </tr>
            <tr>
                <td>Tổng điểm:</td>
                <td><input type="text" name="tong_diem" class="bg-result" value="<?php echo htmlspecialchars($tong_diem); ?>" readonly></td>
            </tr>
            <tr>
                <td>Kết quả thi:</td>
                <td><input type="text" name="ket_qua_thi" class="bg-result" value="<?php echo htmlspecialchars($ket_qua_thi); ?>" readonly></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="xem_ket_qua" value="Xem kết quả">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
