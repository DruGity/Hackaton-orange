<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

class ArticleController extends Controller
{
    public function getArticles(Request $request)
    {
        $articles = Article::getArticles(
            $request->sortField,
            $request->sortType,
            $request->limit,
            $request->categoryId
        );

        return response()->json(['articles' => $articles], 200);
    }

    public function getArticleById(Request $request)
    {
        $article = Article::getById($request->post('article_id'));

        return response()->json([$article], 200);
    }

    public function createArticle(Request $request)
    {
        Article::createArticle(
            $request->post('name'),
            $request->post('content'),
            $request->post('category_id'),
            $request->post('image'),
            $request->post('url'),
            Auth::user()->id
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
            $request->post('user_id'),
            $request->post('is_active'),
            $request->post('is_main')
        );
    }

    public function deleteArticle(Request $request)
    {
        Article::deleteArticle($request->post('article_id'));

        return response()->json(
            ['message' => 'Article ' . $request->post('article_id') . 'successfully delete!'], 200
        );
    }

    public function getCommentsByArticle($articleId, Article $articleModel)
    {
        $articleWithComments = $articleModel->getById($articleId)
            ->load('comments.user', 'comments.article');
        return response()->json($articleWithComments, 200);
    }
}
