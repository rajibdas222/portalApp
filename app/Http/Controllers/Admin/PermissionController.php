<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class PermissionController extends Controller
{

    public function index()
    {

        $page_name = 'Permission';
        $permissions = Permission::all();
        return view('admin.permission.list', compact('permissions', 'page_name'));

    }


    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|alpha_num',
        ], [
            'name.required' => "Name Field is reqiured",
            'name.alpha_num' => "This field accpets alpha numeric charaters"
        ]);


        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;
        $permission->permission_description = $request->permission_description;


        $roles = $request['roles'];

        $permission->save();


        if (!empty($request['roles'])) {
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record
                $permission = Permission::where('name', '=', $name)->first();
                $r->givePermissionTo($permission);
            }
        }




        return redirect()->action('Admin\PermissionController@index')->with('success', $permission->name .' Permission created successfully');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $page_name = 'Permission-Edit';
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission', 'page_name'));


    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|alpha_num',
        ], [
            'name.required' => "Name Field is reqiured",
            'name.alpha_num' => "This field accpets alpha numeric charaters"
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;
        $permission->permission_description = $request->permission_description;

        $permission->save();

        return redirect()->action('Admin\PermissionController@index')->with('success', 'Permission updated successfully');
    }


    public function destroy($id)
    {

        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->action('Admin\PermissionController@index')->with('success', 'Permission deleted successfully');


    }
}
