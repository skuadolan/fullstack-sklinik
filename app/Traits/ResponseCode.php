<?php

namespace App\Traits;

use App\Traits\Tools;

trait ResponseCode
{
    use Tools;

    private $success = "Berhasil memproses data!";
    private $failed = "Gagal memproses data!";

    public function OKE($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->success);
        return response()->json($this->ajaxJSONReturn(200, "success", $msg, $datas), 200);
    }

    public function CREATED($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->success);
        return response()->json($this->ajaxJSONReturn(201, "success", $msg, $datas), 201);
    }

    public function ACCEPTED($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->success);
        return response()->json($this->ajaxJSONReturn(202, "success", $msg, $datas), 202);
    }

    public function BAD_REQUEST($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->failed);
        return response()->json($this->ajaxJSONReturn(400, "failure", $msg, $datas), 400);
    }

    public function UNAUTHORIZED($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->failed);
        return response()->json($this->ajaxJSONReturn(401, "failure", $msg, $datas), 401);
    }

    public function FORBIDDEN($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->failed);
        return response()->json($this->ajaxJSONReturn(403, "failure", $msg, $datas), 403);
    }

    public function NOT_FOUND($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->failed);
        return response()->json($this->ajaxJSONReturn(404, "failure", $msg, $datas), 404);
    }

    public function UNPROCESS_ENTITY($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->failed);
        return response()->json($this->ajaxJSONReturn(422, "failure", $msg, $datas), 422);
    }

    public function TO_MANY_REQ($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->failed);
        return response()->json($this->ajaxJSONReturn(429, "failure", $msg, $datas), 429);
    }

    public function SERVER_ERROR($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->failed);
        return response()->json($this->ajaxJSONReturn(500, "failure", $msg, $datas), 500);
    }

    public function SERVER_TIMEOUT($datas = null, $msg = null)
    {
        $msg = ($msg ?: $this->failed);
        return response()->json($this->ajaxJSONReturn(504, "failure", $msg, $datas), 504);
    }
}
