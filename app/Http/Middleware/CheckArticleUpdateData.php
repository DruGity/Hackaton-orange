<?php

namespace App\Http\Middleware;

use Closure;
use App\Article;

class CheckArticleUpdateData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $articleModel = new Article();
        $article = $articleModel->getById($request->post(article_id);

        if (empty($request->post('name')) {
            $request->post('name') = $article->name;
        }

        if (empty($request->post('content')) {
            $request->post('content') = $article->content;
        }

        if (empty($request->post('image')) {
            $request->('image') = $article->image;
        }

        return $next($request);
    }
}
