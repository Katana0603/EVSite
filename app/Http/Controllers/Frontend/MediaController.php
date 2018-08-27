<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class MediaController extends Controller
{
    //
    //
	public function index(){
////CHECK IF FILE EXISTS OR NOT IN STORAGE FOLDER + $DIR

		$path = Storage::disk('media')->allfiles();


		$dir = (Storage::disk('media')->getDriver()->getAdapter()->getPathPrefix());
		// $files = $this->listFolders($dir);

		$directories = Storage::disk('media')->directories();
		
		$vars = array();
		foreach ($directories as $dir) {
			$var = new \stdClass();

			$var->dir =  $dir;
			$var->files = Storage::disk('media')->files($dir);

			array_push($vars, $var);

		}

		return view('frontend.media.index', compact('vars'));

	}
}
