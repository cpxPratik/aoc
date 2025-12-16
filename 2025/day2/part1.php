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

        if ($length % 2 !== 0) {
            $start++;
            continue;
        }

        $firstHalf = (substr($startString, 0, -($length/2)));
        $secondHalf = (substr($startString, ($length/2)));

        if ($firstHalf === $secondHalf) {
            $sumInvalidIds += $start;
        }

        $start++;
    }
}

var_dump($sumInvalidIds);
