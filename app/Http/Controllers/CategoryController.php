<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

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

    public function createCategory(Request $request, Category $category)
    {
        $category->createCategory($request->post('name'), $request->post('url'), $request->post('userId'));

        return response()->json(['message' => 'Category '. $request->post('name') .' successfully create!'], 201);
    }

    public function updateName(Request $request, Category $category)
    {
        $category->updateName($request->post('categoryId'), $request->post('newName'), $request->post('userId'));

        return response()->json(['message' => 'Category name successfully update to ' . $request->post('newName')]);
    }
}
