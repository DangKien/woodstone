<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Libs\Configs\StatusConfig;

class ProductController extends Controller
{
    public function __construct()
    {
    	$this->productModel =  new Product();
    	$this->categoryModel = new Category();
    }

    public function detail($slug, $id, Request $request) {
    	$product = $this->productModel->findOrFail($id);

	    $category = $this->categoryModel::findOrFail($product->category_id);

	    $categories = $this->categoryModel::where(array(
							    array('status', StatusConfig::CONST_AVAILABLE),
						    ))->get();

	    $breadcrumb = $this->_breadcrumb($category, $categories);


    	return view('Frontend.Contents.product.detail', array('category' => $category, 'product' => $product, 'breadcrumb' => $breadcrumb));
    }

    public function list ($slug, $id, Request $request) {
		$category = $this->categoryModel::findOrFail($id);
	    $categories = $this->categoryModel::where(array(
									        array('status', StatusConfig::CONST_AVAILABLE),
									    ))->get();

		$breadcrumb = $this->_breadcrumb($category, $categories);

	    $depth_categories = $this->categoryModel->where(array(
									    array('status', StatusConfig::CONST_AVAILABLE),
									    array('depth', 'like', $category->depth.'%')
								    ))->get()->toArray();

		$products = $this->productModel::whereIn('category_id', array_column($depth_categories, 'id'))
										->where(array(
											array('status', StatusConfig::CONST_AVAILABLE),
										))->orderBy('id', 'desc')
										->paginate(10);

		return view('Frontend.Contents.product.list', array('products' => $products,
		                                                    'category' => $category,
		                                                    'breadcrumb' => $breadcrumb,
															));
    }

    public function _breadcrumb ($category, $categories) {
	    $breadcrumb = array();
	    foreach (explode('/', $category->depth) as $depth ) {
		    foreach ($categories as $cate) {
			    if ($cate->id == $depth) {
				    $breadcrumb[] = $cate;
				    break;
			    }
		    }
	    }
	    return $breadcrumb;
    }

}
