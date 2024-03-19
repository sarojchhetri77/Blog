<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('backend.categories.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);
        $category = new Category();
        $category->title = $request->title;
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

    public function destroy($id){
        $category = Category::findorFail($id);
        if(is_null($category)){
          return redirect()->route('admin.category.index');
        }
        else{
           
            $category->blogs()->delete();
            $category->delete();
            return redirect()->route('admin.category.index');
        }
    }



}
