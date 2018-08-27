<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class DownloadController extends Controller
{
    //


	public function index(){
////CHECK IF FILE EXISTS OR NOT IN STORAGE FOLDER + $DIR

		$path = Storage::disk('download')->allfiles();


		$dir = (Storage::disk('download')->getDriver()->getAdapter()->getPathPrefix());
		// $files = $this->listFolders($dir);

		$directories = Storage::disk('download')->directories();
		
		$vars = array();
		foreach ($directories as $dir) {
			$var = new \stdClass();

			$var->dir =  $dir;
			$var->files = Storage::disk('download')->files($dir);

			array_push($vars, $var);

		}

			return view('frontend.downloads.index', compact('vars'));

	}

}
