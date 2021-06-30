<?php

/**
 * Processes a list of messages and returns the total
 * @param $messages array of messages to execute
 * @return int|null the result of the computation or null if none
 */
function process(array $messages): int|null
{
    $started = false;
    $total = null;

    foreach ($messages as $message) {
        if ($message === 'Start') {
            $started = true;
            $total = 0;
        } elseif ($message === 'Add' && $started)
            $total++;
        elseif ($message === 'Sub' && $started)
            $total--;
        elseif ($message === 'End')
            $started = false;
    }

    return $total;
}
