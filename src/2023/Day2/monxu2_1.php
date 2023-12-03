<!----><?php

require __DIR__ . '/../support.php';

$lines = getInputForDay(2);

function solve(string $line, array $validate): int
{
    $game = explode(':', $line);
    $gameNumber = explode(' ', $game[0])[1];
    $sets = explode(';', $game[1]);
    foreach ($sets as $set) {
        $colors = explode(',', $set);
        foreach ($colors as $color) {
            $valorWithColor = trim($color);
            $info = explode(' ', $valorWithColor);
            if ((int)$info[0] > $validate[$info[1]]) {
                return 0;
            }
        }
    }

    return (int)$gameNumber;
}

function execute(array $lines): int
{
    $result = 0;
    $validate = ['red' => '12', 'green' => '13', 'blue' => '14',];
    foreach ($lines as $line) {
        $result += solve($line, $validate);
    }

    return $result;

}

$result = execute($lines);

echo sprintf("Result: %u\n", $result);



