<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 7 - Năm âm lịch</title>
</head>

<body>
    <h2>TÍNH NĂM ÂM LỊCH</h2>

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
        Năm dương lịch:
        <input type="text" name="nam" size="10" required
            value="<?php echo htmlspecialchars($nam_dl); ?>">

        <input type="submit" name="tinh" value="=>">

        Năm âm lịch:
        <input type="text" size="15" readonly
            value="<?php echo htmlspecialchars($nam_al); ?>">

        <br><br>
        <?php echo $hinh_anh; ?>
    </form>
</body>

</html>