<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class SessionsController extends Controller
{

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sessions = '';
        $regras = [
            'email' => 'required',
            'password' => 'required'
        ];

        $feedback = [
            'required' => 'there are mandatory fields not filled in',
        ];

        $request->validate($regras,$feedback);

        $email = $request->email;
        $password = base64_encode($request->password);
        
        if(Users::where('email',$email)->where('password',$password)->select(array('id_user','name','email'))->count() > 0){
          $sessions = Users::where('email',$email)->where('password',$password)->select(array('id_user','name','email'))->get();
          return response($sessions,200);
        }else{
            return response('',400);
        }

        
    }
}
