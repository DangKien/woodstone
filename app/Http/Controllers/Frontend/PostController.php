<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Libs\Configs\StatusConfig;

class PostController extends Controller
{
	public function __construct()
	{
		$this->postModel = new Post();
	}

	public function list(Request $request) {
		$posts = $this->postModel::where('status', StatusConfig::CONST_AVAILABLE)->paginate(10);
		return view('Frontend.Contents.post.list', array('posts' => $posts));
	}

	public function detail ($slug, $id, Request $request) {
		$post = $this->postModel::where(array(
			array('status', StatusConfig::CONST_AVAILABLE),
			array('id', $id)
		))->firstOrFail();
		return view('Frontend.Contents.post.detail', array('post' => $post));
	}
}
