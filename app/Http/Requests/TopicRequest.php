<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'title' => 'required|min:2|max:25',
                        'body' => 'required|min:27',
                        'category_id' => 'required|numeric|exists:categories,id',
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                }
        }
    }

    public function attributes()
    {
        return [
            'category_id' => '分类',
        ];
    }


    public function messages()
    {
        return [
            'title.min' => '标题至少两个字符',
            'title.max'=>'标题不能大于25个字符',
            'body.min' => '文章内容必须至少三个字符',
            'category_id' => '当前分类错误',
        ];
    }
}
