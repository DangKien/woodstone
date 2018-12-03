<?php

namespace App\Http\Controllers\Backend;

use App\Models\HomeProduct;
use App\Libs\Configs\StatusConfig;
use App\Models\Language;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Validation\Rule;

class HomeProductController extends Controller
{
	public function __construct()
	{
		$this->homeProductModel = new HomeProduct();
		$this->languageModel    = new Language();
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.home_product.index');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function list()
	{
		$products = $this->homeProductModel::paginate(15);
		return response()->json($products);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('Backend.Contents.home_product.add');
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
		    $this->homeProductModel->url_product = $request->url_product;
		    $this->homeProductModel->image       = $request->image;
		    $this->homeProductModel->status      = $request->status;
		    $this->homeProductModel->save();

		    foreach ($languages as $language) {
			    $this->homeProductModel->translateOrNew($language->locale)->name             = $request->name[$language->id];
			    $this->homeProductModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
			    $this->homeProductModel->translateOrNew($language->locale)->content          = $request->content[$language->id];
			    $this->homeProductModel->save();
		    }
		    DB::commit();
		    return redirect()->route('home-products.index')->with(array('status' => 'success', 'messages'=> trans('backend.home_product.success_create_message')));
	    } catch (Exception $exception) {
		    DB::rollBack();
		    return redirect()->route('home-products.index')->with(array('status' => 'errors', 'messages'=> trans('backend.home_product.errors_create_message')));
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
	    return view('Backend.Contents.home_product.add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $home_product = $this->homeProductModel::findOrFail($id);
	    return view('Backend.Contents.home_product.add', array('home_product' => $home_product));
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
	    $homeProductModel = $this->homeProductModel::findOrFail($id);

	    DB::beginTransaction();
	    try {
		    $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
			    ->get();
		    $homeProductModel->url_product = $request->url_product;
		    $homeProductModel->image       = $request->image;
		    $homeProductModel->status      = $request->status;
		    $homeProductModel->save();

		    foreach ($languages as $language) {
			    $homeProductModel->translateOrNew($language->locale)->name             = $request->name[$language->id];
			    $homeProductModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
			    $homeProductModel->translateOrNew($language->locale)->content          = $request->content[$language->id];
			    $homeProductModel->save();
		    }
		    DB::commit();
		    return redirect()->route('home-products.index')->with(array('status' => 'success', 'messages'=> trans('backend.home_product.success_update_message')));
	    } catch (Exception $exception) {
		    DB::rollBack();
		    return redirect()->route('home-products.index')->with(array('status' => 'errors', 'messages'=> trans('backend.home_product.errors_update_message')));
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
			$productModel = $this->homeProductModel::findOrFail($id);
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
			$productModel = $this->homeProductModel::findOrFail($id);
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
		    'name.*'      => 'between: 1, 255',
		    'image'       => 'required',
		    'status'      => ['required', Rule::in([StatusConfig::CONST_AVAILABLE, StatusConfig::CONST_DISABLE])]
	    );
	    $messages = array();
	    $attr = array(
		    'name.*' => trans('backend.home_product.name'),
		    'image' => trans('backend.home_product.image'),
		    'status' => trans('backend.status.status'),
	    );
	    $this->validate($request, $rules, $messages, $attr);
    }
}
