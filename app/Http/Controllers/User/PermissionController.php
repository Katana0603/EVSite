<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
        {
            abort('401');
        }
        $permissions = Permission::all(); //Get all permissions

        return view('backend.permissions.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
        {
            abort('401');
        }
        $roles = Role::get(); //Get all roles

        return view('backend.permissions.create')->with('roles', $roles);
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
        
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        flash('Permission'. $permission->name.' stored')->success()->important();
        return redirect()->route('permissions.index');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
        {
            abort('401');
        }
        
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
        {
            abort('401');
        }
        
        $permission = Permission::findOrFail($id);

        return view('backend.permissions.edit', compact('permission'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
        {
            abort('401');
        }
        
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $permission->fill($input)->save();

        flash('Permission'. $permission->name.' updated!')->success()->important();
        return redirect()->route('permissions.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        if (!Auth::user()->hasPermissionTo('User-Admin')) //If user does //not have this permission
        {
            abort('401');
        }
        
        $permission = Permission::findOrFail($id);

    //Make it impossible to delete this specific permission 
        if ($permission->name == "Administer roles & permissions") {


            flash('Cannot delete this Permission!')->error()->important();

            return redirect()->route('permissions.index');
        }

        $permission->delete();



        flash('Permission deleted!')->error()->important();

        return redirect()->route('permissions.index');

    }
}
