<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use App\Libs\Configs\StatusConfig;
use DB, App, Illuminate\Validation\Rule;
use Datatables;

class CategoryController extends Controller
{
	private $languageModel, $categoryModel;
	public function __construct(Language $language, Category $category, CategoryTranslation $categoryTranslation)
	{
		$this->languageModel = $language;
		$this->categoryModel = $category;
	}

    public function list(Request $request) {
        $orderName = $request->input('orderName', 'id');
        $orderBy   = $request->input('orderBy', 'desc');


        $categories = $this->categoryModel
            ->select('categories.id', 'name', 'parent_id', 'depth', 'status')
            ->join('categories_translation as t', 't.category_id', '=', 'categories.id')
            ->where('locale', App::getLocale())
            ->orderBy('depth','asc')
            ->with('translations')
            ->get();

        return response()->json($categories);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = app('Category')->listCategory('vi');

        return view('Backend.Contents.category.add', 
                            array('categories' => $categories) );
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
        $this->_validateInsert($request);
        DB::beginTransaction();
        $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
        							  ->get(); 
 
        try {
            $this->categoryModel->parent_id = $request->parent_id;
            $this->categoryModel->status    = $request->status;
            $this->categoryModel->save();

        	foreach ($languages as $key => $language) {
				$this->categoryModel->translateOrNew($language->locale)->name             = $request->name[$language->id];
				$this->categoryModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
				$this->categoryModel->translateOrNew($language->locale)->slug             = slugTitle($request->name[$language->id]);
				$this->categoryModel->translateOrNew($language->locale)->meta_title       = $request->meta_title[$language->id];
				$this->categoryModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
				$this->categoryModel->translateOrNew($language->locale)->meta_data        = $request->meta_content[$language->id];
				$this->categoryModel->save();
        	}
            $this->_updateParent($request->parent_id, $this->categoryModel->id);
        	DB::commit();
            return redirect()->route('categories.index')->with('category', 'success');
        } catch (Exception $e) {
        	DB::rollback();
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
        $category = $this->categoryModel->findOrFail($id);
        $categories = app('Category')->listCategory('vi');
  
        return view('Backend.Contents.category.add', array('category' => $category, 
                                                        'categories' => $categories));
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
        DB::beginTransaction();
        $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
                                            ->get(); 
        $categoryModel = $this->categoryModel->findOrFail($id);

        try {
            $categoryModel->status    = $request->status;
            $categoryModel->parent_id = $request->parent_id;
            $categoryModel->save();

            foreach ($languages as $key => $language) {
                $categoryModel->translateOrNew($language->locale)->name             = $request->name[$language->id];
                $categoryModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
                $categoryModel->translateOrNew($language->locale)->slug             = slugTitle($request->name[$language->id]);
                $categoryModel->translateOrNew($language->locale)->meta_title       = $request->meta_title[$language->id];
                $categoryModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
                $categoryModel->translateOrNew($language->locale)->meta_data        = $request->meta_content[$language->id];
                $categoryModel->save();
            }
            $this->_updateParent($request->parent_id, $categoryModel->id);

            // return 123;

            DB::commit();
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            DB::rollback();
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
            $categoryModel = $this->categoryModel->findOrFail($id);
            $checkParent   = $this->categoryModel->where('parent_id', $id)
                                                 ->get()->toArray();
            if (empty($checkParent)) {
                $categoryModel->delete();
                $categoryModel->deleteTranslations();
                DB::commit();
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 422);
        } catch (Exception $e) {
            DB::rollback();
        }
    }


    public function _updateParent($parent_id = 0, $id) {
    	// Tìm kiếm trong model
        $categoryModel = $this->categoryModel->findOrFail($id);
        // Lấy ra depth cũ
        $oldDepth      = $categoryModel->depth;
        if ($parent_id == 0) {
            $categoryModel->depth = $id; // Update depth mới
	        $categoryModel->level = 1; // Update level mới
        } else {
            $categoryParent       = $this->categoryModel->findOrFail($parent_id);
            $categoryModel->depth = $categoryParent->depth."/".$id;
	        $categoryModel->level = count(explode('/', $categoryParent->depth)) + 1;
        }
        $categoryModel->save();
        $categoryChild = $this->categoryModel->where('depth', 'like', $oldDepth."%")
                                            ->get()->toArray(); // Xem có children không
        if (!empty($categoryChild)) {
        	// Update danh mục con
             $this->categoryModel->whereIn('id', array_column($categoryChild, 'id'))
                                ->get()
                                ->map(function ($item) use ($oldDepth, $categoryModel) {
                                    $item->depth = str_replace($oldDepth, $categoryModel->depth, $item->depth);
                                    $item->level = count(explode('/', $categoryModel->depth));
                                    $item->save();
                                });
        }
    }

    public function _validateInsert($request) {
        $rules = array(
                    'name.*'    => 'between:1,255',
                    'parent_id' => 'required',
                    'status'    => ['required', Rule::in([StatusConfig::CONST_AVAILABLE, StatusConfig::CONST_DISABLE])]
                    );
        $messages = array();
        $attribute = array(
            'name.*'    => trans('backend.category.name'),
            'parent_id' => trans('backend.category.parent'),
            'status'    => trans('backend.status')
        );

        $this->validate($request, $rules, $messages, $attribute);
    }
}
