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
        $article = Article::getById($request->articaleId);

        return response()->json([$article], 200);
    }

    public function createArticle(Request $request)
    {
        Article::createArticle(
            $request->articleName,
            $request->content,
            $request->categoryId,
            $request->image,
            $request->url,
            $request->userId
        );

        return response()->json(['message' => 'Article successfully added!'], 201);
    }

    public static function updateArticle(Request $request)
    {
        switch ($request) {
            case (isset($request->newName) && !empty($request->newName)):
                Article::updateName($request->articleId, $request->newName);
                break;

            case (isset($request->content) && !empty($request->content)):
                Articles::updateContent($request->articleId, $request->content);
                break;

            default:
                return response()->json(['message' => 'Your data are not valid!']);
                break;
        }
    }

    public function deleteArticle(Request $request)
    {
        Article::deleteArticle($request->articleId);

        return response()->json(
            ['message' => 'Article ' . $request->articleId . 'successfully delete!'], 200
        );
    }
}
