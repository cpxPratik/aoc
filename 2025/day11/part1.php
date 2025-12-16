<?php

// https://adventofcode.com/2025/day/11

$devices = file_get_contents('./input.txt');

// Remove newline character at end
$devices = substr($devices, 0, -1);

$devicesList = explode(PHP_EOL , $devices);

$devicesWithOutputs = [];
$pathCountList = [];

foreach ($devicesList as $device) {
    $deviceOutputPairs = array_map('trim', explode(':', $device));

    $devicesWithOutputs[$deviceOutputPairs[0]] = explode(' ', $deviceOutputPairs[1]);
    $pathCountList[$deviceOutputPairs[0]] = 0;
}

$currentOutputList[] = 'you';

while (($previousOutput = array_pop($currentOutputList)) !== null) {
   if ($devicesWithOutputs[$previousOutput][0] !== 'out') {
       if ($pathCountList[$previousOutput] > 0) {
           $pathCountList[$previousOutput] -= 1;
       }
   }
   foreach ($devicesWithOutputs[$previousOutput] as $output) {
       if ($output !== 'out') {
           $pathCountList[$output] += 1;
           array_unshift($currentOutputList, $output);
       }
   }
}

var_dump(array_sum($pathCountList));
