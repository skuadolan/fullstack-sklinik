<?php

namespace App\Traits;

use DateTime;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait Tools
{
    public function arryToJson(array $arry)
    {
        return json_encode($arry, JSON_PRETTY_PRINT);
    }

    public function jsonToArry(string $json)
    {
        return json_decode($json, true);
    }

    public function objToArry(string $obj)
    {
        return json_decode(json_encode($obj), true);
    }

    public function isValidVal(string $get = 'bool', $val, $key = null, $other = null)
    {
        switch ($get) {
            case 'value':
                return $this->getVarValue($val, $key, $other);
            case 'equal':
                return $this->isValEqual($val, $key, $other);
            default:
                return $this->valNotEmpty($val, $key);
        }
    }

    public function getVarValue($val, $key = null, $default = null)
    {
        $tmp = ($this->strictNotEmpty($default) ? $default : null);
        if ($key !== null && is_array($val)) {
            if (array_key_exists($key, $val)) {
                $tmp = ($this->strictNotEmpty($val[$key]) ? $val[$key] : $tmp);
            }
        } else {
            $tmp = ($this->strictNotEmpty($val) ? $val : $tmp);
        }

        return (is_string($tmp) && $this->strNotEmpty($tmp) ? trim($tmp) : $tmp);
    }

    public function isValEqual($var, $key = null, $value)
    {
        return $this->getVarValue($var, $key) == $value;
    }

    public function valNotEmpty($var, $key = null)
    {
        $tmp = $this->getVarValue($var, $key);
        return $this->strictNotEmpty($tmp);
    }

    public function strictNotEmpty($var)
    {
        return isset($var) && !empty($var);
    }

    public function strNotEmpty(string $var)
    {
        return $this->strictNotEmpty($var) && (strlen($var) > 0) && ($var !== "") && ($var !== null);
    }

    public function ajaxReturn(int $code, string $status, string $msg, array $data = [])
    {
        $return = [
            'code' => $code,
            'status' => $status,
            'message' => $msg,
            'data' => $data
        ];
        return $return;
    }

    public function IsValidAddress($req)
    {
        $tmp = $this->objToArry($req);
        $wheres = ($this->valNotEmpty($tmp, 'id_provinsi') ? " WHERE prov.id = '$req->id_provinsi' AND " : " WHERE ");
        $wheres .= ($this->valNotEmpty($tmp, 'id_kabupaten') ? " kab.id = '$req->id_kabupaten' AND " : "");
        $wheres .= ($this->valNotEmpty($tmp, 'id_kecamatan') ? " kec.id = '$req->id_kecamatan' AND " : "");
        $wheres .= ($this->valNotEmpty($tmp, 'id_kelurahan') ? " kel.id = '$req->id_kelurahan' AND " : "");
        $wheres .= ($this->valNotEmpty($tmp, 'q') ? " LOWER(kel.name) LIKE LOWER('{$tmp['q']}%') " : " 1=1 ");

        $qry = "SELECT kel.id id_kelurahan, kel.name kelurahan, kel.postal_code kode_pos, kec.id id_kecamatan, kec.name kecamatan, kab.id id_kabupaten, kab.name kabupaten, prov.id id_provinsi, prov.name provinsi
        FROM kelurahan kel JOIN kecamatan kec ON kec.id = kel.id_kecamatan JOIN kabupaten kab ON kab.id = kec.id_kabupaten JOIN provinsi prov ON prov.id = kab.id_provinsi $wheres ORDER BY prov.name, kab.name, kec.name, kel.name ASC";
        return DB::select($qry);
    }

    public function ReformatDateTime(string $date, string $format = "Y-m-d H:i:s", $toDB = true)
    {
        if ($toDB && env("DB_CONNECTION") === "mysql") {
            return Carbon::parse($date)->format("Y-m-d H:i:s");
        }

        return Carbon::parse($date)->format("$format");
    }

    public function ReformatNoRM($id_pasien)
    {
        $id_pasien = $this->getVarValue($id_pasien);
        return str_pad($id_pasien, 7, '0', STR_PAD_LEFT);
    }

    public function UserAgent()
    {
        return request()->header('User-Agent');
    }

    public function ReqValidation($req, $form)
    {
        return $req->validate($form);
    }

    public function GetUserIDFromRequest($req, $userSession)
    {
        $tmp = $this->objToArry($req);
        $id_user = $this->getVarValue($userSession, 'id_user', Auth::id());
        $id_user = $this->getVarValue($tmp, 'id_user', $id_user);
        return $this->getVarValue($id_user);
    }

    public function GetClientIDFromRequest($req, $userSession)
    {
        $tmp = $this->objToArry($req);
        $id_client = $this->getVarValue($userSession, 'id_client', Auth::user()->id_client);
        $id_client = $this->getVarValue($tmp, 'id_client', $id_client);
        return $this->getVarValue($id_client);
    }

    public function IsValidDateTime(string $val, string $format = "Y-m-d H:i:s")
    {
        return (bool) DateTime::createFromFormat($format, $val);
    }

    public function GetAgedByBirthDate(string $val, string $format = "Y-m-d H:i:s")
    {
        if (!$this->IsValidDateTime($val, $format)) {
            return null;
        }
        return Carbon::createFromFormat($format, $val)->age;
    }

    public function unsetNewDataRecord($var) {
        unset($var['id_user_created']);

        unset($var['id_user_updated']);
        unset($var['updated_at']);

        unset($var['id_user_deleted']);
        unset($var['deleted_at']);
    }
}
