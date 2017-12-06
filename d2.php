<?php

# http://adventofcode.com/2017/day/2

begin();

function begin()
{
    $inputString    = file_get_contents('data/d2.txt');
    $input          = getData($inputString);

    $r1             = checksum1($input);
    $r2             = checksum2($input);

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

function checksum1($data)
{
    $checksum = 0;

    foreach ($data as $line) {

        $min = $line[0];
        $max = $line[0];

        foreach ($line as $value) {
            if ($value > $max) { $max = $value; }
            if ($value < $min) { $min = $value; }
        }

        $diff       = $max - $min;
        $checksum   += $diff;

    }

    return $checksum;
}

function checksum2($data)
{
    $checksum = 0;

    foreach ($data as $line) {

        foreach ($line as $value1) {

            foreach ($line as $value2) {

                if ($value1 !== $value2 && $value1 % $value2 == 0) {
                    $checksum += ($value1 / $value2);
                }

            }
        }
    }

    return $checksum;
}
