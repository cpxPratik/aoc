<?php

// https://adventofcode.com/2025/day/6

$worksheet = file_get_contents('./input.txt');

// Remove newline character at end
$worksheet = substr($worksheet, 0, -1);

//$worksheet ="
//123 328  51 64
// 45 64  387 23
//  6 98  215 314
//*   +   *   +  ";
// Remove newline character at start
//$worksheet = substr($worksheet, 1);

$row = explode(PHP_EOL , $worksheet);
$totalColumns = strlen($row[0]);

$totalRows = count($row);

$currentColumn = 0;
$currentOperation = $row[$totalRows-1][0];
$result = null;
$grandTotal = 0;

while ($currentColumn < $totalColumns) {
    $currentOperand = '';

    for ($i = 0; $i < $totalRows-1; $i++) {
        $currentOperand .= $row[$i][$currentColumn];
    }

    if ($currentOperation === '*') {
        if ($result === null) {
            $result = 1;
        }

        $result *= (int) $currentOperand;
    }

    if ($currentOperation === '+') {
        if ($result === null) {
            $result = 0;
        }

        $result += (int) $currentOperand;
    }

    $currentColumn++;

    if (isset($row[$totalRows-1][$currentColumn+1]) && $row[$totalRows-1][$currentColumn+1] !== ' ')  {
        $currentOperation = $row[$totalRows-1][$currentColumn+1];
        $grandTotal += $result;
        $result = null;
        $currentColumn++;
    }

    if ($currentColumn == $totalColumns) {
        $grandTotal += $result;
    }
}

var_dump($grandTotal);
