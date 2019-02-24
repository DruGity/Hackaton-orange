<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cloudder;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $fillable = [
        'id', 'name', 'content', 'user_create_id', 'user_update_id', 'image_public_id'
    ];

    public $table = 'articles';

    const MAIN_ARTICLE = 1;
    const NOT_MAIN_ARTICLE = 0;
    const ACTIVE_ARTICLE = 0;
    const NOT_ACTIVE_ARTICLE = 1;

    public function createArticle(
        $articleName,
        $content,
        $categoryId,
        $url,
        $userId,
        $image,
        $isActive = self::ACTIVE_ARTICLE,
        $isMain = self::NOT_MAIN_ARTICLE
    )
    {
        $uploadImage = $this->saveImageInClouder($image);

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

    public function updateArticle($articleId, $name, $content, $categoryId, $image, $url, $userId, $isActive, $isMain)
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


    public function deleteArticle($articleId)
    {
        $article = self::find($articleId);
        if($article) {
//            Cloudder::destroyImages([$article->image_public_id], []);
            $article->delete();
        }
    }

    public function getArticles($sortField, $sortType, $limit)
    {
        $articles = DB::table($this->table)
            ->orderBy($sortField, $sortType)
            ->limit($limit)->get();
           /* ->paginate($limit);*/

        return $articles;
    }

    public function getArticlesByCategory(Category $category)
    {
        return self::where('category_id', '=', $category->id)
            ->get();
    }

    public function getById($articleId)
    {
        return DB::table($this->table)
            ->where('id', '=', $articleId)
            ->get();
    }

    public function getByName($articleName)
    {
        return self::with('user')
            ->where('name', $articleName)
            ->first();
    }

    public function getByUser($userId)
    {
        return self::with('user')
            ->where('user_create_id', $userId)
            ->get();
    }

    public function replaceIsMain()
    {
        $articles = self::where('is_main', '=', true)->get();

        foreach ($articles as $article) {
            $article->update([
                'is_main' => false
            ]);
        }
    }

    public function saveImageInClouder($file)
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
