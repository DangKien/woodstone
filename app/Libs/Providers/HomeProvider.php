<?php

namespace App\Libs\Providers;
use App\Libs\Configs\StatusConfig;

use App\Models\HomeProduct;
use App\Models\Slide;
use App\Models\Category;

class HomeProvider {

	public function __construct()
	{
		$this->slideModel = new Slide();
		$this->productHomeModel = new HomeProduct();
		$this->categoryModel = new Category();
	}

	public function getSlide() {
		$slides = $this->slideModel::where(array(
									array('status', StatusConfig::CONST_AVAILABLE),
									))->orderBy('sort_by','desc')
									->get();
		return $slides;
	}

	public function getProductHome() {
		$productHomes = $this->productHomeModel::where(array(
									array('status', StatusConfig::CONST_AVAILABLE)
								))->orderBy('id', 'desc')
								->get();
		return $productHomes;
	}

	public function getMenu () {
		$menu = $this->categoryModel::where(array(
										array('status', StatusConfig::CONST_AVAILABLE),
									))->get();
		$menu = $this->getMenuHasSub($menu);
		return $menu;
	}

	public function getMenuHasSub ($menus) {
		foreach ($menus as $key => $menu) {
			$checked = true;
			foreach ($menus as $key1 => $item) {
				if ($menu->id == $item->parent_id) {
					$menus[$key]->hasParent = 1;
					$checked = false;
					break;
				}
			}
			if ($checked) {
				$menus[$key]->hasParent = 0;
			}
		}
		return $menus;
	}

}