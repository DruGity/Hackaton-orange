<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'id', 'name', 'add_user_role', 'add_post', 'add_comment'
    ];

    const USER = 0;
    const ADMIN = 1;

    public function getRoleName($roleId)
    {
        switch ($roleId) {

            case ($roleId == self::USER):
                return 'User';
                break;

            case ($roleId == self::Admin):
                return 'Admin';
                break;
        }
    }


    public static function checkIsAdmin($roleId)
    {
        if ($roleId == self::ADMIN) {
            return true;
        }
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

}
