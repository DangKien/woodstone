<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Post extends Model
{
	use Translatable;
    protected $table = "posts";

	protected $translationModel = "App\Models\PostTranslation";



	protected $translatedAttributes = ['name', 'description', 'slug', 'meta_title', 'meta_description', 'meta_keyword',
	                                   'title', 'slug', 'description', 'content'];

	public $translationForeignKey = 'post_id';
}
