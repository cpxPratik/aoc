<?php

// https://adventofcode.com/2025/day/11

$devices = file_get_contents('./input.txt');

// Remove newline character at end
$devices = substr($devices, 0, -1);

$devicesList = explode(PHP_EOL , $devices);

$devicesWithOutputs = [];

foreach ($devicesList as $device) {
    $deviceOutputPairs = array_map('trim', explode(':', $device));

    $devicesWithOutputs[$deviceOutputPairs[0]] = explode(' ', $deviceOutputPairs[1]);
}

function countPaths($currentDevice, $targetOutput, &$devicesWithOutputs, &$cache) {
    if ($currentDevice === $targetOutput) { // When output with target value is reached, count it as a successful path
        return 1;
    }

    if (isset($cache[$currentDevice][$targetOutput])) {
        return $cache[$currentDevice][$targetOutput];
    }

    $totalPaths = 0;

    if (isset($devicesWithOutputs[$currentDevice])) {
        foreach ($devicesWithOutputs[$currentDevice] as $output) {
            $totalPaths += countPaths($output, $targetOutput, $devicesWithOutputs, $cache);
        }
    }

    $cache[$currentDevice][$targetOutput] = $totalPaths;
    return $totalPaths;
}

$cache = [];

$pathCountSvrFft = countPaths('svr', 'fft', $devicesWithOutputs, $cache);
$pathCountFftDac = countPaths('fft', 'dac', $devicesWithOutputs, $cache);
$pathCountDacOut = countPaths('dac', 'out', $devicesWithOutputs, $cache);

$pathCountSvrDac = countPaths('svr', 'dac', $devicesWithOutputs, $cache);
$pathCountDacFft = countPaths('dac', 'fft', $devicesWithOutputs, $cache);
$pathCountFftOut = countPaths('fft', 'out', $devicesWithOutputs, $cache);

$totalUniquePaths = ($pathCountSvrFft * $pathCountFftDac * $pathCountDacOut) +
    ($pathCountSvrDac * $pathCountDacFft * $pathCountFftOut);

var_dump($totalUniquePaths);
