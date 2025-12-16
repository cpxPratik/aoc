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
$length = strlen($manifoldLines[0]);

$splitCount = 0;
$pathCountList = array_fill(0, $length, 0);

for ($i = 0; $i < (count($manifoldLines)-1); $i+=2) {
    for ($j = 0; $j < $length; $j++) {
        if ($manifoldLines[$i][$j] === 'S') {
            $pathCountList[$j] += 1;
            break;
        }

        if ($manifoldLines[$i][$j] === '^') {
            $pathCountList[$j+1] += $pathCountList[$j];
            $pathCountList[$j-1] += $pathCountList[$j];
            $pathCountList[$j] = 0;
        }
    }
}

var_dump(array_sum($pathCountList));


