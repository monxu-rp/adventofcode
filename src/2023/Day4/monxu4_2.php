<?php

require __DIR__ . '/../../support.php';

$lines = getInputForDay(4);

function execute(array $lines): int
{
    $scratchcards = array_fill(0, count($lines), 1);

    foreach ($lines as $id => $line) {
        $line = explode(':', $line)[1];
        list($winning, $your) = explode('|', $line);
        preg_match_all('/(\d+)/', $winning, $matches);
        /** @var int[] $winning */
        $winning = array_flip($matches[0]);
        preg_match_all('/(\d+)/', $your, $matches);
        /** @var int[] $your */
        $your = array_flip($matches[0]);
        $find = count(array_intersect_key($your, $winning));

        if ($find > 0) {
            for ($copyId = $id + 1; $copyId <= $id + $find; $copyId++) {
                if ($copyId < count($scratchcards)) {
                    $scratchcards[$copyId] += $scratchcards[$id];
                }
            }
        }
    }

    return array_sum($scratchcards);
}

$result = execute($lines);

echo sprintf("Result: %u\n", $result);



