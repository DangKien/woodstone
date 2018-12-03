<?php

namespace App\Http\Controllers\Frontend;

use App\Models\StaticPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\Configs\StatusConfig;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->staticPageModel = new StaticPage();
	}

	public function index () {
		return view('Frontend.Contents.index');
    }

    public function contact () {

    	return view('Frontend.Contents.static_page.contact');
    }

    public function about() {
	    $about = $this->staticPageModel::where('key', StatusConfig::CONST_STATIC_ABOUT)
		    ->first();
    	return view('Frontend.Contents.static_page.about', array('about' => $about));
    }

    public function quality () {
//		dd(App::getLocale());
	    $quality = $this->staticPageModel::where('key', StatusConfig::CONST_STATIC_QUANLITY)
		                                    ->firstOrFail();
	    return view('Frontend.Contents.static_page.quality', array('quality' => $quality));
    }

    public function locale (Request $reuqest) {
	    setcookie('locale', $reuqest->locale, time() + (86400 * 30), '/');
	    return redirect()->back();
    }
}
