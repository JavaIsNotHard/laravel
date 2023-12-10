<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller {
    public function index() {
        return view('index');
    }

    public function login() {
        return view('login');
    }

    public function verify() {
        //return request()->all();
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (\Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            return redirect('home');
        }

        return redirect('login')->withErrors('Wrong email or password');
    }

    public function register() {
        return view("register");
    }

    public function store() {
        request()->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $user = new User;
        $user->name = request('name');
        $user->email = request('email');
        $user->password = request('password');
        $user->save();
        return redirect('login');
    }

    public function user() {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function edit($id) {
        $user = User::find($id);
        return view('edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'email' => 'required|unique:users|email',
            'name' => 'required|min:5',
        ]);
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->save();
        return redirect('users');
    }

    public function delete($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('users');
    }
}
