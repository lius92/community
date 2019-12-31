<?php
/**
 * Created by PhpStorm.
 * User: paz
 * Date: 2019-12-31
 * Time: 16:33
 */

namespace Modules\Admin\Http\Controllers\Sec;


use Illuminate\Http\Request;

use Modules\Admin\Http\Controllers\BaseController;
use Modules\Admin\Services\Sec\UserService;

class UserController extends BaseController
{
    private $userService;

    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    public function create(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');
        $nickName = $request->input('nickName', '');
        $trueName = $request->input('trueName', '');
        $avatar = $request->input('avatar', '');
        $gender = $request->input('gender', 0);
        $idCardNo = $request->input('idCardNo', '');
        $secEmail = $request->input('secEmail', '');

        $result = $this->userService->create($account, $password, $nickName,  $avatar, $trueName,
                           $gender, $idCardNo, $secEmail);

        if ($result['result'] === false) {
            $this->fail(1000);
        }

        $this->success();
    }

}