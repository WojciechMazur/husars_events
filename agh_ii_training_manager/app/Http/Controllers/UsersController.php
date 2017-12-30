<?php

namespace App\Http\Controllers;

use App\Customer;
use DebugBar\DebugBar;
use const Grpc\STATUS_OK;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Jenssegers\Mongodb\Auth\User;
use function MongoDB\BSON\toJSON;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Customer::all();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Customer::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return int
     */
    public function update(Request $request, $id)
    {
        $user = Customer::find($id);
        $user['first_name']=$request['first_name'];
        $user['second_name']=$request['second_name'];
        $user['surname']=$request['surname'];
        $user['address']=$request['address'];
        $user['city']=$request['city'];
        $user['state']=$request['state'];
        $user['country']=$request['country'];
        $user['email']=$request['email'];
        $user['phone']=$request['phone'];
        $user['zip-code']=$request['zip_code'];
        if($request['password'] != null)
            $user['password']=bcrypt($request['password']);
        $user->save();
        return redirect('/admin')->with('status', 'Customer updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response|int
     */
    public function destroy($id)
    {
        $user= Customer::find($id);
        if($user==null)
            return Response::HTTP_NOT_FOUND;
        return Customer::destroy($id);
        return Response::HTTP_OK;
    }
}
