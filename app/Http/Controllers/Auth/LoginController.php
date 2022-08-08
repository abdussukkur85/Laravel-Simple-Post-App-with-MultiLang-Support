<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function __construct() {
        $this->middleware(['guest']);
    }
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);



        if (!Auth::attempt($request->only('email', 'password'), $request->remember_me)) {
            return back()->with('status', 'Invalid Login Details');
        }

        return redirect()->route('posts.index');
    }
}
