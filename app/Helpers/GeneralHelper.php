<?php

if (!function_exists("getVarVal")) {
    function getVarVal($var, $key = null, $default = null)
    {
        $tmpReturn = (isset($var) && !empty($var) ? $var : $default);

        if (is_array($tmpReturn) && isset($key) && !empty($key)) {
            if (is_string($key) || is_numeric($key)) {
                $tmpReturn = (isset($tmpReturn[$key]) && !empty($tmpReturn[$key]) ? $tmpReturn[$key] : $tmpReturn);
            }
        }

        return (is_string($tmpReturn) ? trim($tmpReturn) : $tmpReturn);
    }
}

if (!function_exists("isValEmpty")) {
    function isValEmpty($var, $key = null): bool
    {
        $tmpReturn = getVarVal($var, $key);

        return empty($tmpReturn);
    }
}

if (!function_exists("isValNotEmpty")) {
    function isValNotEmpty($var, $key = null): bool
    {
        $tmpReturn = getVarVal($var, $key);

        return !empty($tmpReturn);
    }
}

if (!function_exists("arrayApiReturn")) {
    function arrayApiReturn(int $code, string $status = "", string $message = "", $data = []): array
    {
        return [
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
}

if (!function_exists("stringToArray")) {
    function stringToArray($string): array
    {
        return json_decode($string, true);
    }
}

if (!function_exists("arrayToString")) {
    function arrayToString($array): string
    {
        return json_encode($array);
    }
}