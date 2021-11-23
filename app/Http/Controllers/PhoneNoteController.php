<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhoneNoteController extends Controller
{
    public function index()
    {
        return view('phone_notes.index');
    }
    public function getOne()
    {
        return 'foo';
    }

    public function getAll()
    {
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function create(Request $request)
    {
        return $request->all();
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
