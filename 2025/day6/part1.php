<?php

// https://adventofcode.com/2025/day/6

$worksheet = file_get_contents('./input.txt');

// Remove newline character at end
$worksheet = substr($worksheet, 0, -1);

$row = explode(PHP_EOL , $worksheet);

$operations = preg_split('/\s+/', $row[count($row)-1], -1, PREG_SPLIT_NO_EMPTY);
$firstOperand = array_map('intval', preg_split('/\s+/', $row[count($row)-2], -1, PREG_SPLIT_NO_EMPTY));

for ($i = count($row)-3; $i >= 0; $i--){
    $currentOperands = array_map('intval', preg_split('/\s+/', $row[$i], -1, PREG_SPLIT_NO_EMPTY));

    for  ($j=0; $j  < count($operations); $j++){
        if ($operations[$j] === '*') {
            $firstOperand[$j] *= $currentOperands[$j];
            continue;
        }
        $firstOperand[$j] += $currentOperands[$j];
    }
}

var_dump(array_sum($firstOperand));
