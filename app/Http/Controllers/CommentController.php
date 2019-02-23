<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment'	=>	'required'
        ]);

        $comment = new Comments;
        $comment->comment = $request->get('comment');
        $comment->user_id = $request->get('user_id');//Auth::user()->id;
        $comment->article_id = $request->get('article_id'); //$request->get('post_id');
        $comment->save();

        return response()->json([
            'message' => 'add comment',
        ], 200);

    }
}
