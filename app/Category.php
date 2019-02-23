<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id', 'name', 'url', 'user_create_id', 'user_update_id'
    ];

    public $table = 'categories';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public static function getAll()
    {
        return self::all();
    }

    public static function getById($categoryId)
    {
        return self::where('id', $categoryId)->first();
    }

    public static function getByName($categoryName)
    {
        return self::where('name', $categoryName)->first();
    }

    public static function getByUserId($userId)
    {
        return self::where('user_create_id', $userId)->get();
    }

    public static function createCategory($name, $url, $userId)
    {
        self::create(['name' => $name, 'url' => $url, 'user_create_id' => $userId]);
    }

    public function updateCategory($categoryId, $newName, $userId)
    {
        return self::where('id', $categoryId)
            ->update([
                'name' => $newName,
                'user_update_id' => $userId
            ]);
    }

    public function deleteCategory($categoryId)
    {
        $category = self::find('id', $categoryId);
        return $category->delete();
    }

}
