<?php
/**
 * Created by PhpStorm.
 * User: paz
 * Date: 2019-12-31
 * Time: 16:34
 */

namespace Modules\Admin\Services\Sec;


use Modules\Admin\Services\BaseService;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Models\Sec\User;

class UserService extends BaseService
{
    private $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function get(string $id) {
        return DB::select('select * from t_sec_user where id = ?', [$id]);
    }

    public function create(string $account, string $password, string $nickName, string $avatar, string $trueName,
                           int $gender, string $idCardNo, string $secEmail) {

        if (User::where('account','=',$account)->first()){
            return ['result' => false, 'message' => '该账号已存在'];
        }

        $user = new  User();
        $user->account = $account;
        $user->password = bcrypt($password);
        $user->nick_name = $nickName;
        $user->avatar = $avatar;
        $user->gender = $gender;
        $user->description = '';
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');

        if ($user->save() === false) {
            return ['result' => false, 'message' => '保存失败'];
        }

        return ['result' => true, 'message' => 'success'];
    }

}
