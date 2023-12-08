<?php

require __DIR__ . '/../../support.php';

$fileContent = getContentForDay(5, true);

$blocks = explode("\n\n", $fileContent);
$seeds = explode(": ", $blocks[0])[1];
$seeds = array_map('intval', explode(' ', $seeds));

function convertSection($section): array
{
    $lines = explode("\n", $section);
    $header = array_shift($lines);
    $header =  str_replace([':',' '],'', lcfirst(ucwords(str_replace('-',' ',  $header))));
    $data = array_map(function ($line) {
        return array_map('intval', explode(' ', $line));
    }, $lines);
    return [$header, $data];
}

$sections = array_map('trim', explode("\n\n", $fileContent));
array_shift($sections);
$convertedSections = array_map('convertSection', $sections);
foreach ($convertedSections as [$header, $data]) {
    $variableName = $header;
    ${$variableName} = $data;
}

function applyMappings($number, $mappings)
{
    foreach ($mappings as [$dst, $src, $sz]) {
        if ($src <= $number && $number < $src + $sz) {
            return $number + $dst - $src;
        }
    }
    return $number;
}

$locationNumbers = [];
foreach ($seeds as $seed) {
    $soil = applyMappings($seed, $seedToSoilMap);
    $fertilizer = applyMappings($soil, $soilToFertilizerMap);
    $water = applyMappings($fertilizer, $fertilizerToWaterMap);
    $light = applyMappings($water, $waterToLightMap);
    $temperature = applyMappings($light, $lightToTemperatureMap);
    $humidity = applyMappings($temperature, $temperatureToHumidityMap);
    $location = applyMappings($humidity, $humidityToLocationMap);
    $locationNumbers[] = $location;
}

$lowestLocation = min($locationNumbers);

echo sprintf("Result: %u\n", $lowestLocation);

