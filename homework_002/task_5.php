<?php

$number1 = rand(0, 100000);
$number2 = rand(0, 100000);

if ($number1 % 3 === 0 && $number2 % 3 === 0) {
    $res = $number1 + $number2;
    echo "The sum of $number1 and $number2 is - $res";
}
elseif ($number2 != 0) {
    $res = ($number1 / $number2);
    echo "The result of division is - " . number_format($res, 2);
}
else {
    echo "Invalid input. The second number cannot be zero for division.";
}