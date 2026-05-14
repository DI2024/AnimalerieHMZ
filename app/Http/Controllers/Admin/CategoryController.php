<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = collect([
            (object)['id' => 1, 'name' => 'Chiens', 'slug' => 'chiens', 'products_count' => 45],
            (object)['id' => 2, 'name' => 'Chats', 'slug' => 'chats', 'products_count' => 38],
            (object)['id' => 3, 'name' => 'Oiseaux', 'slug' => 'oiseaux', 'products_count' => 12],
        ]);
        return view('admin.categories.index', compact('categories'));
    }
}
