<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Inertia\Inertia;
use Inertia\Response;

class CategoriesController extends Controller
{
    public function show(Category $category): Response
    {
        return Inertia::render('Categories/Show', [
            'category' => Category::with(['parent'])->where('id', $category->id)->first(),
            'topics' => Topic::with(['category', 'user'])->where('category_id', $category->id)->withOrder(Request()->input('order'))->paginate(),
        ]);
    }
}
