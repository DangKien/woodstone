<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Libs\Configs\StatusConfig;
use DB, Auth;

use App\Models\StaticPage;
use App\Models\Language;

class StaticPageController extends Controller
{
    public function __construct()
    {
    	$this->staticPageModel = new StaticPage();
    	$this->languageModel   = new Language();
    }

    public function about() {
	    $about = $this->staticPageModel::where('key', StatusConfig::CONST_STATIC_ABOUT)->first();
		return view ('Backend.Contents.static_page.about', array('about' => $about));
    }

	public function postAbout(Request $request) {
    	$this->_validateAbout($request);
		DB::beginTransaction();
		 try {
			 $staticPageModel = $this->staticPageModel::where('key', StatusConfig::CONST_STATIC_ABOUT)->first();
			 if (empty($staticPageModel)) {
				 $this->staticPageModel->key = StatusConfig::CONST_STATIC_ABOUT;
				 $this->staticPageModel->save();
				 $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)->get();

				 foreach ($languages as $key => $language) {
					 $this->staticPageModel->translateOrNew($language->locale)->content     = $request->content[$language->id];
					 $this->staticPageModel->translateOrNew($language->locale)->meta_title   = $request->meta_title[$language->id];
					 $this->staticPageModel->translateOrNew($language->locale)->meta_keyword = $request->meta_keyword[$language->id];
					 $this->staticPageModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
					 $this->staticPageModel->save();
				 }
			 } else {
				 $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)->get();
				 foreach ($languages as $key => $language) {
					 $staticPageModel->translateOrNew($language->locale)->content     = $request->content[$language->id];
					 $staticPageModel->translateOrNew($language->locale)->meta_title   = $request->meta_title[$language->id];
					 $staticPageModel->translateOrNew($language->locale)->meta_keyword = $request->meta_keyword[$language->id];
					 $staticPageModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
					 $staticPageModel->save();
				 }
			 }
			 DB::commit();
			 return redirect()->route('about.index')->with(['status' => "success", 'messages' => trans('backend.about.message_success')]);
		 } catch (Exception $exception) {
			 DB::rollback();
			 return redirect()->route('about.index')->with(['status' => "errors", 'messages' => trans('backend.about.message_errors')]);
		 }

	}

    public function quanlity () {
	    $quanlity = $this->staticPageModel::where('key', StatusConfig::CONST_STATIC_QUANLITY)->first();
	    return view ('Backend.Contents.static_page.quanlity', array('quanlity' => $quanlity));
    }

	public function postQuanlity (Request $request) {
		$this->_validateAbout($request);
		DB::beginTransaction();
		try {
			$staticPageModel = $this->staticPageModel::where('key', StatusConfig::CONST_STATIC_QUANLITY)->first();
			if (empty($staticPageModel)) {
				$this->staticPageModel->key = StatusConfig::CONST_STATIC_QUANLITY;
				$this->staticPageModel->save();
				$languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)->get();

				foreach ($languages as $key => $language) {
					$this->staticPageModel->translateOrNew($language->locale)->content     = $request->content[$language->id];
					$this->staticPageModel->translateOrNew($language->locale)->meta_title   = $request->meta_title[$language->id];
					$this->staticPageModel->translateOrNew($language->locale)->meta_keyword = $request->meta_keyword[$language->id];
					$this->staticPageModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
					$this->staticPageModel->save();
				}
			} else {
				$languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)->get();
				foreach ($languages as $key => $language) {
					$staticPageModel->translateOrNew($language->locale)->content     = $request->content[$language->id];
					$staticPageModel->translateOrNew($language->locale)->meta_title   = $request->meta_title[$language->id];
					$staticPageModel->translateOrNew($language->locale)->meta_keyword = $request->meta_keyword[$language->id];
					$staticPageModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
					$staticPageModel->save();
				}
			}
			DB::commit();
			return redirect()->route('quanlity.index')->with(['status' => "success", 'messages' => trans('backend.about.message_success')]);
		} catch (Exception $exception) {
			DB::rollback();
			return redirect()->route('quanlity.index')->with(['status' => "errors", 'messages' => trans('backend.about.message_errors')]);
		}
	}

	public function _validateAbout($request) {
		$rules = array(
			'content.*'    => 'required',
		);
		$messages = array();
		$attribute = array(
			'content.*'    => trans('backend.about.content'),
		);
		$this->validate($request, $rules, $messages, $attribute);
	}


}
