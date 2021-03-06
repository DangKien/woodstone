<?php

	function statusAvailable($status) {
		if ($status ==  App\Libs\Configs\StatusConfig::CONST_AVAILABLE) {
			return true;
		} 
		return false;
	}

	function statusDisable($status) {
		if ($status ==  App\Libs\Configs\StatusConfig::CONST_DISABLE) {
			return true;
		} 
		return false;
	}

	function _updateSortBy ($model, $sortByNew, $sortByOld) {
	$sortMax   = $model::max('sort_by');
	if ($sortMax + 1 != $sortByNew && $sortByOld != $sortByNew) {
		if ($sortByOld == -1) {
			//Insert sort by new
			$listSortUp = $model->select('id', 'sort_by')->where('sort_by', ">=" , (int) $sortByNew)->get();

			foreach ($listSortUp as $key => $sort) {
				$dataSortUp          = $model->findOrFail($sort->id);
				$sortOld             = $sort->sort_by;
				$dataSortUp->sort_by = $sortOld + 1;
				$dataSortUp->save();
			}
		} else {
			//Update sort by old
			if ($sortByNew > $sortByOld) {
				// Ex: 1 -> 4 down 2 to 4 one time.
				$listSortDown = $model->select('id', 'sort_by')->whereBetween('sort_by', [$sortByOld + 1, $sortByNew])->get();
				foreach ($listSortDown as $key => $sort ) {
					$dataSortUp          = $model->findOrFail($sort->id);
					$sortOld             = $sort->sort_by;
					$dataSortUp->sort_by = $sortOld - 1;
					$dataSortUp->save();
				}
			}
			else {
				// Ex: 6 -> 3 up 5 to 3 on time
				$listSortDown = $model->select('id', 'sort_by')->whereBetween('sort_by', [$sortByNew, $sortByOld - 1])->get();
				foreach ($listSortDown as $key => $sort ) {
					$dataSortUp          = $model->findOrFail($sort->id);
					$sortOld             = $sort->sort_by;
					$dataSortUp->sort_by = $sortOld + 1;
					$dataSortUp->save();
				}
			}
		}
		return $listSortDown;
	}
}

	function showCategories($categories, $parent_id = 0, $char = ' -- ', $selected = 0, $category_id = -1) {
	    foreach ($categories as $key => $item) {
	    	if ($item->parent_id == $parent_id && $item->parent_id != $category_id && $category_id != $item->id) {
	    		if ($selected == $item->id) {
					echo '<option selected = "selected" value="'.$item->id.'">';
			        echo $char ." ". $item->name ." ". $char;
			        echo '</option>';

			        unset($categories[$key]);
	    		} else {
					echo '<option value="'.$item->id.'">';
			        echo $char ." ". $item->name ." ". $char;
			        echo '</option>';

			        unset($categories[$key]);
	    		}
	    		showCategories($categories, $item->id, $char.' -- ', $selected, $category_id);
	    	}
	    }
	}

	function showCategory ($arrs, $parent = 0, $active = array(), $select = 0) {
		echo $parent == 0 ? '<ul class="shop_toggle">' : (in_array($parent, $active) ? '<ul class="categorie_sub" style="display: block">' : '<ul class="categorie_sub">' );
		foreach ($arrs as $key => $arr) {
			if ($arr->parent_id == $parent) {
				echo  $arr->hasParent == 1 ? (in_array($arr->id, $active) ? '<li class="has-sub open">' : '<li class="has-sub ">' ) : '<li>';
	            echo $select ==  $arr->id ? '<p><a class="active" href="'.route('home.categories',[$arr->slug, $arr->id]).'"> '.$arr->name.'</a></p>' :
		                '<p><a href="'.route('home.categories',[$arr->slug, $arr->id]).'"> '.$arr->name.'</a></p>';
				unset($arrs[$key]);
				showCategory($arrs, $arr->id, $active, $select);
				echo '</li>';
			}
		}
		echo '</ul>';
	}

	function showMenuTop ($arrs, $parent) {
		foreach ($arrs as $key => $arr) {
			echo ($parent == 0) ? '<li class="dropdown">' : '';
			if ($arr->parent_id == $parent) {
				echo $parent != 0 ? '<li class="dropdown-submenu">' : '';
				echo  '<p><a href="'.route('home.categories',[$arr->slug, $arr->id]).'"> '.$arr->name.'</a>';
				echo  $arr->hasParent == 1 ? ' <i class="fa fa-caret-down"></i>' : '';
				unset($arrs[$key]);
				showMenuTopChildren($arrs, $arr->id, $arr);
				echo $parent != 0 ? '</p></li>' : '';
			}
			echo ($parent == 0) ? '</li>': '';
		}
	}

	function showMenuTopChildren($arrs, $parent, $arr) {
		if ($arr->hasParent == 1) {
			echo '<ul class="dropdown-menu" role="menu">';
			foreach ($arrs as $key => $arr) {
				echo ($parent == 0) ? '<li class="dropdown">' : '';
				if ($arr->parent_id == $parent) {
					echo $parent != 0 ? '<li class="dropdown-submenu">' : '';
					echo  '<p><a href="'.route('home.categories',[$arr->slug, $arr->id]).'"> '.$arr->name.'</a>';
					echo  $arr->hasParent == 1 ? ' <i class="fa fa-caret-down"></i>' : '';
					unset($arrs[$key]);
					showMenuTopChildren($arrs, $arr->id, $arr);
					echo $parent != 0 ? '</li>' : '';
				}
				echo ($parent == 0) ? '</li>': '';
			}
			echo '</ul>';
		}
	}
