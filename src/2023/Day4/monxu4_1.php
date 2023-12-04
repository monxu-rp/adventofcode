<?php

require __DIR__ . '/../../support.php';

$lines = getInputForDay(4);
function execute(array $lines): int
{
    $result = 0;

    foreach ($lines as $line) {
        list($card, $line) = explode(':', $line);
        list($winning, $your) = explode('|', $line);
        preg_match_all('/(\d+)/', $winning, $matches);
        /** @var int[] $winning */
        $winning = array_flip($matches[0]);
        preg_match_all('/(\d+)/', $your, $matches);
        /** @var int[] $your */
        $your = array_flip($matches[0]);
        $find = count(array_intersect_key($your, $winning));

        if ($find > 0) {
            $result += 2 ** ($find - 1);
        }
    }

    return $result;
}

$result = execute($lines);

echo sprintf("Result: %u\n", $result);
