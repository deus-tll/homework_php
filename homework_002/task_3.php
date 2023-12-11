<?php

$monthNumber = rand(1, 12);

$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthNumber, date("Y"));

echo "Number of days in a month $monthNumber - $daysInMonth";