<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/15
 * Time: 18:13
 */

namespace App\Handlers;


use App\Models\Category;

class CategoryHandler
{

    /**
     * 递归方法，返回类目树
     * @param null $parentId 获取子类目的父类目id，null表示获取所有跟类目
     * @param null $allCategories 数据库中所有类目，null代表需要从数据库中查询
     * @return Category[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public  function getCategoryTree($parentId = null, $allCategories = null)
    {
        if (is_null($allCategories)) {
            //取出所有数据
            $allCategories = Category::all();
        }

        return $allCategories->where('parent_id', $parentId)//所有分类中选出父类id为$parentId的类目
        //遍历这些类目，并用返回值构建一个新的集合
        ->map(function (Category $category) use ($allCategories) {
            $data = ['id' => $category->id, 'name' => $category->name, 'description' => $category->description,];
            //如果当前类目不是父类目，直接返回
            if (!$category->is_son) {
                return $data;
            }
            //否则递归调用本方法，将返回值放入children字段
            $data['children'] = $this->getCategoryTree($category->id, $allCategories);
            return $data;
        });
    }
}