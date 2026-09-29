<?php
// Bài 7: Hàm kiểm tra hợp lệ của dữ liệu nhập vào
function kiemTraHopLe($so1, $so2, $phep_tinh, &$thong_bao_loi) {
    if (!is_numeric($so1) || !is_numeric($so2)) {
        $thong_bao_loi = "Dữ liệu nhập vào phải là số!";
        return false;
    }
    if ($phep_tinh == 'chia' && floatval($so2) == 0) {
        $thong_bao_loi = "Không thể thực hiện phép chia cho 0!";
        return false;
    }
    return true;
}

$so1 = isset($_POST['so1']) ? trim($_POST['so1']) : '';
$so2 = isset($_POST['so2']) ? trim($_POST['so2']) : '';
$phep_tinh = isset($_POST['phep_tinh']) ? $_POST['phep_tinh'] : 'cong';

$ten_phep_tinh = '';
switch ($phep_tinh) {
    case 'cong': $ten_phep_tinh = 'Cộng'; break;
    case 'tru':  $ten_phep_tinh = 'Trừ'; break;
    case 'nhan': $ten_phep_tinh = 'Nhân'; break;
    case 'chia': $ten_phep_tinh = 'Chia'; break;
}

$thong_bao_loi = '';
$ket_qua = '';

if (isset($_POST['tinh'])) {
    if (kiemTraHopLe($so1, $so2, $phep_tinh, $thong_bao_loi)) {
        $val1 = floatval($so1);
        $val2 = floatval($so2);
        switch ($phep_tinh) {
            case 'cong': $ket_qua = $val1 + $val2; break;
            case 'tru':  $ket_qua = $val1 - $val2; break;
            case 'nhan': $ket_qua = $val1 * $val2; break;
            case 'chia': $ket_qua = $val1 / $val2; break;
        }
    }
} else {
    $thong_bao_loi = "Không có dữ liệu gửi tới!";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 6 & 7 - Trang Kết Quả Phép Tính</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding-top: 30px; }
        table { background-color: #e3f2fd; margin: 0 auto; border-collapse: collapse; width: 420px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th { background-color: #1976d2; color: white; padding: 12px; font-size: 18px; }
        td { padding: 10px 15px; }
        .highlight { color: #d32f2f; font-weight: bold; }
        .error { color: #c62828; font-weight: bold; text-align: center; }
        input[type="text"] { width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 3px; }
        .back-link { text-align: center; margin-top: 10px; }
        .back-link a { color: #8e24aa; font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>
    <table border="0">
        <tr>
            <th colspan="2">PHÉP TÍNH TRÊN HAI SỐ</th>
        </tr>
        <?php if (!empty($thong_bao_loi)): ?>
            <tr>
                <td colspan="2" class="error">
                    <br>
                    <?php echo $thong_bao_loi; ?>
                    <br><br>
                </td>
            </tr>
        <?php else: ?>
            <tr>
                <td><strong>Chọn phép tính:</strong></td>
                <td class="highlight"><?php echo $ten_phep_tinh; ?></td>
            </tr>
            <tr>
                <td>Số 1:</td>
                <td><input type="text" value="<?php echo htmlspecialchars($so1); ?>" readonly></td>
            </tr>
            <tr>
                <td>Số 2:</td>
                <td><input type="text" value="<?php echo htmlspecialchars($so2); ?>" readonly></td>
            </tr>
            <tr>
                <td>Kết quả:</td>
                <td><input type="text" value="<?php echo htmlspecialchars($ket_qua); ?>" readonly></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="2" align="center">
                <div class="back-link">
                    <a href="javascript:window.history.back(-1);">Trở về trang trước</a>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
