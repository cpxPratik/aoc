<?php

// https://adventofcode.com/2025/day/10

$machines = file_get_contents('./input.txt');

// Remove newline character at end
$machines = substr($machines, 0, -1);

$machinesList = explode(PHP_EOL , $machines);

$machines = [];

foreach ($machinesList as $machine) {
    $machineParts = explode(' ', $machine);

    unset($machineParts[count($machineParts) - 1]); // Remove joltage requirements at end

    for ($i = 0; $i < count($machineParts); $i++) {
        // Remove an enclosing character at start and at end
        $machineParts[$i] = substr($machineParts[$i], 1, -1);
    }

    $targetIndicators = $machineParts[0];

    for ($j = 0; $j < strlen($targetIndicators); $j++) {
        if ($targetIndicators[$j] === '.') {
            $targetIndicators[$j] = '0';
            continue;
        }
        $targetIndicators[$j] = '1';
    }

    $binaryTarget = bindec($targetIndicators);

    $totalIndicators = strlen($targetIndicators);
    // All indicator lights are initially off('0')
    $initialIndicator = str_repeat('0', $totalIndicators);

    $buttonsList = [];

    for ($buttonIndex = 1; $buttonIndex < count($machineParts); $buttonIndex++) {
        $buttonsLightIndexList = explode(',', $machineParts[$buttonIndex]);

        $button = $initialIndicator;

        foreach ($buttonsLightIndexList as $lightIndex) {
            $button[$lightIndex] = '1';
        }

        $buttonsList[] = bindec($button);
    }

    $machines[] = ['target' => $binaryTarget, 'buttons' => $buttonsList];
}

$minimumButtonPress = 0;
$totalFound = 0;

foreach ($machines as $currentMachineIndex => $machineParts) {
    $buttons = $machineParts['buttons'];
    $totalButtons = count($buttons);
    $targetIndicator = $machineParts['target']; // In Decimal value
    $initialIndicator = 0;

    for ($buttonIndex = 0; $buttonIndex <= ($totalButtons-1); $buttonIndex++) {
        $indicatorsAfterPress = $initialIndicator;
        $indicatorsAfterPress ^= $buttons[$buttonIndex];
        if ($indicatorsAfterPress === $targetIndicator) {
            $minimumButtonPress += 1;
            $totalFound++;
            continue 2;
        }
    }

    for ($i = 0; $i <= ($totalButtons-2); $i++) {
        for ($j = $i + 1; $j <= ($totalButtons-1); $j++) {
            $indicatorsAfterPress = 0;
            $indicatorsAfterPress ^= $buttons[$i] ^ $buttons[$j];
            if ($indicatorsAfterPress === $targetIndicator) {
                $minimumButtonPress += 2;
                $totalFound++;
                continue 3;
            }
        }
    }

    for ($i = 0; $i <= ($totalButtons-3); $i++) {
        for ($j = $i + 1; $j <= ($totalButtons-2); $j++) {
            for ($k = $j + 1; $k <= ($totalButtons-1); $k++) {
                $indicatorsAfterPress = $initialIndicator;
                $indicatorsAfterPress ^= $buttons[$i] ^ $buttons[$j] ^ $buttons[$k];
                if ($indicatorsAfterPress === $targetIndicator) {
                    $minimumButtonPress += 3;
                    $totalFound++;
                    continue 4;
                }
            }
        }
    }

    for ($i = 0; $i <= ($totalButtons-4); $i++) {
        for ($j = $i + 1; $j <= ($totalButtons-3); $j++) {
            for ($k = $j + 1; $k <= ($totalButtons-2); $k++) {
                for ($l = $k + 1; $l <= ($totalButtons-1); $l++) {
                    $indicatorsAfterPress = $initialIndicator;
                    $indicatorsAfterPress ^= $buttons[$i] ^ $buttons[$j] ^ $buttons[$k] ^ $buttons[$l];
                    if ($indicatorsAfterPress === $targetIndicator) {
                        $minimumButtonPress +=4;
                        $totalFound++;
                        continue 5;
                    }
                }
            }
        }
    }

    for ($i = 0; $i <= ($totalButtons-5); $i++) {
        for ($j = $i + 1; $j <= ($totalButtons-4); $j++) {
            for ($k = $j + 1; $k <= ($totalButtons-3); $k++) {
                for ($l = $k + 1; $l <= ($totalButtons-2); $l++) {
                    for ($m = $l + 1; $m <= ($totalButtons-1); $m++) {
                        $indicatorsAfterPress = $initialIndicator;
                        $indicatorsAfterPress ^= $buttons[$i] ^ $buttons[$j] ^ $buttons[$k]
                            ^ $buttons[$l] ^ $buttons[$m];
                        if ($indicatorsAfterPress === $targetIndicator) {
                            $minimumButtonPress +=5;
                            $totalFound++;
                            continue 6;
                        }
                    }
                }
            }
        }
    }

    for ($i = 0; $i <= ($totalButtons-6); $i++) {
        for ($j = $i + 1; $j <= ($totalButtons-5); $j++) {
            for ($k = $j + 1; $k <= ($totalButtons-4); $k++) {
                for ($l = $k + 1; $l <= ($totalButtons-3); $l++) {
                    for ($m = $l + 1; $m <= ($totalButtons-2); $m++) {
                        for ($n = $m + 1; $n <= ($totalButtons-1); $n++) {
                            $indicatorsAfterPress = $initialIndicator;
                            $indicatorsAfterPress ^= $buttons[$i] ^ $buttons[$j] ^ $buttons[$k]
                                ^ $buttons[$l] ^ $buttons[$m] ^ $buttons[$n];
                            if ($indicatorsAfterPress === $targetIndicator) {
                                $minimumButtonPress += 6;
                                $totalFound++;
                                continue 7;
                            }
                        }
                    }
                }
            }
        }
    }

    for ($i = 0; $i <= ($totalButtons-7); $i++) {
        for ($j = $i + 1; $j <= ($totalButtons-6); $j++) {
            for ($k = $j + 1; $k <= ($totalButtons-5); $k++) {
                for ($l = $k + 1; $l <= ($totalButtons-4); $l++) {
                    for ($m = $l + 1; $m <= ($totalButtons-3); $m++) {
                        for ($n = $m + 1; $n <= ($totalButtons-2); $n++) {
                            for ($o = $n + 1; $o <= ($totalButtons-1); $o++) {
                                $indicatorsAfterPress = $initialIndicator;
                                $indicatorsAfterPress ^= $buttons[$i] ^ $buttons[$j] ^ $buttons[$k]
                                    ^ $buttons[$l] ^ $buttons[$m] ^ $buttons[$n] ^ $buttons[$o];
                                if ($indicatorsAfterPress === $targetIndicator) {
                                    $minimumButtonPress += 7;
                                    $totalFound++;
                                    continue 8;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    echo "Still not finding combination for input key: " . $currentMachineIndex . PHP_EOL;
}

var_dump($totalFound);

if ($totalFound !== count($machines)) {
    echo 'Still combinations to be found' . PHP_EOL;
}

var_dump($minimumButtonPress);
