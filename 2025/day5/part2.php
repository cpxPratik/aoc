<?php

// https://adventofcode.com/2025/day/5

$ingredientDb = file_get_contents('./input.txt');
$ingredientDbList = explode(PHP_EOL . PHP_EOL, $ingredientDb);

$freshIngredientIdRangeList = explode(PHP_EOL, $ingredientDbList[0]);

usort($freshIngredientIdRangeList, function ($first, $second) {
    $firstLowest = (int) explode('-', $first)[0];
    $secondLowest = (int) explode('-', $second)[0];
    $firstHighest = (int) explode('-', $second)[0];
    $secondHighest = (int) explode('-', $second)[0];

    if ($firstLowest === $secondLowest) {
        return ($firstHighest > $secondHighest) ? -1 : 1;
    }

    return ($firstLowest < $secondLowest) ? -1 : 1;
});

$uniqueFreshIngredientIdRangeList = [];

$maxStart = 0;
$totalFreshIngredientId = 0;

foreach ($freshIngredientIdRangeList as $freshIngredientIdRange) {
    $lowerAndUpperRange = explode('-', $freshIngredientIdRange);
    $lowestId = (int) $lowerAndUpperRange[0];
    $highestId = (int) $lowerAndUpperRange[1];

    if ($maxStart > $highestId) {
        continue;
    } else {
        $totalFreshIngredientId += $highestId - max($maxStart, $lowestId) + 1;
        $maxStart = $highestId + 1;
    }
}

var_dump(($totalFreshIngredientId));
