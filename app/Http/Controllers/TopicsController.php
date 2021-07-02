<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Http\Requests\TopicRequest;
use App\Handlers\ImageUploadHandler;
use Auth;


class TopicsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth', ['except'	=>	['index', 'show']]);
	}
    
    public function index(Request $request, Topic $topic)
    {
    	$topics = $topic->withOrder($request->order)
    					->with('user', 'category')
    					->paginate(20);
    	
    	return view('topics.index', compact('topics'));
    }
    
    public function show(Topic $topic)
    {
    	return view('topics.show', compact('topic'));
    }


    public function create(Topic $topic, Category $category)
    {
    	$categories = $category->categories();
    	return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
    	$topic->fill($request->all());

    	$topic->user_id = Auth::id();

    	$topic->save();

    	return redirect()->route('topics.show', $topic->id)->with('success', '帖子创建成功！');


    }


    public function edit(Topic $topic, Category $category)
    {
    	$this->authorize('update', $topic);
    	$categories = $category->categories();
    	return view('topics.create_and_edit', compact('topic', 'categories'));
    }


    public function update(TopicRequest $request, Topic $topic)
    {
    	$this->authorize('update', $topic);
    	$topic->update($request->all());

    	return redirect()->route('topics.show', $topic->id)->with('success', '帖子修改成功！');

    }


    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
    	// 默认错误数据模版
    	$data = [
    		'success'	=>	false,
    		'msg'		=>	'上传失败！',
    		'file_path'	=>	''
    	];

    	// 判断是否有上传文件，并赋值给 $file
    	if ($file = $request->upload_file) {
    		// 保存文件
    		$result = $uploader->save($file, 'topics', Auth::id() , 1024);

    		if ($result) {
    			$data['success'] = true;
    			$data['msg'] = '上传成功！';
    			$data['file_path'] = $result['path'];
    		}
    	}

    	return $data;
    }
}
