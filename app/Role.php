<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'id', 'name', 'add_user_role', 'add_post', 'add_comment'
    ];

    const GUEST = 0;
    const USER = 1;
    const ADMIN = 2;

    public static function getRoleName($roleId)
    {
        switch ($roleId) {
            case ($roleId == self::GUEST):
                return 'Guest';
                break;

            case ($roleId == self::USER):
                return 'User';
                break;

            case ($roleId == self::Admin):
                return 'Admin';
                break;

            default:
                return 'Unknown role!';
                break;
        }
    }

    public static function checkIsAdmin($roleId)
    {
        if ($roleId == self::Admin) {
            return true;
        }
    }

    public static function checkIsUser($roleId)
    {
        if ($roleId == self::USER) {
            return true;
        }
    }

    public static function checkIsGuest($roleId)
    {
        if ($roleId == self::GUEST) {
            return true;
        }
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
