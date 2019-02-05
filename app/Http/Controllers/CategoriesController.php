<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct()
    {

    }

    public function show(Category $category)
    {
        $id=[];
        if ($category->parent_id == null) {

            $id=$this->getSonCategories($category->id)->prepend($category->id);
           // dd($id);
        } else {
            $id = [$category->id];

        }
        $topics = Topic::with(['user:id,name,img', 'category:id,name'])->whereIn('category_id',$id)->paginate(15);
        setSessionCurrentUrl();

        return view('topics.index', ['topics' => $topics, 'category' => $category]);
    }

    public function getSonCategories($id)
    {
       return $data = Category::query()->where('parent_id', $id)->get(['id'])->pluck('id');
        //dd($data);
    }
}
