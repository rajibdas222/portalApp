<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = 'Roles page';
        $roles = Role::all();
        return view('admin.role.list',compact('page_name','roles'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_name = 'Role Create';
        $permission = Permission::pluck('name', 'id');
        return view('admin.role.create', compact('permission', 'page_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
            'permissions.*' => 'required|string'
        ],[
            'name.required' => "Name Field is reqiured",
            'permissions.required' => "You must Select Permissions",
            'permissions.*.required' => "You must Select Permissions",
            'permissions.*' => 'required'
        ],[
            'name.required' => "Name Field is reqiured",
            'permissions.required' => "You must Select Permissions",
            'permissions.*.required' => "You must Select a Permission"

        ]);


        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->description = $request->description;

        $permissions = $request['permissions'];
        $role->save();

        if($request->permissions <> ''){
            $role->permissions()->attach($request->permissions);
        }

        return redirect()->action('Admin\RoleController@index')->with('success',$request->name. 'Role Permission created successfully');


    }




    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_name = 'Role-Edit';
        $role = Role::find($id);
        $permissions = Permission::pluck('name','id');
        $selectedPermission = DB::table('role_has_permissions')->where("role_has_permissions.role_id",$id)->pluck('permission_id')->toArray();

      return view('admin.role.edit', compact( 'page_name','role','permissions','selectedPermission'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
            'permissions.*' =>'required',
        ],[
            'name.required' => "Name Field is reqiured",
            'permissions.required' => "You must Select Permissions",
            'permissions.*.required' => "You must Select Permissions",
        ]);


        $role = Role::find($id);
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->description = $request->description;


        //$permissions = $request['permissions'];
        $role->save();

        DB::table('role_has_permissions')->where('role_id',$id)->delete();

        if($request->permissions <> ''){
            $role->givePermissionTo()->attach($request->permissions);
        }
        return redirect()->action('Admin\RoleController@index')->with('success', 'Role Permission updated successfully');

        $permissions = $request['permissions'];
        $role->save();

        //DB::table('role_has_permissions')->where('role_id',$id)->delete();

        if($request->permissions <> ''){
            $role->permissions()->attach($request->permissions);
        }

        return redirect()->action('Admin\RoleController@index')->with('success',$request->name. 'Role Permission updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    Role::where('id',$id)->delete();
    return redirect()->action('Admin\RoleController@index')->with('success', 'Roles delete Successfully');

    }
}
