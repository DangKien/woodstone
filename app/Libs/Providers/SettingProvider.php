<?php

namespace App\Libs\Providers;
use App\Libs\Configs\StatusConfig;

use App\Models\Setting;

class SettingProvider {

	public function __construct()
	{
		$this->settingModel= new Setting();
	}

	public function getContact () {
		$data = $this->settingModel->where('key', StatusConfig::CONST_CONTACT)
									->first();
		if (!empty($data->setting)) {
			$data->setting = json_decode($data->setting);
		}
		return $data;
	}

	public function getLogo() {
		$data = $this->settingModel->where('key', StatusConfig::CONST_LOGO)
									->first();
		if (!empty($data->setting)) {
			$data->setting = json_decode($data->setting);
		}
		return $data;
	}

	public function getSeo() {
		$data = $this->settingModel->where('key', StatusConfig::CONST_SEO_DEFAULT)
									->first();
		if (!empty($data->setting)) {
			$data->setting = json_decode($data->setting);
		}
		return $data;
	}

	public function getSettingHome() {
		$data = $this->settingModel->where('key', StatusConfig::CONST_SETTING_HOME)
			->first();
		if (!empty($data->setting)) {
			$data->setting = json_decode($data->setting);
		}
		return $data;
	}

}