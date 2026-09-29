<?php
$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
$address  = isset($_POST['address']) ? $_POST['address'] : '';
$phone    = isset($_POST['phone']) ? $_POST['phone'] : '';
$gender   = isset($_POST['gender']) ? $_POST['gender'] : '';
$country  = isset($_POST['country']) ? $_POST['country'] : '';
$study    = isset($_POST['study']) && is_array($_POST['study']) ? implode(', ', $_POST['study']) : '';
$note     = isset($_POST['note']) ? $_POST['note'] : '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Config - Kết quả nhập thông tin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 30px;
        }

        .box {
            width: 500px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #aaa;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        h4 {
            margin-top: 0;
            font-weight: normal;
            font-size: 16px;
            color: #333;
        }

        p {
            margin: 8px 0;
            line-height: 1.5;
            font-size: 15px;
        }

        .back-btn {
            margin-top: 15px;
            display: inline-block;
            padding: 6px 16px;
            background: #e0e0e0;
            border: 1px solid #999;
            color: #000;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #ccc;
        }
    </style>
</head>

<body>
    <div class="box">
        <h4><strong>Bạn đã nhập thành công, dưới đây là những thông tin bạn đã nhập:</strong></h4>
        <p><strong>Họ tên:</strong> <?php echo htmlspecialchars($fullname); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
        <p><strong>Country:</strong> <?php echo htmlspecialchars($country); ?></p>
        <?php if (!empty($study)): ?>
            <p><strong>Study:</strong> <?php echo htmlspecialchars($study); ?></p>
        <?php endif; ?>
        <p><strong>Note:</strong> <?php echo nl2br(htmlspecialchars($note)); ?></p>

        <a href="javascript:window.history.back(-1);" class="back-btn">Quay về</a>
    </div>
</body>

</html>