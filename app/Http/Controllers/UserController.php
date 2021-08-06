<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view( "user.all-users" );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view( "user.add-user" );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        // dd( $request->all() );

        $data = $request->validate( [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address'  => ['required', 'string'],
            'role'     => ['nullable', 'string'],
            'phone'    => ['required'],
        ] );

        User::create( [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make( $data['password'] ),
            'phone'    => $data['phone'],
            'address'  => $data['address'],
            'role'     => $data['role'],
        ] );

        return redirect()->route( "user.create" )->with( "success", "User Added Successfully" );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user ) {
        // dd($user);

        return view("user.edit-user",[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, User $user ) {
        $data = $request->validate( [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable'],
            'address'  => ['required', 'string'],
            'role'     => ['nullable', 'string'],
            'phone'    => ['required'],
        ] );

        
        if( $data['password'] == null ){
            unset($data['password']);

            $user->update( [
                'name'     => $data['name'],
                'email'    => $data['email'],
                'phone'    => $data['phone'],
                'address'  => $data['address'],
                'role'     => $data['role'],
            ] );
        }else{
            $user->update( [
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make( $data['password'] ),
                'phone'    => $data['phone'],
                'address'  => $data['address'],
                'role'     => $data['role'],
            ] );
        }      

        return redirect()->route( "user.edit", ['user'=> $user->id] )->with( "success", "User Updated Successfully" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user ) {
        $user->delete();

        return redirect()->route('user.index')->with("delete","User Deleted Successfully");
    }
}
