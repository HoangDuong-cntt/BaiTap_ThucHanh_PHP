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
//  truy vấn
$queries = [
    1  => "SELECT Ten_hang_sua, Dia_chi, Dien_thoai
     FROM hang_sua",
    2  => "SELECT Ten_khach_hang, Dia_chi, Dien_thoai 
    FROM khach_hang 
    ORDER BY Ten_khach_hang ASC",
    3  => "SELECT Ten_khach_hang, Phai, Dia_chi, Dien_thoai 
    FROM khach_hang 
    ORDER BY Phai ASC, Ten_khach_hang ASC",
    4  => "SELECT Ten_sua, Trong_luong, Don_gia
     FROM sua 
     ORDER BY Ten_sua ASC, Don_gia DESC",
    5  => "SELECT Ten_sua, Trong_luong, Don_gia, TP_Dinh_Duong 
    FROM sua 
    WHERE Ten_sua 
    LIKE 'S%'",
    6  => "SELECT Ma_hang_sua, Ten_hang_sua, Dia_chi, Dien_thoai 
    FROM hang_sua 
    WHERE Ma_hang_sua LIKE '%M'",
    7  => "SELECT Ma_sua, Ten_sua, Trong_luong, Don_gia, TP_Dinh_Duong, Loi_ich 
    FROM sua 
    WHERE Ten_sua LIKE '%grow%'",
    8  => "SELECT Ten_sua, Don_gia, Trong_luong
     FROM sua 
     WHERE Don_gia > 100000 
     ORDER BY Ten_sua DESC",
    9  => "SELECT Ten_sua, TP_Dinh_Duong, Loi_ich 
    FROM sua 
    WHERE Ma_loai_sua = 'SC' 
    AND Ma_hang_sua = 'VNM' 
    ORDER BY Ten_sua ASC",
    10 => "SELECT Ma_sua, Ten_sua, Ma_hang_sua, Trong_luong, Don_gia 
    FROM sua 
    WHERE Trong_luong >= 900 OR Ma_hang_sua = 'DS'",
    11 => "SELECT Ma_sua, Ten_sua, Trong_luong, Don_gia 
    FROM sua 
    WHERE Don_gia 
    BETWEEN 100000 AND 150000",
    12 => "SELECT Ma_sua, Ten_sua, Ma_hang_sua, Trong_luong, Don_gia 
    FROM sua 
    WHERE Ma_hang_sua 
    IN ('DM', 'DL', 'DS') 
    AND Trong_luong >= 800 
    ORDER BY Trong_luong ASC",
    13 => "SELECT Ma_sua, Ten_sua, Ma_loai_sua, Trong_luong, Don_gia 
    FROM sua 
    WHERE Ma_loai_sua = 'SD' OR Don_gia <= 12000",
    14 => "SELECT Ma_khach_hang, Ten_khach_hang, Phai, Dia_chi, Dien_thoai, Email 
    FROM khach_hang 
    WHERE Phai = 0 
    AND Ten_khach_hang LIKE 'N%'",
    15 => "SELECT Ma_hang_sua, Ten_hang_sua 
    FROM hang_sua 
    WHERE Ma_hang_sua NOT LIKE '%M%'",
    16 => "SELECT Ten_sua, TP_Dinh_Duong 
    FROM sua 
    WHERE TP_Dinh_Duong 
    LIKE '%canxi%' AND TP_Dinh_Duong LIKE '%vitamin%'",
    17 => "SELECT Ma_sua, Ten_sua, Trong_luong, Don_gia 
    FROM sua 
    WHERE Trong_luong IN (180, 200, 900)",
    18 => "SELECT Ma_sua, Ten_sua, Trong_luong, Don_gia 
    FROM sua
     WHERE Trong_luong NOT IN (400, 800, 900)",
    19 => "SELECT Ten_sua, Don_gia, TP_Dinh_Duong 
    FROM sua 
    ORDER BY Don_gia DESC LIMIT 10",
    20 => "SELECT sua.Ten_sua, sua.Trong_luong 
    FROM sua 
    JOIN hang_sua 
    ON sua.Ma_hang_sua = hang_sua.Ma_hang_sua 
    WHERE hang_sua.Ten_hang_sua = 'Vinamilk' 
    ORDER BY sua.Trong_luong DESC LIMIT 3",
    21 => "SELECT sua.Ten_sua, sua.Loi_ich, sua.Don_gia 
    FROM sua 
    JOIN hang_sua 
    ON sua.Ma_hang_sua = hang_sua.Ma_hang_sua 
    WHERE hang_sua.Ten_hang_sua = 'Vinamilk' 
    ORDER BY sua.Don_gia DESC",
    22 => "SELECT sua.Ten_sua, sua.Trong_luong, sua.Loi_ich 
    FROM sua 
    JOIN hang_sua 
    ON sua.Ma_hang_sua = hang_sua.Ma_hang_sua 
    WHERE hang_sua.Ten_hang_sua = 'Abbott' 
    ORDER BY sua.Trong_luong ASC",
];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 1.3: Truy vấn lọc và sắp xếp dữ liệu</title>
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

    <h1>BÀI 1.3: TRUY VẤN LỌC VÀ SẮP XẾP DỮ LIỆU</h1>

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
                                    <td>
                                        <?php
                                        if ($col === 'Phai') {
                                            echo ($val == 0) ? 'Nam' : 'Nữ';
                                        } else {
                                            echo htmlspecialchars($val ?? '');
                                        }
                                        ?>
                                    </td>
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