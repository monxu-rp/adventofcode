<?php

require __DIR__ . '/../../support.php';

$lines = getInputForDay(1);

function solve(string $line, array $mapNumber): int
{
    preg_match_all('/(?:one|two|three|four|five|six|seven|eight|nine|[0-9])/i', $line, $matches, PREG_PATTERN_ORDER);
    $first = $matches[0][0] ?? null;
    $first = is_numeric($first) ? $first : (int)$mapNumber[$first];

    $newLast = $first;
    $idxLast = 0;
    foreach ($mapNumber as $key => $value) {
        if (($idx = strrpos($line, $key)) !== false && $idx > $idxLast) {
            $newLast = $value;
            $idxLast = $idx;
        }
    }

    return $first . $newLast;
}

function execute(array $lines): int
{
    $searchMap = [
        'one'   => 1,
        'two'   => 2,
        'three' => 3,
        'four'  => 4,
        'five'  => 5,
        'six'   => 6,
        'seven' => 7,
        'eight' => 8,
        'nine'  => 9,
    ];

    foreach ($searchMap as $v) {
        $searchMap[$v] = $v;
    }

    $result = 0;
    foreach ($lines as $line) {
        $result += solve($line, $searchMap);
    }

    return $result;

}

$result = execute($lines);

echo sprintf("Result: %u\n", $result);



