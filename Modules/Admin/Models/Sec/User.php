<?php
/**
 * Created by PhpStorm.
 * User: paz
 * Date: 2019-12-31
 * Time: 16:13
 */

namespace Modules\Admin\Models\Sec;



use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //如果数据库中字段 不是created_at updated_at 则在这里指定
    //const CREATED_AT = '';
    //const UPDATED_AT = '';

    protected $table = "t_sec_user";

    protected $fillable = ['id','account','password','nick_name','avatar','true_name', 'sec_mail', 'gender'];

    protected $hidden = [
        'password'
    ];


}
