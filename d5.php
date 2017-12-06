<?php

# http://adventofcode.com/2017/day/5

begin();

function begin()
{
    $inputString    = file_get_contents('data/d5.txt');
    $input          = getData($inputString);

    $r1             = escapeMaze1($input);
    $r2             = escapeMaze2($input);

    var_dump($r1);
    var_dump($r2);
}

function getData(string $text)
{
    return explode(PHP_EOL, $text);
}

function escapeMaze1($data)
{
    $pointer    = 0;
    $count      = 0;

    while($pointer < sizeof($data)) {
        $nextPointer = $data[$pointer];
        $data[$pointer]++;
        $pointer = $pointer + $nextPointer;
        $count++;
    }

    return $count;
}

function escapeMaze2($data)
{
    $pointer    = 0;
    $count      = 0;

    while($pointer < sizeof($data)) {
        $nextPointer = $data[$pointer];

        if ($nextPointer >= 3) {
            $data[$pointer]--;
        } else {
            $data[$pointer]++;
        }

        $pointer = $pointer + $nextPointer;
        $count++;
    }

    return $count;
}