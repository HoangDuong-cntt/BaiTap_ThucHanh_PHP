<?php
$host     = 'localhost';
$dbname   = 'quanlibansua';
$username = 'root'; // Mặc định của XAMPP / Laragon
$password = '';     // Mặc định của XAMPP để trống (nếu có mật khẩu hãy điền vào)

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}
$stmtTables = $pdo->query("SHOW TABLES");
$tables = $stmtTables->fetchAll(PDO::FETCH_COLUMN);

// Truy vấn danh sách khách hàng có số điện thoại là số chẵn
$sqlChan = "SELECT Ma_khach_hang, Ten_khach_hang, Phai, Dia_chi, Dien_thoai, Email 
            FROM khach_hang 
            WHERE RIGHT(Dien_thoai, 1) IN ('0', '2', '4', '6', '8')";
$stmtChan = $pdo->query($sqlChan);
$khachHangChan = $stmtChan->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Bán Sữa - Hiển Thị Cơ Sở Dữ Liệu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f6f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 30px;
        }

        .table-card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 35px;
        }

        .table-title {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 8px;
            margin-top: 0;
            text-transform: uppercase;
            font-size: 18px;
        }

        .responsive-table {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 10px 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            white-space: nowrap;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        .empty-msg {
            color: #888;
            font-style: italic;
        }
    </style>
</head>

<body>

    <h1>HỆ THỐNG QUẢN LÝ BÁN SỮA</h1>
    // SỐ ĐIỆN THOẠI LÀ SỐ CHẴN
    <p style="margin-top: 5px; color: #666; font-size: 13px;">
        Truy vấn: <code>SELECT * FROM khach_hang WHERE RIGHT(Dien_thoai, 1) IN ('0', '2', '4', '6', '8')</code>
    </p>

    <?php if (!empty($khachHangChan)): ?>
        <div class="responsive-table">
            <table>
                <thead>
                    <tr>
                        <th style="background-color: #3498db;">Mã KH</th>
                        <th style="background-color: #e67e22;">Tên khách hàng</th>
                        <th style="background-color: #e67e22;">Phái</th>
                        <th style="background-color: #e67e22;">Địa chỉ</th>
                        <th style="background-color: #e67e22;">Điện thoại</th>
                        <th style="background-color: #e67e22;">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($khachHangChan as $kh): ?>
                        <tr>
                            <td><?= htmlspecialchars($kh['Ma_khach_hang']) ?></td>
                            <td><strong><?= htmlspecialchars($kh['Ten_khach_hang']) ?></strong></td>
                            <td><?= ($kh['Phai'] == 1) ? '<span style="color: #e84393; font-weight: bold;">Nữ</span>' : '<span style="color: #0984e3; font-weight: bold;">Nam</span>' ?></td>
                            <td><?= htmlspecialchars($kh['Dia_chi']) ?></td>
                            <td>
                                <span style="background: #eafaf1; color: #27ae60; font-weight: bold; padding: 2px 6px; border-radius: 4px; border: 1px solid #a9dfbf;">
                                    <?= htmlspecialchars($kh['Dien_thoai']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($kh['Email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p style="margin-top: 10px; font-size: 13px; color: #27ae60; font-weight: bold;">
            ✓ Tìm thấy <?= count($khachHangChan) ?> khách hàng có số điện thoại chẵn.
        </p>
    <?php else: ?>
        <p class="empty-msg">Không tìm thấy khách hàng nào có số điện thoại chẵn.</p>
    <?php endif; ?>
    </div>

    <?php if (empty($tables)): ?>
        <p class="empty-msg">Không tìm thấy bảng nào trong cơ sở dữ liệu '<?= htmlspecialchars($dbname) ?>'.</p>
    <?php else: ?>
        <?php foreach ($tables as $table): ?><div class="table-card">
                <h2 class="table-title">📌 Bảng: <?= htmlspecialchars($table) ?></h2>

                <?php
                // Truy vấn lấy dữ liệu từ từng bảng
                $stmt = $pdo->query("SELECT * FROM `$table`");
                $rows = $stmt->fetchAll();
                ?>

                <?php if (!empty($rows)): ?>
                    <div class="responsive-table">
                        <table>
                            <thead>
                                <tr>
                                    <?php
                                    // Lấy tên các cột từ tiêu đề dòng dữ liệu đầu tiên
                                    $columns = array_keys($rows[0]);
                                    foreach ($columns as $col):
                                    ?>
                                        <th><?= htmlspecialchars($col) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <?php foreach ($row as $value): ?>
                                            <td><?= htmlspecialchars($value ?? '') ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="empty-msg">Bảng này hiện chưa có dữ liệu.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>