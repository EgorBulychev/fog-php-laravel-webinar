<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index() {
        return view('users.index', ['users' => User::all()]);
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

    public function profile() {
        return view('users.profile', ['user' => \Auth::user()]);
    }

    public function genApiToken() {
        $token = Str::random(80);

        $user =\Auth::user();
        $user->api_token = $token;
        $user->save();

        return redirect(route('users.profile'));
    }

    public function saveProfile(Request $request) {
        $valid = $request->validate([
            'name' => 'required|max:255'
        ]);

        $user = \Auth::user();

        $user->name = $request->name;
        $user->save();

        return redirect(route('users.profile'));
    }

    public function export() {
        $exportFile = storage_path().'/export.csv';

        if (file_exists($exportFile)) {
            return response()->download($exportFile);
        } else {
            \Artisan::call('export:users');
            return 'Запущен процесс';
        }
    }

    public function import() {
        return view('users.import');
    }

    public function importData(Request $request) {
        $import = file($request->file('import')->path());

        $count = 0;
        foreach ($import as $item) {
            if (empty(trim($item))) continue;
            $user = explode("\t", trim($item));

            if (!User::where(['email' => $user[1]])->first()) {
                $user = User::create([
                    'name' => $user[0],
                    'email' => $user[1],
                    'role' => $user[2],
                    'password' => \Hash::make('qwerty')
                ]);
                if ($user) $count++;
            }
        }

        return view('users.import_result', ['count' => $count]);
    }
}
