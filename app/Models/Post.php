<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Post extends MyModel
{
	use Translatable;
    protected $table = "posts";

	protected $translationModel = "App\Models\PostTranslation";



	protected $translatedAttributes = ['name', 'description', 'slug', 'meta_title', 'meta_description', 'meta_keyword',
	                                   'title', 'slug', 'description', 'content'];

	public $translationForeignKey = 'post_id';

	public function filterName($params) {
		if (!empty($params) ) {
			$this->setFunctionCond('where', ['title', 'like', "%".$params."%"]);
		}
		return $this;
	}
}
