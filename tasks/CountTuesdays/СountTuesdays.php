<?php

/**
 * task 3
 */
try {
    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
        echo сountTuesdays($_GET['start_date'], $_GET['end_date'], 'Tuesday');
    } else {
        throw new Exception('Date error!');
    }
} catch (Exception $e) {
    echo 'Error!: ' . $e->getMessage();
}

/**
 * Подсчёт дней недели (в нашем случае вторников)
 * @param string $startDate
 * @param string $endDate
 * @param string $day
 * @return int
 * @throws Exception
 */
function сountTuesdays(string $startDate, string $endDate, string $day): int
{
    // DateTime, с которыми будем работать
    $startDate = date_create($startDate);
    $endDate = date_create($endDate . ' 23:59:59');

    if ($startDate > $endDate) {
        throw new Exception('End date must be later than start date!');
    }

    // closest Tuesday
    $closestTuesday = $startDate->modify($day);

    // days between Tuesday and end date
    $diffInDays = $endDate->diff($closestTuesday)->days;

    // result
    return (int)($diffInDays / 7) + 1;
}