<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createUser($email, $password, $name, $roleId = Role::USER)
    {
        return self::create(['email' => $email, 'password' => $password, 'name' => $name, 'role' => $roleId]);
    }

    public function setRole($userId, $roleId)
    {
        self::where('id', $userId)->update(['role_id' => $roleId]);
    }

    public function updateEmail($userId, $newEmail)
    {
        self::where('id', $userId)->update(['email' => $newEmail]);
    }

    public function updateName($userId, $newName)
    {
        self::where('id', $userId)->update(['name' => $newName]);
    }

    public function deleteUser($userId)
    {
        $user = self::find('id', $userId);
        $user->delete();
    }

    public function getAll()
    {
        return $users = self::with('role')->all();
    }

    public function getById($id)
    {
        return $user = self::with('role')->where('id', $id)->first();
    }

    public function getByEmail($email)
    {
        return $user = self::with('role')->where('email', $email)->first();
    }

    public function getByName($name)
    {
        return $user = self::with('role')->where('name', $name)->first();
    }

    public function getRole()
    {
        return $this->role;
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
