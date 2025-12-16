<?php

// https://adventofcode.com/2025/day/3

$banksDb = file_get_contents('./input.txt');
// Remove newline character at end
$banksDb = substr($banksDb, 0, -1);

$banksList = explode(PHP_EOL , $banksDb);

$totalJoltage = 0;
$totalDigitOfJoltage = 12;

foreach ($banksList as $bank) {
    $joltValues = [];
    $i = 1;

    $currentPositionString = substr($bank, 0, -$totalDigitOfJoltage);

    while($i <= $totalDigitOfJoltage) {
        $subStrLength = $totalDigitOfJoltage !== $i ? -($totalDigitOfJoltage - $i) : null;

        // Last ($subStrLength) joltage cannot be chosen as first 12th, 11th, 10th joltage etc, so skipped
        $lastJoltageRemoved = substr($bank, 0, $subStrLength);

        // Append first digit position of previously skipped value
        $currentPositionString .= $lastJoltageRemoved[strlen($lastJoltageRemoved) -  1];

        $joltageListAfterLargestJolt = str_split($currentPositionString, 1);
        arsort($joltageListAfterLargestJolt);

        $nextLargestJoltPosition = array_key_first($joltageListAfterLargestJolt);
        $currentPositionString = substr($currentPositionString, $nextLargestJoltPosition + 1);
        $nextLargestJoltValue = $joltageListAfterLargestJolt[$nextLargestJoltPosition];

        $joltValues[] = $nextLargestJoltValue;
        $i++;
    }

    $totalJoltage += (int) implode('', $joltValues);
}

var_dump($totalJoltage);
