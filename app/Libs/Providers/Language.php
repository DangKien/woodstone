<?php

namespace App\Libs\Providers;

use App\Models\Language as LanguageModel;
use App\Libs\Configs\StatusConfig;
use Illuminate\Support\Facades\App;

class Language {
	public function __construct()
	{
		$this->languageModel = new \App\Models\Language();
	}

	public function getLanguage() {
		$languageModel = new LanguageModel();

		$data = $languageModel->select('id', 'locale', 'name_display', 'icon', 'description', 'status')
							  ->where('status', StatusConfig::CONST_AVAILABLE)
							  ->get();
		return $data;
	}


	public function getLangCurrent() {
		$data = $this->languageModel->where(array(
									array('locale', App::getLocale()),
						))->first();
		return $data;
	}
}



    
