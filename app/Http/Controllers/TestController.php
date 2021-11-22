<?php

namespace App\Http\Controllers;

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
}
