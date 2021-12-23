<?php

namespace App\Http\Controllers;

use App\PhoneNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test(Request $request)
    {
        return response()->json([
            'foo'     => 'bar',
            'request' => $request->all(),
        ]);
    }

    public function getUserData() {
        //return User::query()->where('id','=',1)->first();
        // todo поэкспериментировать с запросами
        return User::find(1)->toArray();
    }

    public function getTableData() {
        // todo поэкспериментировать с sql-запросами
        DB::table('users')->where();
    }

    public function db() {
        // SELECT * FROM phone_notes LIMIT 10

        $phoneNotes = PhoneNote::join('users', 'phone_notes.user_id', '=', 'users.id')
            ->select(['phone_notes.*', 'users.email'])
            ->whereIn('user_id', User::where('email', 'like', '%.com%')
                ->select('id')->get()->toArray())
            ->orderByDesc('id')
            ->take(50)->get();

        return view('db', ['phones' => $phoneNotes]);
    }

    public function session(Request $request) {
        session(['qwerty' => 'Russia 2']);
    }

    public function sessionRead() {
        dd(session('qwerty'));
    }
}
