<?php

// https://adventofcode.com/2025/day/3

$banksDb = file_get_contents('./input.txt');
// Remove newline character at end
$banksDb = substr($banksDb, 0, -1);

$banksList = explode(PHP_EOL , $banksDb);

$totalJoltage = 0;

foreach ($banksList as $bank) {
    $originalBank = $bank;

    // Last joltage cannot be chosen as first joltage, so skipped
    $lastJoltageRemoved = substr($bank, 0, -1);

    $joltageList = str_split($lastJoltageRemoved, 1);

    $largestJoltValue = max($joltageList);

    $largestJoltPosition = array_search($largestJoltValue, $joltageList);

    $joltageStringAfterLargestJolt = substr($bank, $largestJoltPosition + 1);

    $joltageListAfterLargestJolt = str_split($joltageStringAfterLargestJolt, 1);
    $secondLargestJoltValue = max($joltageListAfterLargestJolt);

    $totalJoltage += (int) ($largestJoltValue . $secondLargestJoltValue);
}

var_dump($totalJoltage);
