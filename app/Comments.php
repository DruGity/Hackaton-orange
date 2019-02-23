<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public $fillable = ['comment', 'user_id', 'article_id', 'parent_id'];

    protected $table = 'comments';

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function getById($id)
    {
        return self::find($id)->load( 'user', 'children');
    }


    public function getAllComments()
    {
        return self::where('parent_id', '=', null)
            ->get()
            ->load( 'user' ,'children');
    }


    public function createComment($commentText, $userId, $articleId, $parentId = null)
    {
        $comment = new self();
        $comment->setAttribute('comment', $commentText);
        $comment->setAttribute('user_id', $userId);
        $comment->setAttribute('article_id', $articleId);
        $comment->setAttribute('parent_id', $parentId);
        $comment->save();
        return $comment;
    }

    public function deleteComment($id)
    {
        $comment = self::find($id);
        return $comment->delete();
    }
}
