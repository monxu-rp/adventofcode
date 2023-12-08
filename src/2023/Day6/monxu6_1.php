<?php

require __DIR__ . '/../../support.php';

$lines = getInputForDay(6, false);
function calculateWinner(array $lines): int {
    preg_match_all('/(\d+)/', $lines[0], $matches);
    $times = $matches[0];
    preg_match_all('/(\d+)/', $lines[1], $matches);
    $distances = $matches[0];
    $winner = array_map(function () {
        return 0;
    }, $times);

    for ($race = 0; $race < count($times); $race++) {
        for ($i = 0; $i < $times[$race]; $i++) {
            $distanceCovered = $i * ($times[$race] - $i);
            if ($distanceCovered > $distances[$race]) {
                $winner[$race]++;
            }
        }
    }

    return array_product($winner);

//    return array_reduce($winner, function ($prev, $curr) {
//        return $prev * $curr;
//    }, 1);
}

$result = calculateWinner($lines);

echo sprintf("Result: %u\n", $result);
