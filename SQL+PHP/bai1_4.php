<?php
$host     = 'localhost';
$username = 'root';
$password = '';
$candidateDbs = ['quanlibansua'];
$pdo = null;

foreach ($candidateDbs as $db) {
    try {
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        break;
    } catch (PDOException $e) {
    }
}
$queries = [
    1 => "SELECT ROUND(AVG(Tri_gia), -3) 
    AS Tri_gia_trung_binh 
    FROM hoa_don",

    2 => "SELECT So_hoa_don, Ngay_HD, Ma_khach_hang, Tri_gia 
    FROM hoa_don 
    WHERE MONTH(Ngay_HD) = 7 
    AND YEAR(Ngay_HD) = 2007",

    3 => "SELECT So_hoa_don, Ngay_HD, Ma_khach_hang, Tri_gia, DATEDIFF(CURDATE(), Ngay_HD) 
    AS So_ngay 
    FROM hoa_don 
    ORDER BY So_ngay DESC",

    4 => "SELECT Ma_sua, Ten_sua, Trong_luong, Don_gia 
    FROM sua 
    WHERE LENGTH(Ten_sua) <= 10",

    5 => "SELECT UPPER(Ten_hang_sua)
    AS Ten_hang_sua, Dia_chi, Dien_thoai
    FROM hang-sua",

    6 => "SELECT So_hoa_don
    DATE_FORMAT(Ngay_HD, %W - %d - %m - %Y)
    AS Ngay_dinh_dang, Ma_khach_hang, Tri_gia
    FROM hoa_don",

    7 => "SELECT DISTINCT sua.Ten_sua, CONCAT(sua.Trong_luong, ' gr') 
    AS Trong_luong, CONCAT(FORMAT(sua.Don_gia, 0), ' VNĐ') 
    AS Don_gia 
    FROM sua 
    JOIN ct_hoadon 
    ON sua.Ma_sua = ct_hoadon.Ma_sua 
    JOIN hoa_don 
    ON ct_hoadon.So_hoa_don = hoa_don.So_hoa_don 
    WHERE MONTH(hoa_don.Ngay_HD) = 8 
    AND YEAR(hoa_don.Ngay_HD) = 2007",

    8 => "SELECT CONCAT(Ma_khach_hang, ' - ', Ten_khach_hang) 
    AS ma_ten_KH, 
    IF(Phai = 0, 'Nam', 'Nữ') 
    AS Phai, Dia_chi, Dien_thoai 
    FROM khach_hang",

    9 => "SELECT Ten_sua, Trong_luong, Don_gia, 
    IF(Don_gia > 100000, 'Sữa giá cao', 'Sữa giá trung bình') 
    AS Danh_gia 
    FROM sua 
    WHERE Trong_luong 
    BETWEEN 400 AND 500",

    10 => "SELECT So_hoa_don, CONCAT(CASE DAYOFWEEK(Ngay_HD)
     WHEN 1 THEN 'Chủ nhật' 
     WHEN 2 THEN 'Thứ hai' 
     WHEN 3 THEN 'Thứ ba'
      WHEN 4 THEN 'Thứ tư' 
      WHEN 5 THEN 'Thứ năm' 
      WHEN 6 THEN 'Thứ sáu' 
      WHEN 7 THEN 'Thứ bảy' 
      END, ' ngày ', DAY(Ngay_HD), ' tháng ', MONTH(Ngay_HD), ' năm ', YEAR(Ngay_HD)) 
      AS Ngay_dinh_dang, Ma_khach_hang, Tri_gia 
      FROM hoa_don 
      ORDER BY Ngay_HD ASC",

    11 => "SELECT SUM(IF(Phai = 0, 1, 0)) 
    AS So_khach_hang_nam, SUM(IF(Phai = 1, 1, 0)) 
    AS So_khach_hang_nu, COUNT(*) 
    AS Tong_so_khach_hang 
    FROM khach_hang",
];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 1.4: Sử dụng hàm và biểu thức cho sẵn trong truy vấn dữ liệu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        h3 {
            margin-top: 25px;
            margin-bottom: 5px;
        }

        p {
            margin: 4px 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 8px;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>BÀI 1.4: SỬ DỤNG HÀM VÀ BIỂU THỨC CHO SẴN TRONG TRUY VẤN DỮ LIỆU</h1>

    <?php if (!$pdo): ?>
        <p style="color: red;">Không thể kết nối đến MySQL XAMPP.</p>
    <?php endif; ?>

    <?php foreach ($queries as $num => $sql): ?>
        <div>
            <h3>Câu <?= $num ?></h3>
            <?php
            $rows = [];
            if ($pdo) {
                try {
                    $stmt = $pdo->query($sql);
                    $rows = $stmt->fetchAll();
                } catch (PDOException $e) {
                    echo "<p>Lỗi truy vấn: " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            }
            ?>

            <?php if (!empty($rows)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <?php foreach (array_keys($rows[0]) as $col): ?>
                                <th><?= htmlspecialchars($col) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $index => $row): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <?php foreach ($row as $col => $val): ?>
                                    <td><?= htmlspecialchars($val ?? '') ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php elseif ($pdo): ?>
                <p><em>(Không có dòng dữ liệu nào)</em></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

</body>

</html>