<?php

require __DIR__ . '/../../support.php';

$fileContent = getContentForDay(8, false);

const START = 'A';
const END = 'Z';

function execute($path, $maps): int
{
    $map = explode("\n", $maps);
    $directions = str_split($path);
    $connections = [];
    $current = [];

    foreach ($map as $line) {
        preg_match('/([A-Z\d]{3}) = \(([A-Z\d]{3}), ([A-Z\d]{3})\)/', $line, $matches);
        [, $from, $left, $right] = $matches;

        $connections[$from] = [$left, $right];

        if (substr($from, -strlen(START)) === START) {
            $current[] = $from;
        }
    }

    $cycles = array_map(
        function ($start) use ($directions, $connections) {
            return getCycleLength($start, $directions, $connections);
        },
        $current
    );

    return array_reduce($cycles, function ($acc, $cycle) {
        return lcm($acc, $cycle);
    },1);
}

function getCycleLength(
    string $start,
    array $directions,
    array $connections
): int {
    $steps = 0;
    $done = false;
    $current = $start;

    while (!$done) {
        [$left, $right] = $connections[$current];

        if ($directions[$steps % count($directions)] === 'L') {
            $current = $left;
        } else {
            $current = $right;
        }

        $steps++;

        $done = substr($current, -strlen(END)) === END;
    }

    return $steps;
}


function lcm(int $a, int $b): int
{
    return abs($a * $b) / gcd($a, $b);
}

function gcd(int $a, int $b): int
{
    while ($b !== 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }

    return $a;
}

list($path, $maps) = explode("\n\n", $fileContent, 2);
$result = execute($path, $maps);

echo sprintf("Result: %u\n", $result);
