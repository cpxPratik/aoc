<?php

// https://adventofcode.com/2025/day/8

$junctionBoxes = file_get_contents('./input.txt');

// Remove newline character at end
$junctionBoxes = substr($junctionBoxes, 0, -1);

$junctionList = explode(PHP_EOL , $junctionBoxes);
$coordinates = explode(',' , $junctionList[19]);
$coordinatePairsWithDistance = [];
$maximumPairs = 1000;

for ($currentIndex = 0; $currentIndex <= (count($junctionList)-2); $currentIndex++) {
    for ($i = $currentIndex+1; $i <= (count($junctionList)-1); $i++) {
        $firstCoordinate = array_map('intval', explode(',' , $junctionList[$currentIndex]));
        $secondCoordinate = array_map('intval', explode(',' , $junctionList[$i]));

        $squaredDistance = pow(($secondCoordinate[0] - $firstCoordinate[0]), 2) +
            pow(($secondCoordinate[1] - $firstCoordinate[1]), 2) +
            pow(($secondCoordinate[2] - $firstCoordinate[2]), 2);

        $coordinatePairsWithDistance[] = [$squaredDistance, $junctionList[$currentIndex], $junctionList[$i]];
    }
}

usort($coordinatePairsWithDistance, fn($first, $second) => $first[0] <=> $second[0]);

$circuits = [];

for ($count = 0; $count < count($coordinatePairsWithDistance); $count++) {
    $firstCoordinate = $coordinatePairsWithDistance[$count][1];
    $secondCoordinate = $coordinatePairsWithDistance[$count][2];

    if ($count === 0) {
        $circuits[] = [$firstCoordinate, $secondCoordinate];
        continue;
    }

    if (count($circuits[0]) === count($junctionList)) {
        var_dump($coordinatePairsWithDistance[$count-1][1], $coordinatePairsWithDistance[$count-1][2]);

        $firstXCoordinate = explode(',',  $coordinatePairsWithDistance[$count-1][1])[0];
        $secondXCoordinate = explode(',',  $coordinatePairsWithDistance[$count-1][2])[0];

        echo "{$firstXCoordinate} * {$secondXCoordinate} = " . $firstXCoordinate * $secondXCoordinate . PHP_EOL;
        break;
    }

    // Search first coordinate in circuits
    for ($i = 0; $i < count($circuits); $i++) {
        if (in_array($firstCoordinate, $circuits[$i])) {
            for ($j = 0; $j < count($circuits); $j++) {
                if (in_array($secondCoordinate, $circuits[$j])) {
                    if ($i !== $j) { // When both are not in same circuits
                        $circuits[$i] = array_merge($circuits[$i], $circuits[$j]);

                        $k = $j;
                        while ($k < (count($circuits) - 1)) {
                            $circuits[$k] = $circuits[$k + 1];
                            $k++;
                        }
                        unset($circuits[$k]);
                    }
                    continue 3;
                }
            }
            $circuits[$i][] = $secondCoordinate;
            continue 2;
        }
    }

    // Search second coordinate in circuits after first not found
    for ($j = 0; $j < count($circuits); $j++) {
        if (in_array($secondCoordinate, $circuits[$j])) {
            $circuits[$j][] = $firstCoordinate;
            continue 2;
        }
    }

    // Add new circuit when not found on existing ones
    $circuits[count($circuits)] = [$firstCoordinate, $secondCoordinate];
}
