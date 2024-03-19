<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('backend.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $slug = str::slug($request->title);
        $count = Category::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        $category = new Category();
        $category->title = $request->title;
        $category->slug = $slug;
        $category->save();
        return redirect()->route('admin.category.index');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findorFail($id);
        if (is_null($category)) {
            return redirect()->route('admin.category.index');
        } else {
            $request->validate([
                'title' => 'required|string|max:255'
            ]);
            $category->title = $request->title;
            $category->update();
            return redirect()->route('admin.category.index');
        }
    }

    public function destroy($id)
    {
        $category = Category::findorFail($id);
        if (is_null($category)) {
            return redirect()->route('admin.category.index');
        } else {

            $category->blogs()->delete();
            $category->delete();
            return redirect()->route('admin.category.index');
        }
    }
}
