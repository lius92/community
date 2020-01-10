<?php
/**
 * Created by PhpStorm.
 * User: paz
 * Date: 2019-12-31
 * Time: 16:33
 */

namespace Modules\Admin\Http\Controllers\Sec;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Modules\Admin\Http\Controllers\BaseController;
//use Modules\Admin\Services\Sec\UserService;

class UserController extends BaseController
{
    private $userService;

    public function __construct(
        //UserService $userService
    )
    {
        //$this->userService = $userService;
    }

    public function get(string $id)
    {
        //$result = $this->userService->get($id);
        //var_dump(Auth::user());
        return $this->success();
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

        if (!$account || !$password) {
            return $this->failed(1000);
        }

        $result = $this->userService->create($account, $password, $nickName,  $avatar, $trueName,
            $gender, $idCardNo, $secEmail);

        if ($result['result'] === false) {
            return $this->failed(-1, $result['message']);
        }

        return $this->success();
    }

    public function login(Request $request) {
        $account = $request->input('account');
        $password = $request->input('password');

        if ($token = auth('api')->attempt(['account' => $account,'password' => $password])) {
            $user_info['token'] = $token;
            return $this->success($user_info);
        } else {
            return $this->failed(-1, '用户名或密码错误');
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return $this->success();
    }

}
