<?php

use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

(new Dotenv())->load(__DIR__ . '/../.env');

/** return string[] */
function getInputForDay(int $day): array
{
    $day = $day>$_ENV['DAY']?$day:$_ENV['DAY'];
    $year = $_ENV['YEAR'];
    $path = sprintf('/var/www/html/data/input/%d/%d/input.txt', $year, $day);
    @mkdir(dirname($path), 0777, true);

    if (!file_exists($path)) {
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => 'Cookie: session=' . $_ENV['SESSION_COOKIE'] . "\r\n",
            ],
        ]);

        $content = file_get_contents(sprintf('https://adventofcode.com/%u/day/%u/input',$year, $day), false, $context);

        file_put_contents($path, $content);
    }

    return file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
