<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Article;

class ArticleController extends Controller
{
    public function getArticles(Request $request, Article $article)
    {
        $articles = $article->getArticles(
            $request->get('sort_field'),
            $request->get('sort_type'),
            $request->get('limit')
//            $request->get('page')
        );

        return response()->json($articles, 200);
    }

    public function getArticlesByCategory($categoryId, Request $request, Article $articleModel)
    {
        $articles = $articleModel->getArticlesByCategory($categoryId);
        return response()->json($articles, 200);
    }

    public function getArticleById(Request $request, Article $article)
    {
        $article = $article->getById($request->post('article_id'));

        return response()->json($article, 200);
    }

    public function createArticle(Request $request, Article $article)
    {
        $validator = $request->validate([
            'photo' => 'file|image|required'
        ]);

        $image = $request->file('image');

        $article->createArticle(
            $request->post('name'),
            $request->post('content'),
            $request->post('category_id'),
            $request->post('url'),
            Auth::user()->id,
            $image,
            $request->post('is_active'),
            $request->post('is_main')
        );

        return response()->json(['message' => 'Article successfully added!'], 201);
    }

    public static function updateArticle(Request $request, Article $articleModel)
    {
        $articleModel->updateArticle(
            $request->post('article_id'),
            $request->post('name'),
            $request->post('content'),
            $request->post('category_id'),
            $request->post('image'),
            $request->post('url'),
            Auth::user()->id,
            $request->post('is_active'),
            $request->post('is_main')
        );
    }

    public function deleteArticle(Request $request, Article $articleModel)
    {
        $articleModel->deleteArticle($request->post('article_id'));

        return response()->json(
            ['message' => 'Article ' . $request->post('article_id') . 'successfully delete!'], 200
        );
    }

    public function getCommentsByArticle($articleId, Article $articleModel)
    {
        $articleWithComments = $articleModel->getById($articleId)
            ->load('comments.user');
        return response()->json($articleWithComments, 200);
    }
}
