<?php

require __DIR__ . '/../../support.php';

$fileContent = getContentForDay(8, false);

const START = 'AAA';
const END = 'ZZZ';

function execute($path, $maps): int
{
    $newMap = [];
    $currentMap = explode("\n", $maps);
    foreach ($currentMap as $line) {
        if (empty($line)) {
            continue;
        }
        preg_match('/([A-Z]{3}) = \(([A-Z]{3}), ([A-Z]{3})\)/', $line, $matches);
        [, $from, $left, $right] = $matches;

        $newMap[$from] = [$left, $right];
    }

    $curr = START;
    $count = 0;
    $path = str_split($path);
    do {
        list($left, $right) = $newMap[$curr];
        $curr = $path[$count % count($path)] === 'L' ? $left : $right;
        $count++;
    } while ($curr !== END);

    return $count;
}

list($path, $maps) = explode("\n\n", $fileContent, 2);
$result = execute($path, $maps);

echo sprintf("Result: %u\n", $result);
