<?php

# http://adventofcode.com/2017/day/8

begin();

function begin()
{
    $inputString    = file_get_contents('data/d8.txt');
    $input          = getData($inputString);

    $r1             = cpu($input);

    var_dump('R1 = ', $r1);
}

function getData(string $text)
{
   $data = explode(PHP_EOL, $text);

    for($i = 0; $i < sizeof($data); $i++) {
        $data[$i] = explode(' ', $data[$i]);
    }

    return $data;
}

function cpu($data)
{
    $register   = [];
    $max        = 0;

    foreach ($data as $line) {


        if (!array_key_exists($line[0], $register)) {
            $register[$line[0]] = 0;
        }

        if (!array_key_exists($line[4], $register)) {
            $register[$line[4]] = 0;
        }

        $x = $register[$line[4]];
        $s = $line[5];
        $y = $line[6];

        if (operation($x, $y, $s)) {

            $v = 0;

            if ($line[1] == 'inc') {
                $v = $register[$line[0]] = $register[$line[0]] + $line[2];
            }

            if ($line[1] == 'dec') {
                $v = $register[$line[0]] = $register[$line[0]] - $line[2];
            }

            if ($v >  $max) {
                $max = $v;
            }
        };

    }

    var_dump('R2 = ', $max);
    return max($register);
}

function operation($x, $y, $s)
{
    switch ($s) {
        case '>':
            return $x > $y;
        case '>=':
            return $x >= $y;
        case '==' :
            return $x == $y;
        case '<=':
            return $x <= $y;
        case '<':
            return $x < $y;
        case '!=':
            return $x != $y;
    }
}