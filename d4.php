<?php

# http://adventofcode.com/2017/day/4

begin();

function begin()
{
    $inputString    = file_get_contents('data/d4.txt');
    $input          = getData($inputString);

    $r1             = isValid1($input);
    $r2             = isValid2($input);

    var_dump($r1);
    var_dump($r2);
}

function getData(string $text)
{
    $lines = explode(PHP_EOL, $text);
    for($i = 0; $i < sizeof($lines); $i++) {
        $lines[$i] = explode(',', $lines[$i]);
    }
    return $lines;
}

function isValid1($data)
{
    $count = 0;

    foreach ($data as $line) {
        if (!hasDoublon($line)) {
            $count++;
        }
    }

    return $count;
}

function hasDoublon(array $array)
{
    return count($array) !== count(array_flip($array));
}

function isValid2($data)
{
    $count = 0;

    foreach ($data as $line) {
        if (isValidPassphrase($line)) {
            $count++;
        }
    }

    return $count;
}

function isValidPassphrase(array $line)
{
    $tmpLine = [];
    foreach ($line as $word) {
        $strArray = str_split($word);
        sort($strArray);
        $word = implode('', $strArray);
        $tmpLine[] = $word;
    }

    if (hasDoublon($tmpLine)) {
        return false;
    } else {
        return true;
    }
}
