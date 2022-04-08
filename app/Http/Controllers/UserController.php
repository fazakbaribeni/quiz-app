<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new User)->getAllUsers();
        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=> 'required',
           'email'=> 'required|unique:users',
           'password'=> 'required|min:6',
        ]);
        $user = (new User)->storeUser($request->all());

        return  redirect(route('user.index'))->with('message', 'User Added Succesfully!');

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = (new User)->getUserByID($id);
        return view('backend.user.edit', compact('user'));
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
        // validate the input here, use Request to do the job or whatever you like
        $this->validate($request,[
            'name'=> 'required',
            'email'=> 'required'
        ]);

        $user = User::findOrFail($id);

        // Check user if the passowrd is not set grab the old one from DB
        if($request['password'] == ""){
            $request['password'] = $user->password;
        }

        $user->update($request->all());

        return  redirect(route('user.index'))->with('message', 'User Updated Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Logged in users!
        if(auth()->user->id == $id){
            return redirect(route('user.index'))->with('message', 'YOu can not delete your self!');
        }


        $user = (new User)->deleteUser($id);
        return redirect(route('user.index'))->with('message', 'User deleted succesfully!');
    }
}
