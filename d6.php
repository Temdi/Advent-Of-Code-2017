<?php

# http://adventofcode.com/2017/day/6

begin();

function begin()
{
    $inputString    = file_get_contents('data/d6.txt');
    $input          = getData($inputString);

    $r1             = banks($input)['R1'];
    $r2             = banks($input)['R2'];

    var_dump($r1);
    var_dump($r2);
}

function getData(string $text)
{
    return explode(',', $text);
}

function banks($data)
{
    $patternSeen    = [];
    $nextPattern    = '';

    while(!in_array($nextPattern, $patternSeen)) {

        $patternSeen[]  = implode(',', $data);

        $maxV = max($data);
        $maxK = array_search($maxV, $data);

        $i = $maxK + 1;

        while($maxV > 0) {

            if ($i >= count($data)) { $i = 0; }

            $data[$i]++;
            $i++;

            $maxV--;
            $data[$maxK]--;

        }

        $nextPattern = implode(',', $data);
    }

    // R1
    $R1             = count($patternSeen);

    // R2
    $firstSeenK     = array_search($nextPattern, $patternSeen);
    $lastSeenK      = $R1;
    $R2             = $lastSeenK - $firstSeenK;

    return ['R1' => $R1, 'R2' => $R2];
}