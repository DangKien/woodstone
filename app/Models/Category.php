<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use App\Models\MyModel;

class Category extends MyModel
{
    use Translatable;

    protected $talbe = 'categories';

    protected $translationModel = "App\Models\CategoryTranslation";

    protected $translatedAttributes = ['name', 'description', 'slug', 'meta_title', 'meta_description', 'meta_keyword'];

    public $translationForeignKey = 'category_id';

    public function filterName($params) {
	    if (!empty($params) ) {
		    $this->setFunctionCond('where', ['name', 'like', "%".$params."%"]);
	    }
	    return $this;
    }

}
