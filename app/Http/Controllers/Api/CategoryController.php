<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{   
    // function to list the category
    public function index()
    {
        try {
            $categories = Category::all();
            if ($categories->isEmpty()) {
                return response()->json(['message' => 'No categories found.'], 404);
            } else {
                return response()->json($categories);
            }
        } 
        catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch categories.'], 500);
        }
        
    }



}
