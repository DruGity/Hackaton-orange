<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function  getAllComments(Comments $commentsModel)
    {
        return response()->json($commentsModel->getAllComments(), 200);
    }

    public function getCommentById($id, Comments $commentsModel)
    {
        return response()->json($commentsModel->getById($id), 200);
    }

    public function getCommentByArticleId($articleId, Comments $commentsModel)
    {
        return response()->json($commentsModel->getByArticleId($articleId), 200);
    }

    public function store(Request $request, Comments $comments)
    {
        $this->validate($request, [
            'comment'	=>	'required'
        ]);

        $comment = $request->post('comment');
        $userId = Auth::user()->id;
        $articleId = $request->post('article_id');
        $parentId = $request->post('parent_id');
        $comment = $comments->createComment($comment, $userId, $articleId, $parentId);
        if($comment) {
            return response()->json([
                'message' => 'add comment',
            ], 200);
        }else{
            return response()->json([
                'message' => 'something went wrong'
            ], 500);
        }

    }
}
