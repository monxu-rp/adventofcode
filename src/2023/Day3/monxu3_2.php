<?php

require __DIR__ . '/../../support.php';

$lines = getInputForDay(3);

function solve(array $symbols, array $parts): int
{
    $result = 0;

    foreach ($symbols as $coords => $value) {
        list($rowSymbol, $colSymbol) = explode(',', $coords);
        $adj = [];

        foreach ($parts as list($number, $rowPart, $startPositionPart, $endPositionPart)) {
            if ($rowPart - 1 <= $rowSymbol && $rowSymbol <= $rowPart + 1 && $startPositionPart - 1 <= $colSymbol && $colSymbol <= $endPositionPart + 1) {
                $adj[] = $number;
            }
        }

        if (count($adj) == 2 && $symbols["$rowSymbol,$colSymbol"] == '*') {
            $result += $adj[0] * $adj[1];
        }
    }

    return $result;
}

function extractInfo(array $lines): array
{
    $symbols = [];
    $parts = [];

    foreach ($lines as $row => $line) {
        $number = '';
        $startPosition = null;

        for ($col = 0; $col < strlen($line); $col++) {
            $element = $line[$col];

            if (isSymbol($element)) {
                $symbols["$row,$col"] = $element;
            }

            if (ctype_digit($element)) {
                if ($number === '') {
                    $startPosition = $col;
                }
                $number .= $element;
            } elseif ($number !== '') {
                $parts[] = [intval($number), $row, $startPosition, $col - 1];
                $number = '';
            }
        }

        if ($number !== '') {
            $parts[] = [intval($number), $row, $startPosition, $col - 1];
        }
    }

    return [$symbols, $parts];
}

/**
 * @param mixed $element
 * @return bool
 */
function isSymbol(mixed $element): bool
{
    return !ctype_digit($element) && $element !== '.';
}

function execute(array $lines): int
{
    [$symbols, $parts] = extractInfo($lines);
    return solve($symbols, $parts);
}

$result = execute($lines);

echo sprintf("Result: %u\n", $result);



