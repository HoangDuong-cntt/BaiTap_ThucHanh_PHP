<?php
//Tạo số tự nhiên N ngẫu nhiên từ 1 đến 100
$N = rand(1, 100);

echo "Giá trị ngẫu nhiên N = " . $N . "<br><br>";
echo "Các số chẵn trong khoảng từ 1 đến " . $N . " là:<br>";

// Vòng lặp kiểm tra và xuất các số chẵn
for ($i = 1; $i <= $N; $i++) {
    if ($i % 2 == 0) {
        echo $i . " ";
    }
}
