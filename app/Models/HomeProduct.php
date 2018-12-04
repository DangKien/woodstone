<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeProduct extends MyModel
{
	use \Dimsav\Translatable\Translatable;
	protected $talbe = 'home_products';

	protected $translationModel = "App\Models\HomeProductTranslation";

	protected $translatedAttributes = ['name', 'description', 'content'];

	public $translationForeignKey = 'home_product_id';

	public function filterName($params) {
		if (!empty($params) ) {
			$this->setFunctionCond('where', ['name', 'like', "%".$params."%"]);
		}
		return $this;
	}

}
