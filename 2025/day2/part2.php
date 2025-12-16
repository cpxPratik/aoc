<?php

// https://adventofcode.com/2025/day/2

$input = file_get_contents('./input.txt');

$idRanges = explode(',', $input);

$sumInvalidIds = 0;

foreach ($idRanges as $idRange) {
    $startAndEnd = explode('-', $idRange);
    $start = (int) $startAndEnd[0];
    $end = (int) $startAndEnd[1];

    while ($start <= $end) {
        $startString = ((string) $start);
        $length = strlen($startString);

        if ($length === 1) {
            $start++;
            continue;
        }

        $splitLength = 1;

        while ($splitLength < $length) {
            $splitStartList = str_split($startString, $splitLength);

            // Check if all array values are same, which causes count of unique values to be 1
            if (count(array_unique($splitStartList)) === 1) {
                $sumInvalidIds += $start;
                break;
            }
            $splitLength++;
        }

        $start++;
    }
}

var_dump($sumInvalidIds);
