<?php

require __DIR__ . '/../../support.php';

$lines = getInputForDay(7, true);

function getRank($hand)
{
    $count = array_count_values($hand);
    arsort($count);

    if (in_array('J', $hand)) {
        $numberOfJokers = $count['J'];
        if ($numberOfJokers === 5){
            return 1; // Five of a kind
        }
        unset($count['J']);
        $firstKey= array_key_first($count);
        $count[$firstKey] += $numberOfJokers;
    }

    switch (array_values($count)) {
        case [5]:
            return 1; // Five of a kind
        case [4, 1]:
            return 2; // Four of a kind
        case [3, 2]:
            return 3; // Full house
        case [3, 1, 1]:
            return 4; // Three of a kind
        case [2, 2, 1]:
            return 5; // Two pair
        case [2, 1, 1, 1]:
            return 6; // One pair
        default:
            return 7; // High card
    }
}

function execute($lines)
{
    $order = "AKQT98765432J";
    $hands = [];
    foreach ($lines as $line) {
        list($cards, $bid) = explode(" ", $line);
        $hands[] = [
            'rank' => getRank(str_split($cards)),
            'cardScore' => array_map(fn ($x) => strpos($order, $x), str_split($cards)),
            'bid' => (int)$bid,
        ];
    }
    usort($hands, function ($a, $b) {
        $result = $b['rank'] <=> $a['rank'];
        if ($result === 0)
        {
            $idx= 0;
            while ($result === 0 && $idx < 5) {
                $result = $b['cardScore'][$idx] <=> $a['cardScore'][$idx];
                $idx++;
            }
        }
        return $result;
    });
    $index = 0;
    return array_reduce($hands, function ($sum, $hand) use (&$index) {
        return $sum +  $hand['bid'] * ++$index;
    }, 0);
}

$result = execute($lines);

echo sprintf("Result: %u\n", $result);
