<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'trangchu';

$valid_pages = [
    'trangchu'  => 'trangchu.php',
    'gioithieu' => 'gioithieu.php',
    'tintuc'    => 'tintuc.php',
    'lienhe'    => 'lienhe.php',
    'diendan'   => 'diendan.php'
];

$file_to_include = isset($valid_pages[$page]) ? $valid_pages[$page] : 'trangchu.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 9 - Trang chủ với Menu chính</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { width: 800px; margin: 30px auto; background-color: #fff; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 5px; overflow: hidden; }
        header { background-color: #008080; color: white; text-align: center; padding: 15px; }
        header h1 { margin: 0; font-size: 24px; }
        nav { background-color: #333; overflow: hidden; }
        nav a { float: left; display: block; color: white; text-align: center; padding: 12px 20px; text-decoration: none; font-weight: bold; }
        nav a:hover, nav a.active { background-color: #008080; }
        main { padding: 30px; min-height: 220px; line-height: 1.6; font-size: 16px; }
        footer { background-color: #eee; text-align: center; padding: 12px; font-size: 14px; border-top: 1px solid #ccc; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>WEBSITE DEMO PHP MENU</h1>
        </header>
        <nav>
            <a href="index.php?page=trangchu" class="<?php echo $page=='trangchu'?'active':''; ?>">Trang chủ</a>
            <a href="index.php?page=gioithieu" class="<?php echo $page=='gioithieu'?'active':''; ?>">Giới thiệu</a>
            <a href="index.php?page=tintuc" class="<?php echo $page=='tintuc'?'active':''; ?>">Tin tức</a>
            <a href="index.php?page=lienhe" class="<?php echo $page=='lienhe'?'active':''; ?>">Liên hệ</a>
            <a href="index.php?page=diendan" class="<?php echo $page=='diendan'?'active':''; ?>">Diễn đàn</a>
        </nav>
        <main>
            <?php
            if (file_exists($file_to_include)) {
                include($file_to_include);
            } else {
                echo "<p style='color:red;'>Trang không tồn tại!</p>";
            }
            ?>
        </main>
        <footer>
            &copy; 2026 Thực hành Phát triển phần mềm mã nguồn mở
        </footer>
    </div>
</body>
</html>
