<?php

namespace App\Http\Controllers\Frontend;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\User\Level;
use App\Models\User\Clan;
use App\Models\User\Gender;
use Illuminate\Support\Facades\Storage;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//Enables us to output flash messaging
use Session;
use Illuminate\Support\Facades\Redirect;
//Image Resizing
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

use Illuminate\Auth\Events\Registered;
use App\Jobs\SendConfirmationEmail;


class UserController extends Controller
{
    //

	public function __construct()
	{
		$this->middleware('auth')->except('index','create','store','storeClan','userConfirmed');
	}
	public function index($id){

		$user =  User::find($id);
		$user->level =  Level::where('from','<=',$user->experiencepoints)->where('till','>=',$user->experiencepoints)->first();
		$user->clan = Clan::where('id','=',$user->clan_id)->first(); 
		$user->gender =  Gender::where('id','=', $user->gender_id)->first();
		return view('frontend.user.index')->with('user', $user);
	}

	public function create(){

		$clans = Clan::all();
		$genders = Gender::all();

		return view('frontend.user.create')->with('clans', $clans)->with('genders', $genders);
	}

	public function store(Request $request){


		$validator = Validator::make($request->all(), [
			'username' => 'required|unique:users|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
		]);

		if ($validator->fails()) {
			return redirect()
			->back()
			->withErrors($validator)
			->withInput();
		}

		$user = new User();

		$user->username =  $request->input('username');
		$user->clan_id =  $request->input('clan_id');
		$user->email =  $request->input('email');
		$user->password =  $request->input('userPassword');
		$user->firstname =  $request->input('firstname');
		$user->name =  $request->input('lastname');
		$user->password = $request->input('password');

		$user->birthDate =  date("Y-m-d H:i:s",strtotime($request->input('birthDate')));
		$user->gender_id =  $request->input('gender');
		$user->street =  $request->input('street');
		$user->zip =  $request->input('zip');
		$user->city =  $request->input('city');
		$user->country =  $request->input('country');
		$user->phone =  $request->input('phone');
		$user->signature =  $request->input('signature');
		$user->locked =  0;
		$user->confirmation_code = encrypt($user->username);
		$user->confirmed = 0;
		$user->experiencepoints = 0;


		$user->save();

		$userAvatar = User::find($user->id);
		if ($request->file('avatar')) 
		{

			$image = $request->file('avatar');
			$filename = $userAvatar->username . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'user/' . $userAvatar->username .'/avatar'.'/'))) 
				{

					File::makeDirectory(public_path('storage/media/' . 'user/' . $userAvatar->username .'/avatar'.'/'), 0775, true);
				}
				$path = public_path('storage/media/' . 'user/' . $userAvatar->username .'/avatar'.'/'. $filename);

				Image::make($image)->resize(200,200)->save($path);

				$userAvatar->avatar = 'user/' . $userAvatar->username .'/avatar'.'/'. $filename;

			}

			$userAvatar->save();
			//Checking if a role was selected

			$role_r = Role::where('name', '=', 'member')->firstOrFail();
			$user->assignRole($role_r);

			// Send Mail to User with Link + ConfirmationCode
			dispatch(new SendConfirmationEmail($user));

			flash('successful stored + Mail Send')->success()->important();

			return redirect()->route('user.index', $userAvatar->id);
		}

		public function edit($id){

			$clans = Clan::all();
			$genders = Gender::all();
			$user =  User::find($id);
			$user->level =  Level::where('from','<=',$user->experiencepoints)->where('till','>=',$user->experiencepoints)->first();
			$user->clan = Clan::where('id','=',$user->clan_id)->first(); 
			$user->gender =  Gender::where('id','=', $user->gender_id)->first();

			return view('frontend.user.edit')->with('user', $user)->with('clans', $clans)->with('genders', $genders);
		}

		public function update(Request $request,$id){

			$user = User::find($id);

			$user->email = $request->input('email');
			//$user->avatar = $request->input('avatar');
			$user->firstname = $request->input('firstname');
			$user->name =  $request->input('lastname');
			$user->birthdate = $request->input('birthdate');
			$user->gender_id =  $request->input('gender');
			$user->street = $request->input('street');
			$user->zip =  $request->input('zip');
			$user->city = $request->input('city');
			$user->country =  $request->input('country');
			$user->phone = $request->input('phone');
			$user->handy =  $request->input('handy');
			$user->clan_id =  $request->input('clan');
			$user->signature = $request->input('signature');


			if ($request->file('avatar')) 
			{
				if (File::exists(public_path('storage/media/' . $user->avatar))) {
					
					$img = Image::make(public_path('storage/media/' . $user->avatar))->destroy();
				}
				$image = $request->file('avatar');
				$filename = $user->username . '.' . $image->getClientOriginalExtension();

				if (!File::exists(public_path('storage/media/' . 'user/' . $user->username .'/avatar'.'/'))) {

					File::makeDirectory(public_path('storage/media/' . 'user/' . $user->username .'/avatar'.'/'),0755,true);
				}
				$path = public_path('storage/media/' . 'user/' . $user->username .'/avatar'.'/'. $filename);


				Image::make($image)->resize(200,200)->save($path);

				$user->avatar = 'user/' . $user->username .'/avatar'.'/'. $filename;
			}

			$user->save();

			flash(__('template.user.updateUser'))->success()->important();
			return redirect()->route('user.index', ['id' => $id]);

		// flash('__(forum.post.updateThread)')->success()->important();
		// return redirect()->route('forum.thread', ['id' => $id, 'threadId' => $thread->id ]);
		}


		public function lockUser($id){
			$user =  User::find($id);


			if ($user->locked == 0) 
			{
				$user->locked = 1;
				flash(__('template.user.Userlocked'))->warning()->important();
			}
			else
			{
				$user->locked = 0;
				flash(__('template.user.Userunlocked'))->warning()->important();
			}

			$user->save();

			return back();

		}

		public function storeClan(Request $request)
		{

			$clan = new Clan();
			$clan->name = $request->input('name');
			$clan->website = $request->input('website');
			$clan->avatar = $request->input('avatar');



			if ($request->file('avatar')) 
			{

				$image = $request->file('avatar');
				$filename = $clan->name . '.' . $image->getClientOriginalExtension();

				if (!File::exists(public_path('storage/media/' . 'clan/' . $clan->name .'/avatar'.'/'))) {

					File::makeDirectory(public_path('storage/media/' . 'clan/' . $clan->name .'/avatar'.'/'),0755,true);
				}
				$path = public_path('storage/media/' . 'clan/' . $clan->name .'/avatar'.'/'. $filename);


				Image::make($image)->resize(200,200)->save($path);

				$clan->avatar = 'user/' . $clan->name .'/avatar'.'/'. $filename;

			}

			$clan->save();

			flash('Clan ' . $clan->name . ' saved')->success()->important();

			return redirect()->back()->withInput();
		}


		public function confirmUser()
		{
			return view('frontend.user.confirm');

		}

		public function userConfirmed($code)
		{
			$user = User::where('confirmation_code',$code)->first();

			if ($user) 
			{
				
				if (!$user->confirmed) 
				{
				// if user is not confirmed -> confirm him
					$user->confirmed = 1;
					$user->locked = 0;
					$user->save();

					flash( $user->username . ' is confirmed')->success()->important();
					return Redirect::to('login');
				}
				else
				{
				// if user is already confirmed -> 
					flash('Code is already used, try the Login')->warning()->important();
					return Redirect::to('login');
				}
			}
			else
			{
				flash('No User Exists for Confirmation Code')->error()->important();
				return Redirect::to('login');
			}


		}
	}
