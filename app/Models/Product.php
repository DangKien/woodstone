<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Product extends MyModel
{
	use Translatable;

    protected $table = "products";

	protected $translationModel = "App\Models\ProductTranslation";

	protected $translatedAttributes = ['name', 'description', 'slug', 'content', 'digital_radio', 'specifications',
	                                   'series', 'meta_title', 'meta_description', 'meta_data'];

	public $translationForeignKey = 'product_id';

	public function filterName($params) {
		if (!empty($params) ) {
			$this->setFunctionCond('where', ['title', 'like', "%".$params."%"]);
		}
		return $this;
	}

	public function category () {
		return $this->hasOne('App\Models\Category', 'id', 'category_id');
	}
}
