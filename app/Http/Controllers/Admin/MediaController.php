<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	public function index(){


		$allFiles = Storage::disk('downloads')->allFiles();



		return view('backend.media.index', compact('allFiles'));
	}

	public function getFile($folderPath)
	{
		$allFiles = Storage::disk('downloads')->allFiles($folderPath);
		

		return view('backend.media.index', compact('allFiles'));
	}
}
