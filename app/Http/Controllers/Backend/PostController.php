<?php

namespace App\Http\Controllers\Backend;

use Complex\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\Language;
use App\Libs\Configs\StatusConfig;

use DB;
use Illuminate\Support\Facades\App;

class PostController extends Controller
{
	public function __construct()
	{
		$this->postModel= new Post();
		$this->languageModel = new Language();
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('Backend.Contents.post.index');
    }

	/**
	 * Get listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function list(Request $request)
	{
		$orderName = $request->input('orderName', 'id');
		$orderBy   = $request->input('orderBy', 'desc');
		$freeText  = $request->input('freetext', '');
		$posts = $this->postModel->filterName($freeText)
								->buildCond()
								->select('posts.*')
								->join('post_translations as t', 't.post_id', '=', 'posts.id')
								->where( array(
									array('locale', App::getLocale() ),
								))
								->orderBy($orderName, $orderBy)
								->with('translations')
								->paginate(15);
		return response()->json($posts);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Contents.post.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->_validateInsert($request);
        DB::beginTransaction();
        try {
	        $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
		                                        ->get();
	        $this->postModel->status = $request->status;
	        $this->postModel->image  = $request->image;
	        $this->postModel->save();
	        foreach ($languages as $language) {
		        $this->postModel->translateOrNew($language->locale)->title            = $request->title[$language->id];
		        $this->postModel->translateOrNew($language->locale)->slug             = slugTitle($request->title[$language->id]);
		        $this->postModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
		        $this->postModel->translateOrNew($language->locale)->content          = $request->content[$language->id];
		        $this->postModel->translateOrNew($language->locale)->meta_title       = $request->meta_title[$language->id];
		        $this->postModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
		        $this->postModel->translateOrNew($language->locale)->meta_keyword     = $request->meta_keyword[$language->id];
		        $this->postModel->save();
	        }
        	DB::commit();
	        return redirect()->route('posts.index')->with(['status' => 'success', 'messages' => trans('backend.post.post_create_success')]);
        } catch (Exception $exception) {
			DB::rollback();
	        return redirect()->route('posts.index')->with(['status' => 'erros', 'messages' => trans('backend.post.post_create_errors')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    return view('Backend.Contents.post.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$post = $this->postModel::findOrFail($id);
	    return view('Backend.Contents.post.add', array('post' => $post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    $this->_validateInsert($request);
	    DB::beginTransaction();
	    try {
		    $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
			    ->get();
		    $postModel = $this->postModel::findOrFail($id);

		    $postModel->status = $request->status;
		    $postModel->image  = $request->image;
		    $postModel->save();
		    foreach ($languages as $language) {
			    $postModel->translateOrNew($language->locale)->title            = $request->title[$language->id];
			    $postModel->translateOrNew($language->locale)->slug             = slugTitle($request->title[$language->id]);
			    $postModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
			    $postModel->translateOrNew($language->locale)->content          = $request->content[$language->id];
			    $postModel->translateOrNew($language->locale)->meta_title       = $request->meta_title[$language->id];
			    $postModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
			    $postModel->translateOrNew($language->locale)->meta_keyword     = $request->meta_keyword[$language->id];
			    $postModel->save();
		    }
		    DB::commit();
		    return redirect()->route('posts.index')->with(['status' => 'success', 'messages' => trans('backend.post.post_create_success')]);
	    } catch (Exception $exception) {
		    DB::rollback();
		    return redirect()->route('posts.index')->with(['status' => 'erros', 'messages' => trans('backend.post.post_create_errors')]);
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
        	$postModel = $this->postModel::findOrFail($id);
	        $postModel->delete();
	        $postModel->deleteTranslations();
			DB::commit();
	        return response()->json(array('status' => true), 200);
        } catch (Exception $exception) {
        	DB::rollBack();
        	return response()->json(array('status' => false), 422);
        }
    }

	/**
	 * Change status specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function changeStatus($id)
	{
		DB::beginTransaction();
		try {
			$postModel = $this->postModel::findOrFail($id);
			$status = $postModel->status;
			if ($status == StatusConfig::CONST_AVAILABLE) {
				$postModel->status = StatusConfig::CONST_DISABLE;
			} else {
				$postModel->status = StatusConfig::CONST_AVAILABLE;
			}
			$postModel->save();
			DB::commit();
			return response()->json(array('status' => true), 200);
		} catch (Exception $exception) {
			DB::rollBack();
			return response()->json(array('status' => false), 422);
		}
	}

	public function _validateInsert($request) {
	    $rules = array(
		    'title.*'   => 'between: 1, 500',
		    'content.*' => 'required'
	    );
	    $messages = array();
	    $attrs = array(
		    'title.*'   => trans('backend.post.title'),
		    'content.*' => trans('backend.post.content'),
	    );

    	$this->validate($request, $rules, $messages, $attrs);
    }
}
