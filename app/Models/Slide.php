<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends MyModel
{
    protected $table="slides";

	public function filterName($params) {
		if (!empty($params) ) {
			$this->setFunctionCond('where', ['title', 'like', "%".$params."%"]);
		}
		return $this;
	}
}
