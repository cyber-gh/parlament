<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('login');
    }

    public function loginRequest(Request $request) {

        $v = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }

        $user = User::where("email", $request->email)->first();

        if ($user == null) {
            $v->errors()->add("email", "No such user");
            return redirect()->back()->withErrors($v->errors());
        }

        if (password_verify($request->password, $user->password)) {
            session()->put("isLogged", true);
            session()->put("email", $user->email);
            if ($user->role == 2) {
                session()->put("isAdmin",true);
            } else {
                session()->put("isAdmin",false);
            }
            return Redirect::to("members");
        } else {
            $v->errors()->add("password", "Wrong password");
            return redirect()->back()->withErrors($v->errors());
        }


    }

    public function logout(Request $request) {
        session()->put("isLogged", false);
        session()->put("email");
        session()->put("isAdmin", false);

        return Redirect::to("login");
    }
}
