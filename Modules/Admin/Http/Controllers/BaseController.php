<?php
/**
 * Created by PhpStorm.
 * User: paz
 * Date: 2019-12-30
 * Time: 19:38
 */

namespace Modules\Admin\Http\Controllers;


use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public function success($data = []) {
        return response()->json([
            'code' => 0,
            'message' => config('errorcode.code')[200],
            'data' => $data
        ]);
    }

    public function fail($code, $data = []) {
        return response()->json([
            'code' => $code,
            'message' => config('errorcode.code')[$code],
            'data' => $data
        ]);
    }

}