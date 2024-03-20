<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Category;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class BlogController extends Controller
{
    public function getByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $blogCount = Blogs::where('category_id', $category->id)->count();
        if ($blogCount === 0) {
            $response = [
                'success' => false,
                'message' => 'Blog not found',
            ];
            $code = 404;
        } else {
            $blogs = Blogs::where('category_id', $category->id)->get();
            $response = [
                'success' => true,
                'data' => $blogs,
            ];
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function search(Request $request)
    {
        $validated = validator($request->all(),[
            'search' => 'required|string',
        ]);
        if ($validated->fails()) {
            $response = [
                'success' => false,
                'message' => $validated->errors(),
            ];
            $code = 400;
        } else {
            $search = $request->input('search');
            $blogs = Blogs::where('title', 'like', "%$search%")->get();
            if ($blogs->isEmpty()) {
                $response = [
                    'success' => false,
                    'message' => 'No match',
                ];
                $code = 404;
            } else {
                $response = [
                    'success' => true,
                    'message' => 'match found',
                    'data' => $blogs
                ];
                $code = 200;
            }
        }
        return response()->json($response, $code);
    }
}
