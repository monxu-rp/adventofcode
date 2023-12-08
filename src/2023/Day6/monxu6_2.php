<?php

require __DIR__ . '/../../support.php';

$lines = getInputForDay(6, false);
function calculateWinner(array $lines): int {
    preg_match_all('/(\d+)/', $lines[0], $matches);
    $time = implode('',$matches[0]);
    preg_match_all('/(\d+)/', $lines[1], $matches);
    $distance = implode('',$matches[0]);
    $winner = 0;

    for ($i = 0; $i < $time; $i++) {
        $distanceCovered = $i * ($time - $i);
        if ($distanceCovered > $distance) {
            $winner++;
        }
    }

    return $winner;
}

$result = calculateWinner($lines);

echo sprintf("Result: %u\n", $result);
