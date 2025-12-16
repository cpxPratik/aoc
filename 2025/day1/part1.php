<?php

// https://adventofcode.com/2025/day/1

$inputRotations = file_get_contents('./input.txt');
// Remove newline character at end
$inputRotations = substr($inputRotations, 0, -1);

$position = 50;
$password = 0;

$rotations = explode(PHP_EOL, $inputRotations);

foreach ($rotations as $rotation) {
    // Removes first character `R` or `L`
    $step = (int) (substr($rotation, 1));

    $diff = $step % 100;

    if ($rotation[0] === 'R')
    {
        $position += $diff;
    }
    if ($rotation[0] === 'L'){
        $position -= $diff;
    }

    if ($position % 100 == 0) {
        $password++;
    }
}

var_dump($password);
