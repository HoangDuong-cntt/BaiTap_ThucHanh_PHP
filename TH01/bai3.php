<?php
$N = rand(-100, 100);
echo "Giá trị ngẫu nhiên N = $N <br><br>";
function isPrime($num)
{
    if ($num < 2) return false;
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) return false;
    }
    return true;
}
function isPerfectSquare($num)
{
    if ($num < 0) return false;
    $sq = sqrt($num);
    return ($sq == (int)$sq);
}
if ($N > 0) {
    echo "$N là số dương.<br><br>";
    echo "1. Các ước số của $N: ";
    for ($i = 1; $i <= $N; $i++) {
        if ($N % $i == 0) echo "$i ";
    }
    echo "<br><br>";
    echo "2. ";
    if (isPrime($N)) {
        echo "$N LÀ số nguyên tố.<br><br>";
    } else {
        echo "$N KHÔNG PHẢI là số nguyên tố.<br><br>";
    }
    $sumPrimes = 0;
    for ($i = 2; $i < $N; $i++) {
        if (isPrime($i)) {
            $sumPrimes += $i;
        }
    }
    echo "3. Tổng các số nguyên tố < $N là: $sumPrimes<br><br>";

    // 4. Kiểm tra N có là số chính phương không
    echo "4. ";
    if (isPerfectSquare($N)) {
        echo "$N LÀ số chính phương.<br>";
    } else {
        echo "$N KHÔNG PHẢI là số chính phương.<br>";
    }
} else {
    echo "$N KHÔNG phải là số dương.";
}
