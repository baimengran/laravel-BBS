<?php

namespace App\Http\Controllers;

use App\Handlers\CategoryHandler;
use App\Handlers\ImageUploadHandler;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class TopicsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
       // session(['re_lo_url'=>url()->current()]);
    }

    //
    public function index()
    {
        $topics = Topic::with('user:id,name,img', 'category:id,name,path')->orderBy('updated_at', 'DESC')->paginate(15);
        //记录url供登录时跳转
        setSessionCurrentUrl();
        return view('topics.index', ['topics' => $topics]);
    }

    public function show(Request $request, Topic $topic)
    {
        dd($topic,$request->all());
//        //RUL矫正，永久重定向到正确的URL上
        if (!empty($topic->slug && $topic->slug != $request->slug)) {
            return redirect($topic->link(), 301);
        }
        //记录url供登录时跳转
        setSessionCurrentUrl();
        return view('topics.show', ['topic' => $topic]);
    }

    public function create(Topic $topic)
    {
//        $categories = Category::all();
        $cateHan = new CategoryHandler();
        $categories = $cateHan->getCategoryTree();

        return view('topics.create_and_edit', ['topic' => $topic, 'categories' => $categories]);
    }

    public function store(TopicRequest $request, Topic $topic)
    {

        $topic->fill($request->all());
        $topic->user_id = \Auth::id();
        $topic->save();
        return redirect()->to($topic->link())->with('success', '发布成功');
    }

    public function edit(Topic $topic)
    {
        //dd($topic);
        $this->authorize('update', $topic);
        $cateHan = new CategoryHandler();
        $categories = $cateHan->getCategoryTree();
        return view('topics.create_and_edit', ['topic' => $topic, 'categories' => $categories]);

    }


    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());
        return redirect()->to($topic->link())->with('success', '更改成功');
    }


    /**
     * Simditor 前端文本编辑器图片上传处理方法
     * @param Request $request
     * @param ImageUploadHandler $uploadHandler 图片剪裁保存函数
     * @return array 图片路径
     */
    public function uploadImages(Request $request, ImageUploadHandler $uploadHandler)
    {
        //初始化返回数据，默认失败
        $data = [
            'success' => false,
            'msg' => '上传失败',
            'file_path' => '',
        ];

        //判断是否有上传文件
        if ($file = $request->upload_file) {
            //保存图片到本地
            $result = $uploadHandler->save($request->upload_file, 'topics', \Auth::id(), 1024);
            //图片保存成功
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = "上传成功";
                $data['success'] = true;
            }
        }
        return $data;
    }


    public function destroy(Topic $topic,Request $request)
    {
        $this->authorize('delete', $topic);
        $topic->delete();

        if($request->ajax()){
            return response()->json(['success'=>'删除成功']);
        }

        return redirect()->route('topics.index')->with('success', '删除成功！');
    }


}
