<?php

namespace App\Http\Controllers;

use App\User;
use Validator;

use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $users = User::all();

        $data = [
            'data' => $users,
        ];


        return view('users.users', $data);

    }

    public function store(Request $request)
    {
        //        'name', 'email', 'password', 'email_token'
        $user = User::create($request->all());
        $user->password = bcrypt('secret');
        $user->verified = 1;


        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user, 201);
    }


    public function update(Request $request,$id)
    {

        $rules = array(
            'name' => 'required|max:30',
            'email' => 'required|email'

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray()
            ));
        else {
            $user = User::find($id);
            $user->name = ($request->name);
            $user->email = ($request->email);
            $user->save();

            return response()->json($user);
        }


        return response()->json($user, 201);
    }

    public function destroy($id)
    {
        $user = User::destroy($id);
        return response()->json($user, 201);
    }
}
