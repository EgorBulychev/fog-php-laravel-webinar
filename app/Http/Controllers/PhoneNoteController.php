<?php

namespace App\Http\Controllers;

use App\PhoneNote;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhoneNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Форма добавления записей и предварительный просмотр таблицы
     *
     * @return Factory|Application|View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        if ($search) {
            return view('phone_notes.index', [
                'phone_notes' => PhoneNote::query()
                    ->where('user_id', Auth::user()->id)
                    ->where('name', 'like', $search)
                    ->get(),
            ]);
        }

        return view('phone_notes.index', [
            'phone_notes' => PhoneNote::query()->where('user_id', Auth::user()->id)->get(),
        ]);
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
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $data = $request->all();

        PhoneNote::create([
            'name'   => $data['name'],
            'number' => $data['number'],
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('index');
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function getFile(Request $request) {
        $file = $request->file('file');
    }
}
