<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogsController extends Controller
{

    public function index()
    {
        $blogs = Blogs::with('category')->paginate(10);
        return view('backend.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('backend.blogs.create', compact('categories'));
    }

    public function show($id){
        $blog = Blogs::with('category')->findorFail($id);
        return view('backend.blogs.show',compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blogs::findorFail($id);
        $categories = Category::all();
        return view('backend.blogs.edit', compact('blog', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        if ($request->hasFile('image')) {
            $photo_name =  time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/'), $photo_name);

            Blogs::create([
                'title' => $request->title,
                'image' => $photo_name,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);
        }
        return redirect()->route('admin.blog.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        $blog = Blogs::findorFail($id);
        if ($request->hasFile('image')) {
            unlink(public_path('uploads/' . $blog->image));
            $photo_name =  time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/'), $photo_name);
            $blog->image = $photo_name;
        }
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->category_id = $request->category_id;
        $blog->update();
        return redirect()->route('admin.blog.index');

    }

    public function destroy($id){
        $blog = Blogs::findorFail($id);
        unlink(public_path('uploads/' . $blog->image));
        $blog->delete();
        return redirect()->route('admin.blog.index');
        
    }

}
