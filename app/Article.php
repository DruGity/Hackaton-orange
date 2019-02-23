<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cloudder;

class Article extends Model
{
    protected $fillable = [
        'id', 'name', 'content', 'user_create_id', 'user_update_id'
    ];

    const MAIN_ARTICLE = 1;
    const NOT_MAIN_ARTICLE = 0;
    const ACTIVE_ARTICLE = 0;
    const NOT_ACTIVE_ARTICLE = 1;

    public  function createArticle(
        $articleName,
        $content,
        $categoryId,
        $url,
        $userId,
        $image,
        $isActive = self::ACTIVE_ARTICLE,
        $isMain = self::NOT_MAIN_ARTICLE
    ){
        $uploadImage = self::saveImageInClouder($image);

        self::create([
            'name' => $articleName,
            'content' => $content,
            'category_id' => $categoryId,
            'is_active' => $isActive,
            'is_main' => $isMain,
            'url' => $url,
            'user_create_id' => $userId,
            'image' => $uploadImage->getResult()['url'],
            'image_public_id' => $uploadImage->getResult()['public_id']
        ]);
    }

    public function updateArticle($articleId, $name, $content,$categoryId, $image,$url, $userId, $isActive, $isMain)
    {
        self::where('id', $articleId)
            ->update([
                'name' => $name,
                'content' => $content,
                'category_id' => $categoryId,
                'image' => $image,
                'url' => $url,
                'user_id' => $userId,
                'is_active' => $isActive,
                'is_main' => $isMain
            ]);
    }


    public static function deleteArticle($articleId)
    {
        $article = self::find('id', $articleId);
        Cloudder::destroyImages([$article->image_public_id], []);
        $article->delete();
    }

    public static function getArticles($sortField, $sortType, $limit, $categoryId)
    {
        $articles = self::with('category.id', $categoryId)
            ->orderBy($sortField, $sortType)->paginate($limit)->get();

        return $articles;
    }

    public function getArticlesByCategory(Category $category)
    {
        return self::where('category_id', '=', $category->id)
            ->get();
    }

    public static function getAll()
    {
        return self::with('user')->all();
    }

    public  function getById($articleId)
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

    public static function saveImageInClouder($file)
    {
        return $res = Cloudder::upload($file->getPathName(), null, [], []);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'article_id', 'id');
    }
}
