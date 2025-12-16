<?php

// https://adventofcode.com/2025/day/4

$grid = file_get_contents('./input.txt');

// Remove newline character at end
$grid = substr($grid, 0, -1);

$gridMatrix = explode(PHP_EOL , $grid);

function binaryEncode(string $value) {
    if ($value === '.') {
        return 0;
    }
    return 1;
}

function binaryEncodeRow($row) {
    $rowItemList = str_split($row, 1);
    return array_map('binaryEncode', $rowItemList);
}

$matrix = array_map('binaryEncodeRow', $gridMatrix);

$rowCount = count($matrix);
$columnCount = count($matrix[0]);

$totalAccessibleRolls = 0;
$neighboursRollsLimit = 3;

for ($i = 0; $i < $rowCount; $i++) {
    for ($j = 0; $j < $columnCount; $j++) {
        if ($matrix[$i][$j] === 0) {
            continue;
        }

        $neighboursRolls = 0;

        if (isset($matrix[$i-1][$j]) && $matrix[$i-1][$j] === 1) {
            $neighboursRolls++;
        }
        if (isset($matrix[$i-1][$j-1]) && $matrix[$i-1][$j-1] === 1) {
            $neighboursRolls++;
        }
        if (isset($matrix[$i-1][$j+1]) && $matrix[$i-1][$j+1] === 1) {
            $neighboursRolls++;
        }
        if (isset($matrix[$i+1][$j]) && $matrix[$i+1][$j] === 1) {
            $neighboursRolls++;
        }
        if (isset($matrix[$i+1][$j-1]) && $matrix[$i+1][$j-1] === 1) {
            $neighboursRolls++;
        }
        if (isset($matrix[$i+1][$j+1]) && $matrix[$i+1][$j+1] === 1) {
            $neighboursRolls++;
        }
        if (isset($matrix[$i][$j-1]) && $matrix[$i][$j-1] === 1) {
            $neighboursRolls++;
        }
        if (isset($matrix[$i][$j+1]) && $matrix[$i][$j+1] === 1) {
            $neighboursRolls++;
        }

//        echo "Neightbours count for row {$i} and column {$j} is {$neighboursRolls}\n";

        if ($neighboursRolls <= $neighboursRollsLimit) {
            $totalAccessibleRolls += 1;
        }
    }
}

var_dump($totalAccessibleRolls);
