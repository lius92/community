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
    protected $table = "t_sec_user";

    protected $fillable = ['id','account','password','nick_name','avatar','true_name', 'sec_mail', 'gender'];

    protected $hidden = [
        'password'
    ];


}