<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = 'Author page';
        $authors = User::where('type', 2)->get();
        return view('admin.author.list', compact('page_name', 'authors'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = 'Author create';
        $roles = Role::pluck('name', 'id');
        return view('admin.author.create', compact('page_name', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'=>'required|min:6',
            'roles.*' => 'required'
        ], [
            'name.required' => "Name field is required",
            'email.email' => "Invalid Email Format",
            'email.unique' => "User Email Already Exist",
            'password.size' => "Password Must Be 6 Character or More",
        ]);

        $author = new User();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = Hash::make($request->password);
        $author->type = 2;
        $roles = $request['roles'];
        $author->save();

        if (isset($roles)) {
            $author->roles()->sync($roles);  //If one or more role is selected associate user to roles
        }
        else {
            $author->roles()->detach();
        }

        return redirect()->action('Admin\AuthorController@index')->with('success', $request->name . 'Author created successfully');
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
        $page_name = 'Author Edit';
        $author = User::find($id);
        return view('admin.author.edit', compact('page_name','author'));
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
