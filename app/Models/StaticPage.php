<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class StaticPage extends Model
{
	use Translatable;

    protected $table = "static_pages";

	protected $translationModel = "App\Models\StaticPageTranslation";

	protected $translatedAttributes = ['content', 'seo_title', 'seo_keyword', 'description'];

	public $translationForeignKey = 'static_page_id';

}
