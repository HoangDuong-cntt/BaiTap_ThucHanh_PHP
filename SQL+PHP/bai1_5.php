<?php
$host     = 'localhost';
$username = 'root';
$password = '';

// Tự động tìm CSDL phù hợp
$candidateDbs = ['quanlibansua', 'quanly_ban_sua', 'ql_ban_sua', 'QL_BAN_SUA'];
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
        // Thử database tiếp theo
    }
}
$queries = [
    1  => "SELECT hang_sua.Ten_hang_sua, COUNT(sua.Ma_sua) 
    AS Tong_so_san_pham 
    FROM hang_sua 
    JOIN sua 
    ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua 
    GROUP BY hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua 
    ORDER BY Tong_so_san_pham ASC",

    2  => "SELECT hang_sua.Ten_hang_sua, AVG(sua.Don_gia) 
    AS Don_gia_trung_binh 
    FROM hang_sua 
    JOIN sua 
    ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua 
    WHERE sua.Trong_luong 
    IN (800, 900) 
    GROUP BY hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua",

    3  => "SELECT hang_sua.Ten_hang_sua, MIN(sua.Trong_luong) 
    AS Trong_luong_nho_nhat, MAX(sua.Trong_luong) 
    AS Trong_luong_lon_nhat 
    FROM hang_sua 
    JOIN sua 
    ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua 
    GROUP BY hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua",

    4  => "SELECT hang_sua.Ten_hang_sua, SUM(sua.Don_gia) 
    AS Tong_gia_tien, COUNT(sua.Ma_sua) 
    AS So_san_pham 
    FROM hang_sua 
    JOIN sua 
    ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua 
    WHERE sua.Trong_luong 
    BETWEEN 400 AND 500 
    GROUP BY hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua",

    5  => "SELECT hoa_don.So_hoa_don, hoa_don.Ngay_HD, SUM(ct_hoadon.So_luong) 
    AS Tong_so_luong, SUM(ct_hoadon.So_luong * ct_hoadon.Don_gia) 
    AS Tong_thanh_tien 
    FROM hoa_don 
    JOIN ct_hoadon 
    ON hoa_don.So_hoa_don = ct_hoadon.So_hoa_don 
    GROUP BY hoa_don.So_hoa_don, hoa_don.Ngay_HD",

    6  => "SELECT hoa_don.So_hoa_don, hoa_don.Ngay_HD, hoa_don.Ma_khach_hang, SUM(ct_hoadon.So_luong * ct_hoadon.Don_gia) 
    AS Tong_tri_gia 
    FROM hoa_don 
    JOIN ct_hoadon 
    ON hoa_don.So_hoa_don = ct_hoadon.So_hoa_don 
    GROUP BY hoa_don.So_hoa_don, hoa_don.Ngay_HD, hoa_don.Ma_khach_hang 
    HAVING Tong_tri_gia > 2000000",

    7  => "SELECT loai_sua.Ten_loai, COUNT(sua.Ma_sua) 
    AS Tong_so_san_pham 
    FROM loai_sua 
    JOIN sua 
    ON loai_sua.Ma_loai_sua = sua.Ma_loai_sua 
    GROUP BY loai_sua.Ma_loai_sua, loai_sua.Ten_loai",

    8  => "SELECT hang_sua.Ten_hang_sua, MAX(sua.Don_gia) 
    AS Don_gia_cao_nhat 
    FROM hang_sua 
    JOIN sua 
    ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua 
    GROUP BY hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua",

    9  => "SELECT sua.Ma_sua, sua.Ten_sua, SUM(ct_hoadon.So_luong) 
    AS So_luong_ban 
    FROM sua 
    JOIN ct_hoadon 
    ON sua.Ma_sua = ct_hoadon.Ma_sua 
    JOIN hoa_don 
    ON ct_hoadon.So_hoa_don = hoa_don.So_hoa_don 
    WHERE MONTH(hoa_don.Ngay_HD) = 8 
    AND YEAR(hoa_don.Ngay_HD) = 2007 
    GROUP BY sua.Ma_sua, sua.Ten_sua",

    10 => "SELECT hang_sua.Ten_hang_sua, hang_sua.Dia_chi, hang_sua.Dien_thoai 
    FROM hang_sua 
    JOIN sua 
    ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua 
    GROUP BY hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua, hang_sua.Dia_chi, hang_sua.Dien_thoai 
    HAVING MIN(sua.Don_gia) >= 50000",

    11 => "SELECT hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua, COUNT(sua.Ma_sua) 
    AS So_san_pham 
    FROM hang_sua 
    JOIN sua 
    ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua 
    GROUP BY hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua 
    HAVING COUNT(sua.Ma_sua) > 10",

    12 => "SELECT hang_sua.Ten_hang_sua, COUNT(sua.Ma_sua) 
    AS So_san_pham, 
    CASE WHEN COUNT(sua.Ma_sua) < 5 
    THEN 'Có ít sản phẩm' 
    WHEN COUNT(sua.Ma_sua) 
    BETWEEN 5 AND 10 
    THEN 'Có khá nhiều sản phẩm' 
    ELSE 'Có rất nhiều sản phẩm' 
    END AS Ghi_chu 
    FROM hang_sua 
    JOIN sua 
    ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua 
    GROUP BY hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua",

    13 => "SELECT hang_sua.Ten_hang_sua, SUM(ct_hoadon.So_luong) 
    AS Tong_so_luong_ban 
    FROM hang_sua 
    JOIN sua 
    ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua 
    JOIN ct_hoadon 
    ON sua.Ma_sua = ct_hoadon.Ma_sua 
    JOIN hoa_don 
    ON ct_hoadon.So_hoa_don = hoa_don.So_hoa_don 
    WHERE (hang_sua.Ma_hang_sua = 'AB' 
    OR hang_sua.Ten_hang_sua = 'Abbott') 
    AND (MONTH(hoa_don.Ngay_HD) 
    IN (7, 8) 
    AND YEAR(hoa_don.Ngay_HD) = 2007) 
    GROUP BY hang_sua.Ma_hang_sua, hang_sua.Ten_hang_sua",
];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 1.5: Truy vấn có nhóm và thống kê dữ liệu (Câu 1 - 13)</title>
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

    <h1>BÀI 1.5: TRUY VẤN CÓ NHÓM VÀ THỐNG KÊ DỮ LIỆU</h1>

    <?php if (!$pdo): ?>
        <p style="color: red;">Không thể kết nối đến MySQL. Vui lòng kiểm tra lại MySQL trong XAMPP.</p>
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