<?php

/**
 * Parses a string of binary into a list of associated messages
 * @return array
 */
function interpret(string $stream): array
{
    $bits = str_split($stream);
    $result = [];

    for ($i = 0; $i < count($bits); $i += 2) {
        $b1 = array_key_exists($i, $bits) ? $bits[$i] : '';
        $b2 = array_key_exists($i + 1, $bits) ? $bits[$i + 1] : '';
        $code = $b1 . $b2;

        if ($code === '00')
            array_push($result, 'Start');
        elseif ($code === '01')
            array_push($result, 'Add');
        elseif ($code === '10')
            array_push($result, 'Sub');
        elseif ($code === '11')
            array_push($result, 'End');
    }

    return $result;
}
