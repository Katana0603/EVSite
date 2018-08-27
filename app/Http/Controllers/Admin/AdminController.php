<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IssueList\IssueList;
use App\Models\toDoList\toDoList;
use App\Models\News\News;
use App\Models\Articel\Articel;
use App\User;
use App\Models\Calendar\Event;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;

use Session;

class AdminController extends Controller
{
	//


	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	public function index(){
		if (!Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user does //not have this permission
		{
			abort('401');
		}
		$news = News::all();
		$articel = Articel::all();
		$issueList = IssueList::where('deleted_at','=',NULL)->get();

		$userRoles = Auth::user()->roles()->get();
		$userRolesIds = array();

		foreach ($userRoles as $role) {
			array_push($userRolesIds, $role->id);
		}
		$toDoList = toDoList::where('user_id', Auth::user()->id)->orWhereIn('role_id', $userRolesIds)->orderBy('created_at', 'desc')->paginate(5);

		foreach ($toDoList as $toDo) {
			if ($toDo->role_id) {
				
				$toDo->role = Role::find($toDo->role_id);

			}
		}
		return view('backend.admin.index',compact('issueList','news','articel','toDoList','userRoles', 'allUser'));
	}

	public function calendar(){
		if (!Auth::user()->hasPermissionTo('Calendar-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		$userRoles = Auth::user()->roles()->get();
		$userRolesIds = array();

		foreach ($userRoles as $role) {
			array_push($userRolesIds, $role->id);
		}

		$calendarEvents = Event::where('user_id', Auth::user()->id)->orWhereIn('role_id', $userRolesIds)->orWhere('all',1)->get();

		foreach ($calendarEvents as $event) {
			if ($event->role_id) {
				
				$event->role = Role::find($event->role_id);

			}
		}

		return view('backend.admin.calendar', compact('calendarEvents','userRoles'));
	}

	public function mailbox(){
		if (!Auth::user()->hasPermissionTo('Mailbox-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.mailbox');
	}

	public function pagesProfile(){
		if (!Auth::user()->hasPermissionTo('Pages-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.pagesProfile');
	}

	public function pagesLogin(){
		if (!Auth::user()->hasPermissionTo('Pages-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.pagesLogin');
	}

	public function pagesRegister(){
		if (!Auth::user()->hasPermissionTo('Pages-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.pagesRegister');
	}

	public function pageslockscreen(){
		if (!Auth::user()->hasPermissionTo('Pages-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.pageslockscreen');
	}

	public function pages404Error(){
		if (!Auth::user()->hasPermissionTo('Pages-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.pages404Error');
	}

	public function pages500Error(){
		if (!Auth::user()->hasPermissionTo('Pages-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.pages500Error');
	}

	public function pagesblank(){
		if (!Auth::user()->hasPermissionTo('Pages-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.pagesblank');
	}


	public function toDoListSaveEntry(Request $request)
	{
		$toDoListEntry =  new toDoList();

		$toDoListEntry->creationUser_id = Auth::user()->id;

		if ($request->input('selfGroup') == 2) {
			$toDoListEntry->role_id = $request->input('roleSelect');
		}
		else{
			$toDoListEntry->user_id  = Auth::user()->id;
		}

		$toDoListEntry->desc = $request->input('desc');
		$toDoListEntry->deadline = date("Y-m-d H:i:s",strtotime($request->input('deadline')));


		$toDoListEntry->save();

		return redirect()->back();
	}

	public function toDoListDeleteEntry(Request $request, $id)
	{

		$toDo = toDoList::find($id);

		$toDo->delete();

		flash('successful deleted', $toDo->desc)->warning()->important();

		return redirect()->back();
	}

}
