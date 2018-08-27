<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;
use App\Models\User\Clan;
use App\Models\User\Gender;
use Illuminate\Support\Facades\Storage;
use Validator;


//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//Image Resizing
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;



//Enables us to output flash messaging
use Session;

class UserController extends Controller
{

	public function __construct() {
		$this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		
	//Get all users and pass it to the view
		$users = User::all(); 
		return view('backend.users.index',compact('users'));
	}

	public function anyData(){

		if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		

		return \DataTables::of(User::query())->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{

		if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		
	//Get all roles and pass it to the view
		$clans = Clan::all();
		$genders = Gender::all();
		$roles = Role::get();
		return view('backend.users.create', ['roles'=>$roles],compact('clans','genders'));
	}
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request) {

		if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
		{
			abort('401');
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
		$user->locked = 1;
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


				Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

				$userAvatar->avatar = 'user/' . $userAvatar->username .'/avatar'.'/'. $filename;

			}

			$userAvatar->save();
			$roles = $request['roles']; 

			if (isset($roles)) 
			{
				foreach ($roles as $role) 
				{
					$role_r = Role::where('id', '=', $role)->firstOrFail();            
					$user->assignRole($role_r); 
				}
			}


			flash('successful stored')->success()->important();

			return redirect()->route('news.index');

		}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{

		if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$user =  User::find($id);
		return view('backend.users.show',compact('user')); 
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{   

		if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		
		$user = User::findOrFail($id); //Get user with specified id
		$clans = Clan::all();
		$genders = Gender::all();
		$roles = Role::get();

		return view('backend.users.edit', compact('user', 'roles', 'clans', 'genders')); //pass user and roles data to view

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{

		if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
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
		if ($request->input('lockCheck') !== null) {
			$user->locked = 1;
		}
		else{
			$user->locked = 0;
		}


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


			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$user->avatar = 'user/' . $user->username .'/avatar'.'/'. $filename;
		}

		$user->save();

		$roles = $request['roles']; //Retreive all roles

		if (isset($roles)) {        
			$user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
		}        
		else {
			$user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
		}

		flash('successful updated')->important();

		return redirect()->route('users.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{

		if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		
		//Find a user with a given id and delete
		$user = User::findOrFail($id); 
		$user->delete();

		return redirect()->route('users.index')
		->with('flash_message',
			'User successfully deleted.');
	}

	public function locked($id)
	{
		
		if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		$user = User::find($id);


		if ($user->locked == 1) {
			$user->locked = 0;
			$user->save();

			flash($user->username . ' unlocked')->success()->important();
			return redirect()->back();
		}
		else
		{
			$user->locked = 1;
			$user->save();

			flash($user->username . ' locked')->warning()->important();
			return redirect()->back();
		}


	}


}
