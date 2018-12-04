<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Libs\Configs\StatusConfig;
use Illuminate\Validation\Rule;
use DB;

class SlideController extends Controller
{
	private $slideModel;
	public function __construct(Slide $slide)
	{
		$this->slideModel = $slide;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.slide.index');
    }


    public function list(Request $request) {

		$order      = $request->has('order') ? $request->order : 'id';
		$order_code = $request->input('orderBy', 'desc');
	    $freeText  = $request->input('freetext', '');

        $slides  = $this->slideModel->filterName($freeText)
	                                ->buildCond()
                                    ->orderBy($order, $order_code)
                                    ->paginate(10);
                            
        return response()->json($slides);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$sort_by = $this->slideModel->select('sort_by')
                                    ->orderBy('sort_by', 'asc')
                                    ->get();

        return view('Backend.Contents.slide.add', array('sort_bys'=>$sort_by));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->_vaildateInsert($request);
        DB::beginTransaction();
        try {
        	_updateSortBy($this->slideModel, $request->sort_by, -1);
			$this->slideModel->title      = $request->title;
			$this->slideModel->image      = $request->image;
			$this->slideModel->link       = $request->link;
			$this->slideModel->sort_by    = $request->sort_by;
			$this->slideModel->status     = $request->status;
            $this->slideModel->save(); 
            DB::commit();
            return redirect()->route('slides.index')->with(['slide' => 'success', 'messages' => trans('backend.slide.slide_create_success')]);
        } catch (Exception $e) {
            DB::rollback();
	        return redirect()->route('slides.index')->with(['slide' => 'errors', 'messages' => trans('backend.slide.slide_create_errors')]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$sort_by = $this->slideModel->select('sort_by')
                                    ->orderBy('sort_by', 'asc')
                                    ->get();
    	$slide = $this->slideModel->findOrFail($id);
        return view('Backend.Contents.slide.add', array('slide'=>$slide,
        									 'sort_bys'=>$sort_by));
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
        $request->flash();
        $this->_vaildateInsert($request);
        $slideModel = $this->slideModel->findOrFail($id);
        DB::beginTransaction();
        try {
        	_updateSortBy($this->slideModel, $request->sort_by, $slideModel->sort_by);
			$slideModel->title = $request->title;
	        $slideModel->image = $request->image;
	        $slideModel->link = $request->link;
	        $slideModel->sort_by = $request->sort_by;
	        $slideModel->status = $request->status;
	        $slideModel->save();
            DB::commit();
            return redirect()->route('slides.index')->with(['slide' => 'success', 'messages' => trans('backend.slide.slide_update_success')]);
        } catch (Exception $e) {
            DB::rollback();
	        return redirect()->route('slides.index')->with(['slide' => 'eroors', 'messages' => trans('backend.slide.slide_update_errors')]);
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
        	
        	$slideModel = $this->slideModel::findOrFail($id);
        	_updateSortBy($this->slideModel, 1000000, $slideModel->sort_by);

            $slideModel->delete();

        	DB::commit();
        	return response()->json(['status' => false], 200);
        } catch (Exception $e) {
        	DB::rollback();
        	return response()->json(['status' => false], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMulti (Request $request)
    {
    	$ids = $request->ids;
        DB::beginTransaction();
        try {
        	
        	foreach ($ids as $id) {
        		$slideModel = $this->slideModel::findOrFail($id);
        		_updateSortBy($this->slideModel, 1000000, $slideModel->sort_by);
        		$slideModel->delete();
        	}
        	DB::commit();
        	return response()->json(['status' => false], 200);
        } catch (Exception $e) {
        	DB::rollback();
        	return response()->json(['status' => false], 422);
        }
    }


    public function _vaildateInsert ($request) {
        $rules = array(
			// 'title'     => 'required|between:1,255',
			'image' => 'required|between:1,255',
			'link'  => 'required|between:1,255',
			'status'    => ['required', Rule::in([StatusConfig::CONST_AVAILABLE, StatusConfig::CONST_DISABLE])]
        );
        $messages = array();
        $attr = array(
			// 'title'     => trans('backened.slide.title'),
			'url_slide' => trans('backened.slide.image'),
			'url_link'  => trans('backened.slide.link'),
			'status'    => trans('backened.slide.status')
        );
        $this->validate($request, $rules, $messages, $attr);
    }
}

