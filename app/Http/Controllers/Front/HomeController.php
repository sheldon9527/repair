<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;

class HomeController extends BaseController
{
    public function home()
    {
        $categories = Category::where('parent_id', 0)->with('children')->get();
        return view('front.home', compact('categories'));
    }
}
