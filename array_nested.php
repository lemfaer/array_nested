<?php

/**
 * Set/Get a nested array value
 *
 * @param array &$array
 * @param array $path path to value
 * @param mixed $value value to set
 *
 * @return mixed previous value
 */
function array_nested(array &$array, $path, $value = null)
{
    $ref =& $array;
    $path = array_values($path);
    $count = count($path);

    foreach ($path as $i => $key) {
        if (!is_array($ref)) {
            return;
        }

        if (
            !array_key_exists($key, $ref)
            && func_num_args() > 2
            && $i < $count - 1
        ) {
            $ref[$key] = array();
        }

        $ref =& $ref[$key];
    }

    $prev = $ref;
    if (func_num_args() > 2) {
        $ref = $value;
    }

    return $prev;
}
