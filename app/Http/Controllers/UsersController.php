<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index() {
        if (auth()->check() && \Auth::user()->isRole('admin')) {
            return view('users.index', ['users' => User::all()]);
        } else {
            abort(404);
        }
    }

    public function edit(Request $request) {
        return view('users.edit', ['user' => User::where(['id' => $request->id])->first()]);
    }

    public function save(Request $request) {
        $user = User::where(['id' => $request->id])->first();
        $user->role = $request->role;
        $user->save();

        return redirect(route('users.index'));
    }

    public function new() {
        return view('users.new');
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = \Hash::make($request->password);
        $user->save();

        return redirect(route('users.index'));
    }
}
