<?php

require __DIR__ . '/../../support.php';

$lines = getInputForDay(2);

function solve(string $line): int
{
    $game = explode(':', $line);
    $sets = explode(';', $game[1]);
    $setResults = ['red' => 0, 'green' => 0, 'blue' => 0,];
    foreach ($sets as $set) {
        $colors = explode(',', $set);
        foreach ($colors as $color) {
            $valorWithColor = trim($color);
            $info = explode(' ', $valorWithColor);
            $setResults[$info[1]] = max($setResults[$info[1]], (int)$info[0]);
        }
    }

    return (int)$setResults['red'] * (int)$setResults['green'] * (int)$setResults['blue'];
}

function execute(array $lines): int
{
    $result = 0;
    foreach ($lines as $line) {
        $result += solve($line);
    }

    return $result;

}

$result = execute($lines);

echo sprintf("Result: %u\n", $result);



