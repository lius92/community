<?php
/**
 * Created by PhpStorm.
 * User: paz
 * Date: 2019-12-31
 * Time: 16:34
 */

namespace Modules\Admin\Services\Sec;


use Modules\Admin\Services\BaseService;

use Modules\Admin\Models\Sec\User;

class UserService extends BaseService
{
    private $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
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
        $user->true_name = $trueName;
        $user->gender = $gender;
        $user->id_card_no = $idCardNo;
        $user->sec_email = $secEmail;
        $user->description = '';
        $user->meta_created = date('Y-m-d H:i:s');
        $user->meta_updated = date('Y-m-d H:i:s');
        $user->meta_logic_flag = 1;

        if ($user->save() === false) {
            return ['result' => false, 'message' => '保存失败'];
        }

        return ['result' => true, 'message' => 'success'];
    }

}