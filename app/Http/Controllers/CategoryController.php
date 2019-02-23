<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function all(Category $category)
    {
        $categories = $category->getAll();

        return response()->json($categories,200);
    }

    public function getById(Request $request, Category $category)
    {
        $category = $category->getById($request->post('id'));

        return response()->json($category, 200);
    }

    public function getByUserId(Request $request, Category $category)
    {
        $categories = $category->getByUserId($request->post('id'));

        return response()->json($categories, 200);
    }

    public function createCategory(Request $request, Category $categoryModel)
    {
        $category = $categoryModel->createCategory(
            $request->post('name'),
            $request->post('url'),
            Auth::user()->id
        );

        return response()->json($category, 201);
    }

    public function updateCategory(Request $request, Category $categoryModel)
    {
        $category = $categoryModel->updateCategory(
            $request->post('category_id'),
            $request->post('name'),
            Auth::user()->id
        );

        return response()->json($category, 200);
    }

    public function deleteCategory(Request $request, Category $categoryModel)
    {
        if($categoryModel->deleteCategory($request->post('id')))
            return response()->json(null, 204);
        return response()->json(null, 400);
    }
}
