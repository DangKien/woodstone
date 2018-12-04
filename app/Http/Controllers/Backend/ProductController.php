<?php

namespace App\Http\Controllers\Backend;

use Complex\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Language;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use App\Libs\Configs\StatusConfig;
use DB;

class ProductController extends Controller
{
	public function __construct()
	{
		$this->productModel = new Product();
		$this->categoryModel = new Category();
		$this->languageModel = new Language();
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('Backend.Contents.product.index');
    }

	/**
	 * Get list of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function list(Request $request)
	{
		$orderName = $request->input('orderName', 'id');
		$orderBy   = $request->input('orderBy', 'desc');
		$freeText  = $request->input('freetext', '');
		$products = $this->productModel->filterName($freeText)
					->buildCond()
					->select('products.*')
					->join('product_translations as t', 't.product_id', '=', 'products.id')
					->where( array(
						array('locale', App::getLocale() ),
					))
					->orderBy($orderName, $orderBy)
					->with('translations')
					->paginate(15);

		return response()->json($products);
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = $this->categoryModel::get();

        return view('Backend.Contents.product.add', array('categories' => $categories));
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
		    $this->productModel->category_id = $request->category_id;
		    $this->productModel->image       = $request->image;
		    $this->productModel->status      = $request->status;
		    $this->productModel->save();

		    foreach ($languages as $language) {
                $this->productModel->translateOrNew($language->locale)->name             = $request->name[$language->id];
                $this->productModel->translateOrNew($language->locale)->slug             = slugTitle($request->name[$language->id]);
                $this->productModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
                $this->productModel->translateOrNew($language->locale)->content          = $request->content[$language->id];
                $this->productModel->translateOrNew($language->locale)->digital_radio    = $request->digital_radio[$language->id];
                $this->productModel->translateOrNew($language->locale)->specifications   = $request->specifications[$language->id];
                $this->productModel->translateOrNew($language->locale)->series           = $request->series[$language->id];
                $this->productModel->translateOrNew($language->locale)->meta_title       = $request->meta_title[$language->id];
                $this->productModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
                $this->productModel->translateOrNew($language->locale)->meta_keyword     = $request->meta_keyword[$language->id];
                $this->productModel->save();
		    }
	    	DB::commit();
	    	return redirect()->route('products.index')->with(array('status' => 'success', 'messages'=> trans('backend.product.success_create_message')));
	    } catch (Exception $exception) {
	    	DB::rollBack();
		    return redirect()->route('products.index')->with(array('status' => 'errors', 'messages'=> trans('backend.product.errors_create_message')));
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
        $product = $this->productModel::findOrFail($id);
	    $categories = $this->categoryModel::get();

	    return view('Backend.Contents.product.add', array('product' => $product,'categories' => $categories));
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
	    $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
		                                ->get();
	    $productModel = $this->productModel::findOrFail($id);
	    try {
		    $productModel->category_id = $request->category_id;
		    $productModel->image       = $request->image;
		    $productModel->status      = $request->status;
		    $productModel->save();

		    foreach ($languages as $language) {
			    $productModel->translateOrNew($language->locale)->name             = $request->name[$language->id];
			    $productModel->translateOrNew($language->locale)->slug             = slugTitle($request->name[$language->id]);
			    $productModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
			    $productModel->translateOrNew($language->locale)->content          = $request->content[$language->id];
			    $productModel->translateOrNew($language->locale)->digital_radio    = $request->digital_radio[$language->id];
			    $productModel->translateOrNew($language->locale)->specifications   = $request->specifications[$language->id];
			    $productModel->translateOrNew($language->locale)->series           = $request->series[$language->id];
			    $productModel->translateOrNew($language->locale)->meta_title       = $request->meta_title[$language->id];
			    $productModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
			    $productModel->translateOrNew($language->locale)->meta_keyword     = $request->meta_keyword[$language->id];
			    $productModel->save();
		    }

		    DB::commit();
		    return redirect()->route('products.index')->with(array('status' => 'success', 'messages'=> trans('backend.product.success_update_message')));
	    } catch (Exception $exception) {
		    DB::rollBack();
		    return redirect()->route('products.index')->with(array('status' => 'errors', 'messages'=> trans('backend.product.errors_update_message')));
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
		    $productModel = $this->productModel::findOrFail($id);
		    $productModel->delete();
		    $productModel->deleteTranslations();
		    DB::commit();
		    return response()->json(array('status' => true), 200);
	    } catch (Exception $exception) {
    		DB::rollBack();
		    return response()->json(array('status' => false), 422);
	    }
    }

    public function changeStatus ($id) {
	    DB::beginTransaction();
	    try {
		    $productModel = $this->productModel::findOrFail($id);
		    $status = $productModel->status;
		    if ($status == StatusConfig::CONST_AVAILABLE) {
			    $productModel->status = StatusConfig::CONST_DISABLE;
		    } else {
			    $productModel->status = StatusConfig::CONST_AVAILABLE;
		    }
		    $productModel->save();
		    DB::commit();
		    return response()->json(array('status' => true), 200);
	    } catch (Exception $exception) {
	    	DB::rollBack();
		    return response()->json(array('status' => false), 422);
	    }
    }


    public function _validateInsert($request) {
    	$rules = array(
    		'name.*' => 'between: 1, 255',
		    'category_id' => "required",
//		    'image'    => 'required',
		    'status'    => ['required', Rule::in([StatusConfig::CONST_AVAILABLE, StatusConfig::CONST_DISABLE])]
	    );
    	$messages = array();
    	$attr = array(
    		'name.*' => trans('backend.product.name')
	    );
		$this->validate($request, $rules, $messages, $attr);
    }
}
