<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/14
 * Time: 14:18
 */

namespace App\Handlers;




class ImageUploadHandler
{
    //只允许以下后缀名的图片文件上传
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];


    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        //构建文件夹规则
        $folder_name = "uploads/images/$folder/" . date('ymd', time());

        //文件具体存储路径
        $upload_path = public_path() . '/' . $folder_name;

        //获取文件后缀名
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        //拼接文件名
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        //如果上传的不是图片终止操作
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        //将图片移动到目标路径
        $file->move($upload_path, $filename);

        //如果限制了图片宽度，进行裁剪
        if ($max_width && $extension != 'gif') {
            //调用封装函数，用于裁剪图片
            $this->reduceSize($upload_path . '/' . $filename, $max_width);

        }
        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }

    /**
     * 图片裁剪
     * @param string $file_path 图片路径
     * @param integer $max_width 图片宽度
     */
    public function reduceSize($file_path, $max_width)
    {
        $image = \Image::make($file_path);

        //图片大小调整
        $image->resize($max_width, null, function ($constraint) {
            //设定宽度是$max_width，高度等比例缩放
            $constraint->aspectRatio();

            //防止裁图时，图片尺寸变大
            $constraint->upsize();
        });
        $image->save();
    }
}