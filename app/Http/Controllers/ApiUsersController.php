<?php

namespace App\Http\Controllers;

use App\PhoneNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiUsersController extends Controller
{
    public function index() {
        return response()->json([auth()->user()]);
    }

    public function list() {
        return response()->json(User::all());
    }

    public function create(Request $request) {
        $messages = [
            'required' => ':attribute нужно заполнить',
        ];

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errros' => $validator->messages()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password)
        ]);

        return response()->json($user);
    }

    public function role($id, Request $request) {
        $user = User::where(['id' => $id])->first();

        if (!in_array($request->role, [User::ROLE_USER, User::ROLE_ADMIN, User::ROLE_MODERATOR])) {
            return response()->json(['errors' => 'role not found']);
        }

        if ($user) {
            $user->role = $request->role;
            $user->save();
        }

        return response()->json($user);
    }

    public function phoneNotes(Request $request) {

        if ($request->search) {
            $phoneNote = PhoneNote::where('name', 'like', "%$request->search%");

            if ($phoneNote->count() == 0) {
                return response()->json(['errors' => 'not found']);
            }
            return response()->json($phoneNote->get());
        }

        return response()->json(PhoneNote::all());
    }

    public function phoneNotesUpdate($id, Request $request) {
        $phoneNote = PhoneNote::where(['id' => $id])->first();

        if (!$phoneNote) {
            return response()->json(['errors' => 'not found']);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'number' => 'required|max:255'
            ],
            ['required' => ':attribute нужно заполнить']);

        if ($validator->fails()) {
            return response()->json(['errros' => $validator->messages()]);
        }

        $phoneNote->name = $request->name;
        $phoneNote->number = $request->number;
        $phoneNote->save();

        return response()->json($phoneNote);
    }

    public function phoneNotesCreate(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'number' => 'required|max:255'
            ],
            ['required' => ':attribute нужно заполнить']);

        if ($validator->fails()) {
            return response()->json(['errros' => $validator->messages()]);
        }

        return response()->json(
            PhoneNote::create([
                'name' => $request->name,
                'number' => $request->number,
                'user_id' => \Auth::user()->id
            ])
        );
    }
}
