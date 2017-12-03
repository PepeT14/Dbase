<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mail\inviteAdmin;
use Mail;

class SuperAdmincontroller extends Controller
{
    //Home
    public function home(){
        return view('superAdmin.home');
    }

    //invite admin
    public function invite(Request $request){
        $superAdmin = Auth::guard('superAdmin')->user();
        Mail::to($request->input('email'))->send(new inviteAdmin($superAdmin));
        return 'E-mail enviado correctamente';
    }
}
