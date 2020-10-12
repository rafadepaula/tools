<?php

namespace App\Http\Controllers;

use Rafadepaula\Tools\Facades\Functions;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function index()
	{
		$totalSize = Functions::calcStorageUsage('medias');
		return view('pages.home.index')
			->with('fileSize', $totalSize);
	}
}
