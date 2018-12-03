<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Product extends Model
{
	use Translatable;

    protected $table = "products";

	protected $translationModel = "App\Models\ProductTranslation";

	protected $translatedAttributes = ['name', 'description', 'slug', 'content', 'digital_radio', 'specifications',
	                                   'series', 'meta_title', 'meta_description', 'meta_data'];

	public $translationForeignKey = 'product_id';
}
