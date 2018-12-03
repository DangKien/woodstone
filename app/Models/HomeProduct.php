<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeProduct extends Model
{
	use \Dimsav\Translatable\Translatable;
	protected $talbe = 'home_products';

	protected $translationModel = "App\Models\HomeProductTranslation";

	protected $translatedAttributes = ['name', 'description', 'content'];

	public $translationForeignKey = 'home_product_id';
}
