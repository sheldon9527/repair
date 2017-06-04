<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\Front\Repair\StoreRequest;
use App\Models\Category;
use App\Models\Dorm;
use App\Models\Repair;

class HomeController extends BaseController
{
    public function home()
    {
        $categories = Category::where('parent_id', 0)->with('children')->get();
        $droms = Dorm::where('parent_id', 0)->with('children')->get();

        return view('front.home', compact('categories', 'droms'));
    }

    public function store(StoreRequest $request)
    {

        $repair =  new Repair();
        $repair->name  = $request->get('name');
        $repair->dorm_id  = $request->get('dorm_id');
        $repair->home_number  = $request->get('home_number');
        $repair->phone  = $request->get('phone');
        $repair->description  = $request->get('description');
        $categoryIds = $request->get('category_ids');
        $repair->save();
        $categoryIds = $categoryIds ? array_filter(array_map('intval', $categoryIds)) : [];
        if ($categoryIds) {
            $repair->categories()->attach($categoryIds);
        }

        return redirect(route('inquiry.get'))->with('status', 'Update Success!');
    }
}
