<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogsController extends Controller
{

    public function index()
    {
        $blogs = Blogs::with('category')->latest()->get();
        return view('backend.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('backend.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        Blogs::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('admin.blog.index');
    }
}
