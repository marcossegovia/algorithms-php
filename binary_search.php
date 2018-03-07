<?php

$input1 = [1, 2, 40, 44, 50, 52, 55, 60, 85];
$find = 44;

function binary_search(array $input, int $number_to_find): bool
{
    $length = \count($input);
    $mid_point = \floor($length / 2);
    if (1 === $length) {
        if ($number_to_find === $input[$mid_point]) {
            return true;
        }
        return false;
    }
    if ($number_to_find === $input[$mid_point]) return true;
    if ($number_to_find < $input[$mid_point]) {
        $chunk = \array_slice($input, 0, $mid_point);
        if (empty($chunk)) {
            return false;
        }
        return binary_search($chunk, $number_to_find);
    }
    if ($number_to_find > $input[$mid_point]) {
        $chunk = \array_slice($input, $mid_point, \count($input));
        if (empty($chunk)) {
            return false;
        }
        return binary_search($chunk, $number_to_find);
    }
}

\var_dump(binary_search($input1, $find));
