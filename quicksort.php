<?php

function quicksort($numbers)
{
    if (count($numbers) < 2) {
        return $numbers;
    }
    $left = [];
    $right = [];
    reset($numbers);
    $pivot = array_shift($numbers);

    foreach ($numbers as $k => $v) {
        if ($v < $pivot) {
            $left[$k] = $v;
        } else {
            $right[$k] = $v;
        }
    }
    return array_merge(quicksort($left), [$pivot], quicksort($right));
}

var_dump(quicksort([4, 2, 6, 3, 123, 40, 20, 1, 9, 2, 90]));
