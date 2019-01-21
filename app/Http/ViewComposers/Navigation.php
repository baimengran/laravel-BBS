<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9
 * Time: 15:32
 */

namespace App\Http\ViewComposers;

use App\Handlers\CategoryHandler;
use App\Models\Category;
use Illuminate\View\View;


class Navigation
{

    protected $categoryTree;

    public function __construct(CategoryHandler $categoryHandler)
    {
        $this->categoryTree = $categoryHandler;
    }

    public function compose(View $view)
    {
      // var_dump($this->categoryTree->getCategoryTree());
        $view->with('categoryTree', [$this->categoryTree->getCategoryTree()]);
    }
}