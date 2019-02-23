<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id', 'name', 'content', 'user_create_id', 'user_update_id'
    ];

    const MAIN_ARTICLE = 1;

    public static function createArticle($articleName, $content,
        $categoryId, $isActive, $image, $url, $userId)
    {
        self::create([
            'name' => $articleName,
            'content' => $content,
            'category_id' => $categoryId,
            'image' => $image,
            'is_active' => $isActive,
            'url' => $url,
            'user_create_id' => $userId
        ]);
    }

    public static function updateName($articleId, $newName)
    {
        self::where('id', $articleId)->update(['name' => $newName]);
    }

    public static function updateContent($articleId, $content)
    {
        self::where('id', $articleId)->update(['content' => $content]);
    }

    public static function deleteArticle($articleId)
    {
        $article = self::find('id', $articleId);
        $article->delete();
    }

    public static function getArticles($sortField, $sortType, $limit, $categoryId)
    {
        $articles = self::with('category.id', $categoryId)
            ->orderBy($sortField, $sortType)->paginate($limit);

        return $articles;
    }

    {
        return self::with('user')->all();
    }

    public static function getById($articleId)
    {
        return self::with('user')->where('id', $articleId)->first();
    }

    public static function getByName($articleName)
    {
        return self::with('user')->where('name', $articleName)->first();
    }

    public static function getByUser($userId)
    {
        return self::with('user')->where('user_create_id', $userId)->get();
    }

    public static function checkForIsMain($articleId)
    {
        $article = self::find('id', $articleId);

        if ($article->isMain === self::MAIN_ARTICLE) {
            return true;
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
