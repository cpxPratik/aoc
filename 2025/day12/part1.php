<?php

// https://adventofcode.com/2025/day/12

$shapesAndRegions = file_get_contents('./input.txt');

// Remove newline character at end
$shapesAndRegions = substr($shapesAndRegions, 0, -1);

$shapesAndRegionsList = explode(PHP_EOL , $shapesAndRegions);

$regionsThatCanFit = 0;

for($i = 30; $i <count($shapesAndRegionsList); $i++) {
    $regionAndShape = array_map('intval', preg_split('/[\sx:]+/', $shapesAndRegionsList[$i]));

    $length = $regionAndShape[0] / 3;
    $width = $regionAndShape[1] / 3;

    if (
        $length * $width >=
        (
            $regionAndShape[2] + $regionAndShape[3] + $regionAndShape[4] +
            $regionAndShape[5] + $regionAndShape[6] + $regionAndShape[7]
        )
    ) {
        $regionsThatCanFit++;
    }
}

var_dump($regionsThatCanFit);
