<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Setting extends Model
{
	use Translatable;

    protected $table = 'setting';

	protected $translationModel = "App\Models\SettingTranslation";

	protected $translatedAttributes = ['setting'];

	public $translationForeignKey = 'setting_id';

}
