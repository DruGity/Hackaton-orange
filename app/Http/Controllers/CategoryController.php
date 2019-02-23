<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function all()
    {
        $categories = Category::getAll();

        return response()->json(['categories' => $categories],200);
    }

    public function getById(Request $request)
    {
        $category = Category::getById($request->id);

        return response()->json([$category], 200);
    }

    public function getByUserId(Request $request)
    {
        $categories = Category::getByUserId($request->id);

        return response()->json(['categories' => $categories], 200);
    }

    public function createCategory(Request $request)
    {
        Category::createCategory($request->name, $request->url, $request->userId);

        return response()->json(['message' => 'Category '. $request->name .' successfully create!'], 201);
    }

    public function updateName(Request $request)
    {
        Category::updateName($request->categoryId, $request->newName, $request->userId);

        return response()->json(['message' => 'Category name successfully update to ' . $request->newName]);
    }
}
