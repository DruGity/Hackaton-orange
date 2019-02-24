<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Helper\CloudinaryHelper;

class Article extends Model
{
    protected $fillable = [
        'id',
        'name',
        'content',
        'url',
        'category_id',
        'is_active',
        'is_main',
        'user_create_id',
        'user_update_id',
        'image_public_id',
        'image'
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
        $uploadImage = CloudinaryHelper::saveImageInClouder($image);

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

    public function updateArticle($articleId, $name, $content, $categoryId, $image,$userId)
    {
        $article = self::where('id', $articleId)->first();

        if (empty($name)) {
            $name = $article->name;
        }

        if (empty($content)) {
            $content = $article->content;
        }

        if (empty($image)) {
            $image = $article->image;
        }

        $article->update([
                'name' => $name,
                'content' => $content,
                'category_id' => $categoryId,
                'image' => $image,
                'user_update_id' => $userId,
            ]);
    }

    public function getMain()
    {
        $article = self::where('is_main', true)->first();

        if(!$article)
            $article = $this->getLastAddedArticle();

        return $article;
    }

    public function changeIsActive($articleId)
    {
        $article = $this->getById($articleId);
        if($article){
            $article->setAttribute('is_active', !$article->is_active);
            $article->save();
            return $article;
        }
        return null;
    }


    public function deleteArticle($articleId)
    {
        $article = self::find($articleId);
        if($article) {
            CloudinaryHelper::deleteImageFromCloudinary($article->image_public_id);
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

    public function getLastAddedArticle()
    {
        return $article = DB::table($this->table)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function getById($articleId)
    {
        return self::find($articleId);
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

    public function getByUrl($url)
    {
        return self::with('user')
            ->where('url', $url)
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

    public function setMain($id)
    {
        $this->replaceIsMain();
        $article = self::find($id);
        if($article) {
            $article->update([
                'is_main' => true
            ]);

            return $article;
        }
        return null;
    }
}
