<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function account()
    {
        if (Auth::check() == true)
        {
            return redirect('/dashboard');
        }
        return view('profile.create');
    }

    public function store(Request $request)
    {
//        Validate all form posts
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:50|unique:users,username',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|max:255',
            'confirm_password' => 'required|max:255|same:password',
        ]);

        $password = password_hash(request('password'), PASSWORD_DEFAULT);

//        Generate slug based on name
        $slug1 = $maybe_slug = strtolower(request('name'));
        $slug = str_replace(' ', '-', $maybe_slug);
        $next = 2;
        while (User::where('slug', '=', $slug)->first()) {
            $slug = "{$maybe_slug}-{$next}";
            $next++;
        }

//        Create new user with data
        $user = new User();
        $user->username = request('username');
        $user->name = request('name');
        $user->email = request('email');
        $user->password = $password;
        $user->slug = $slug;
        $user->save();

        $user = User::where('email', request('email'))->first();

        $username = $request->get('email');
        $password = $request->get('password');
        $credentials = ['email' => "$username", 'password' => $password];

        if (Auth::attempt($credentials) == true) {
            return redirect('dashboard');
        }

        return redirect('/dashboard');
    }

    public function login(Request $request)
    {
//        Validate all form posts
        $this->validate($request, [
            'email_login'  => 'required|max:255|email',
            'password_login'  => 'required',
        ]);
//        dd($request->all());

//        Check if username and password match in database
        $username = $request->get('email_login');
        $password = $request->get('password_login');
        $credentials = ['email' => "$username", 'password' => $password];

        if (Auth::attempt($credentials) == true) {
//            Auth passed
            return redirect()->route('user.dashboard');
        }
        else {
//            Auth not passed
            return redirect()->route('auth.login')->with([
                'danger_login_login' => 'Email or password not correct!!'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/account');
    }
}
