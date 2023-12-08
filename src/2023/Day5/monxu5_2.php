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

function applyMappingsForRange($range, $mappings): array
{
    $result = [];
    foreach ($range as $number) {
        $result[] = applyMappings($number, $mappings);
    }
    return $result;
}

$locationNumbers = [];
for ($i = 0; $i < count($seeds); $i += 2) {
    $start = $seeds[$i];
    $length = $seeds[$i + 1];
    $seedRange = range($start, $start + $length - 1);
    $mappedRange = $seedRange;

    foreach ([$seedToSoilMap, $soilToFertilizerMap, $fertilizerToWaterMap, $waterToLightMap, $lightToTemperatureMap, $temperatureToHumidityMap, $humidityToLocationMap] as $mappings) {
        $mappedRange = applyMappingsForRange($mappedRange, $mappings);
    }

    $locationNumbers = array_merge($locationNumbers, $mappedRange);
}

$lowestLocation = min($locationNumbers);

echo sprintf("Result: %u\n", $lowestLocation);

