<?php

require __DIR__ . '/../../support.php';

$lines = getInputForDay(1);

function solve(string $line): int
{
    $digitalOnly = preg_replace('/[^0-9]/', '', $line);
    $firstDigit = substr($digitalOnly, 0, 1);
    $lastDigit = substr($digitalOnly, -1, 1);

    return (int)$firstDigit . (int)$lastDigit;
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



