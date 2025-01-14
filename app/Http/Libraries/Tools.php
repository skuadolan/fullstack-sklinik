<?php

namespace App\Http\Libraries;

class Tools
{
    public function IsValidVal($val, $get = ["bool", "value", "equal"], $other = null, $key = null) {
        $val = (isset($key) && $key != null ? (isset($val[$key]) && !empty($val[$key]) ? $val[$key] : $val) : (isset($val) && !empty($val) ? $val : null));
        if (isset($val)) {
            if ($get == "value") {
                if (isset($other) && $other != null) {
                    return !empty($val) || ($val == 0) ? $val : $other;
                }  else {
                    return !empty($val) || ($val == 0) ? $val : "";
                }
            } else if (isset($other) && $other != null && $get == "equal") {
                return $val == $other;
            } else if (!empty($val)) {
                return true;
            } else {
                return false;
            }
        }

        return ($get == "value" ? "" : false);
    }
}
