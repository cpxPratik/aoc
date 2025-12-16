<?php

// https://adventofcode.com/2025/day/9

$tileLocations = file_get_contents('./input.txt');

// Remove newline character at end
$tileLocations = substr($tileLocations, 0, -1);

//$tileLocations = "7,1
//11,1
//11,7
//9,7
//9,5
//2,5
//2,3
//7,3";

$tileLocations = explode(PHP_EOL , $tileLocations);

//            0123
//  01234567891111
// 0..............
// 1.......#...#..
// 2..............
// 3..#....#......
// 4..............
// 5..#......#....
// 6..............
// 7.........#.#..
// 8..............

$totalLocations = count($tileLocations);
$locationList = [];

foreach ($tileLocations as $tileLocation) {
    $locationList[] = array_map('intval', explode("," , $tileLocation));
}

$maxArea = 0;

for ($i = 0; $i <= ($totalLocations-2); $i++) {
    for ($j = $i+1; $j <= ($totalLocations-1); $j++) {
        $diffX = abs($locationList[$i][0] - $locationList[$j][0]) + 1;
        $diffY = abs($locationList[$i][1] - $locationList[$j][1]) + 1;

        $currentArea = $diffX * $diffY;

        if ($currentArea > $maxArea) {
            $maxArea = $currentArea;
        }
    }
}

var_dump($maxArea);
