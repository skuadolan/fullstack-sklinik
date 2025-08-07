<?php

namespace App\Traits;

use App\Traits\Tools;

use Illuminate\Support\Facades\Log;

trait JsonAPIResponse
{
    use Tools;

    private array $statusStr = [
        0 => "Gagal",
        1 => "Berhasil",
        2 => "Success",
        3 => "Error"
    ];

    private array $statusCodeMsg = [
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        400 => "Bad Request",
        401 => "Unauthorized",
        403 => "Forbidden",
        404 => "Not Found",
        422 => "Unprocessable Entity",
        429 => "Too Many Requests",
        500 => "Internal Server Error",
        504 => "Gateway Timeout"
    ];

    public function RESPONSE(int $code = 200, int $status = 1, string $msg = "", $datas = [])
    {
        if ($this->isValEqual($status, null, 3)) {
            Log::info("KESALAHAN! RESPONSE API 500: ", ["error" => $datas]);
        }

        $msg = ($this->valNotEmpty($msg) ? $msg : $this->statusCodeMsg[$code]);
        return response()->json($this->ajaxReturn($code, $this->statusStr[$status], $msg, $datas), $code);
    }

    public function RESPONSE_ERR($err, string $errMsg)
    {
        if ($this->isValEqual($err->getMessage(), null, 400)) {
            return $this->RESPONSE(400, 0, $errMsg);
        } elseif ($this->isValEqual($err->getMessage(), null, 401)) {
            return $this->RESPONSE(401, 0, $errMsg);
        } elseif ($this->isValEqual($err->getMessage(), null, 403)) {
            return $this->RESPONSE(403, 0, $errMsg);
        } elseif ($this->isValEqual($err->getMessage(), null, 404)) {
            return $this->RESPONSE(404, 0, $errMsg);
        } elseif ($this->isValEqual($err->getMessage(), null, 429)) {
            return $this->RESPONSE(429, 0, $errMsg);
        }

        return $this->RESPONSE(500, 3, $errMsg, $err->getMessage());
    }
}
