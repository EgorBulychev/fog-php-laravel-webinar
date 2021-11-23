<?php

namespace App\Http\Controllers;

use App\PhoneNote;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhoneNoteController extends Controller
{
    /**
     * Форма добавления записей и предварительный просмотр таблицы
     *
     * @return Factory|Application|View
     */
    public function index()
    {
        return view('phone_notes.index', [
            'phone_notes' => PhoneNote::all(),
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
        ]);

        return redirect()->route('index');
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
