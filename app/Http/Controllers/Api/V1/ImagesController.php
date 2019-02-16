<?php

namespace App\Http\Controllers\Api\V1;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Api\V1\ImageRequest;
use App\Models\Image;
use App\Transformers\ImageTransformer;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    //

    public function store(ImageRequest $request, ImageUploadHandler $uploadHandler, Image $image)
    {

        $user = $this->user();
        $size = $request->input('type') == 'avatar' ? 362 : 1024;
        $result = $uploadHandler->save($request->file('image'), str_plural($request->input('type')), $user->id, $size);

        $image->path = $result['path'];
        $image->type = $request->input('type');
        $image->user_id = $user->id;
        $image->save();

        return $this->response->item($image, new ImageTransformer())->setStatusCode(201);
    }
}
