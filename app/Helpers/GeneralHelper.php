<?php

if (! function_exists('getVarValue')) {
    function getVarValue($var, $key = null, $default = null)
    {
        $tmpValue = (! empty($var) && ($var != null) ? $var : $default);

        if (is_array($tmpValue) && ! empty($key) && ($key != null) && (is_string($key) || is_numeric($key))) {
            $tmpValue = (isset($tmpValue[$key]) && ! empty($tmpValue[$key]) ? $tmpValue[$key] : $default);
        }

        return is_string($tmpValue) ? trim($tmpValue) : $tmpValue;
    }
}

if (! function_exists('isValEmpty')) {
    function isValEmpty($var, $key = null): bool
    {
        $tmpReturn = getVarValue($var, $key);

        return empty($tmpReturn);
    }
}

if (! function_exists('isValNotEmpty')) {
    function isValNotEmpty($var, $key = null): bool
    {
        $tmpReturn = getVarValue($var, $key);

        return ! empty($tmpReturn);
    }
}

if (! function_exists('isValEqual')) {
    function isValEqual($var, $equal, $key = null): bool
    {
        $tmpReturn = getVarValue($var, $key);

        return $tmpReturn == $equal;
    }
}

if (! function_exists('arryApiReturn')) {
    function arryApiReturn(int $code, string $status, string $message, array $metaData = []): array
    {
        return [
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'metaData' => $metaData,
        ];
    }
}

if (! function_exists('jsonToArry')) {
    function jsonToArry($var, $key = null): array
    {
        $tmpReturn = getVarValue($var, $key);

        if (is_string($tmpReturn)) {
            $tmpReturn = json_decode($tmpReturn, true);
        } elseif (is_object($tmpReturn)) {
            $tmpReturn = (array) $tmpReturn;
        }

        return $tmpReturn;
    }
}

if (! function_exists('arryToJson')) {
    function arryToJson($var): string
    {
        return json_encode($var, JSON_PRETTY_PRINT);
    }
}
