<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use DB;

class LanguagesController extends Controller
{
    private $languageModel;
    public function __construct(Language $languageModel) {
        $this->languageModel = $languageModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.language.index');
    }

    public function list(Request $request) {

        $order = $request->has('order') ? $request->order : 'id';
        $order_code = $request->order_code || 'desc';
        
        $languages  = $this->languageModel::orderBy($order, $order_code)
                            ->paginate(10);
                            
        return response()->json($languages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Contents.language.add');
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
        try {

            $this->languageModel->locale       = $request->locale;
            $this->languageModel->name_display = $request->name_display;
            $this->languageModel->icon         = $request->icon;
            $this->languageModel->description  = $request->description;
            $this->languageModel->status       = $request->status;

            $this->languageModel->save();
            DB::commit();
            return redirect()->route('languages.index')->with('languages', 'success');
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
        $language = $this->languageModel::findOrFail($id);
        return view('Backend.Contents.language.add', array('language' => $language));
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
        $language = $this->languageModel::findOrFail($id);
        $request->flash();
        $this->_validateUpdate($request);

        DB::beginTransaction();
        try {

            $language->locale       = $request->locale;
            $language->name_display = $request->name_display;
            $language->icon         = $request->icon;
            $language->description  = $request->description;
            $language->status       = $request->status;

            $language->save();
            DB::commit();
            return redirect()->route('languages.index')->with('languages', 'success');
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
        $language = $this->languageModel::findOrFail($id);
        DB::beginTransaction();
        try {
            $language->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }


    public function _validateInsert($request) {
        $this->validate($request, [
            'name_display' => 'required| unique:languages',
            'locale'       => 'required| unique:languages',
            'icon'         => 'required'
        ], [
        ]);
    }

    public function _validateUpdate($request) {
        $this->validate($request, [
            'name_display' => 'required',
            'locale'       => 'required',
            'icon'         => 'required'
        ], [
        ]);
    }
}
