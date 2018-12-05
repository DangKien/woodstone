<?php

namespace App\Http\Controllers\Backend;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use DB;
use App\Libs\Configs\StatusConfig;

class SettingController extends Controller
{
	private $settingModel;

	public function __construct(Setting $settingModel)
	{
		$this->settingModel = $settingModel;
		$this->languageModel = new Language();
	}

    public function index () {
    	return view('Backend.Contents.setting.index');
    }

    

    public function getSetting (Request $request) {
	    $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
		                                ->get();
    	$data = $this->settingModel::with('translations')->get();
    	foreach ($data as $key => $value) {
    		if (!empty($value)) {
    			if (!empty(@$data[$key]->translations->toArray())) {
				    foreach ($data[$key]->translations as $key_trans => $item) {
					    $data[$key]->translations[$key_trans]->setting = json_decode($item->setting);
				    }
			    }
    		}
    	}
    	return response()->json($data);
    }

    public function insertSetting(Request $request) {
    	$find = $this->settingModel::where('key', $request->key)
    								->first();
	    $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
		                                  ->get();
    	DB::beginTransaction();
    	try {
	    	if (empty($find)) {
	            $this->settingModel->key     = $request->key;
	            $this->settingModel->save();
	            foreach ($languages as $language) {
		            $this->settingModel->translateOrNew($language->locale)->setting  = $request->setting;
		            $this->settingModel->save();
	            }
			    DB::commit();
	    	} else {
	    		$find->key     = $request->key;
			    $find->save();
			    foreach ($languages as $language) {
				    $find->translateOrNew($language->locale)->setting  = $request->setting;
				    $find->save();
			    }
			    DB::commit();
	    	}
    	} catch (Exception $e) {
    		DB::rollback();
    	}
    }
}
