<?php

// https://adventofcode.com/2025/day/7

$manifold = file_get_contents('./input.txt');

// Remove newline character at end
$manifold = substr($manifold, 0, -1);

//$manifold = "
//.......S.......
//...............
//.......^.......
//...............
//......^.^......
//...............
//.....^.^.^.....
//...............
//....^.^...^....
//...............
//...^.^...^.^...
//...............
//..^...^.....^..
//...............
//.^.^.^.^.^...^.
//...............";
//// Remove newline character at start
//$manifold = substr($manifold, 1);

$manifoldLines = explode(PHP_EOL , $manifold);

$manifoldLines[1] = $manifoldLines[0];

$length = strlen($manifoldLines[0]);
$splitCount = 0;

for ($i = 1; $i < (count($manifoldLines)-2); $i+=2) {
    for ($j = 0; $j < $length; $j++) {
        if ($manifoldLines[$i][$j] === 'S') {
            if ($manifoldLines[$i+1][$j] === '^') {
                $splitCount++;
                $manifoldLines[$i+2][$j-1] = $manifoldLines[$i+2][$j+1] = 'S';
            } else {
                $manifoldLines[$i+2][$j] = 'S';
            }
        }
    }
}

var_dump($splitCount);
