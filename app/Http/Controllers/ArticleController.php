<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Article;
use App\Category;

class ArticleController extends Controller
{
    public function getArticles(Request $request, Article $article)
    {
        $articles = $article->getArticles(
            $request->get('sort_field'),
            $request->get('sort_type'),
            $request->get('limit')
        );

        return response()->json($articles, 200);
    }

    public function getAllArticles(Request $request, Article $article)
    {
        $articles = $article->getAllArticles(
            $request->get('sort_field'),
            $request->get('sort_type'),
            $request->get('limit')
        );

        return response()->json($articles, 200);
    }

    public function getArticlesByCategory($categoryId, Article $articleModel)
    {
        $articles = $articleModel->getArticlesByCategory(Category::find($categoryId));
        return response()->json($articles, 200);
    }

    public function getArticleById(Article $article, $id)
    {
        $article = $article->getById($id);

        return response()->json($article, 200);
    }

    public function getMain(Article $articleModel)
    {
        $article = $articleModel->getMain();
        if($article){
            return response()->json([$article], 200);
        }
        return response()->json(null, 200);
    }

    public function getArticleByUrl($url, Article $articleModel)
    {
        $article = $articleModel->getByUrl($url);
        if($article)
            return response()->json($article, 200);
        return response()->json(null, 200);
    }

    public function createArticle(Request $request, Article $article)
    {
        $isMain = $request->post('is_main');
        if(isset($isMain) && $isMain == true) {
            $article->replaceIsMain();
        }

        $article->createArticle(
            $request->post('name'),
            $request->post('content'),
            $request->post('category_id'),
            $request->post('url'),
            null,
//            Auth::user()->id,
            $request->post('image'),
            true,
            false
        );

        return response()->json(['message' => 'Article successfully added!'], 201);
    }

    public function updateArticle(Request $request, Article $article)
    {
        $isMain = $request->post('is_main');
        if(isset($isMain) && $isMain == true) {
            $article->replaceIsMain();
        }
        $article->updateArticle(
            $request->post('article_id'),
            $request->post('name'),
            $request->post('content'),
            $request->post('category_id'),
            $request->post('image'),
            null
        );
    }

    public function changeIsActiveStatus($id, Request $request, Article $articleModel)
    {
        if($articleModel->changeIsActive($id))
            return response()->json('Status successfully changed!', 200);
        else
            return response()->json(null,400);
    }

    public function deleteArticle($articleId,Request $request, Article $articleModel)
    {
        $id = $articleId;
        $articleModel->deleteArticle($id);

        return response()->json(null, 204);
    }

    public function getCommentsByArticle($articleId, Article $articleModel)
    {
        $articleWithComments = $articleModel->getById($articleId);
        if($articleWithComments){
            $articleWithComments->load('comments.user');
            return response()->json($articleWithComments, 200);
        }
        return response()->json(null, 204);
    }

    public function setMain($id, Article $articleModel)
    {
        $article = $articleModel->setMain($id);
        if($article)
            return response()->json([$article], 200);

        return response()->json(null, 400);
    }
}
