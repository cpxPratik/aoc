<?php

// https://adventofcode.com/2025/day/5

$ingredientDb = file_get_contents('./input.txt');
$ingredientDbList = explode(PHP_EOL . PHP_EOL, $ingredientDb);

$freshIngredientIdRangeList = explode(PHP_EOL, $ingredientDbList[0]);

// Remove newline character at end
$availableIngredientsList = substr($ingredientDbList[1], 0, -1);
$availableIngredients = explode(PHP_EOL, $availableIngredientsList);

$totalFreshIngredients = 0;

foreach ($availableIngredients as $availableIngredient) {
    $availableIngredientId = (int) $availableIngredient;

    foreach ($freshIngredientIdRangeList as $freshIngredientIdRange) {
        $lowerAndUpperRange = explode('-', $freshIngredientIdRange);

        if ($availableIngredientId >= $lowerAndUpperRange[0] && $availableIngredientId <= $lowerAndUpperRange[1] ) {
            $totalFreshIngredients++;
            break;
        }
    }
}

var_dump($totalFreshIngredients);
