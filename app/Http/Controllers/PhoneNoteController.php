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
        $offset = $request->get('offset');
        $offset = $offset < 0 ? 0 : $offset;

        if ($search) {
            return view('phone_notes.index', [
                'phone_notes' => PhoneNote::query()
                    ->where('user_id', Auth::user()->id)
                    ->where('name', 'like', "%$search%")
                    ->offset($offset ?? 0)
                    ->limit(10)
                    ->orderBy('name')
                    ->get(),
                'search'      => $search,
                'offset'      => $offset,
            ]);
        }

        $count = PhoneNote::query()->where('user_id', Auth::user()->id)->count();

        return view('phone_notes.index', [
            'phone_notes' => PhoneNote::query()
                ->where('user_id', Auth::user()->id)
                ->offset($offset ?? 0)
                ->limit(10)
                ->orderBy('name')
                ->get(),
            'search'      => '',
            'offset'      => $offset,
            'count'       => $count,
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
            'name'    => $data['name'],
            'number'  => $data['number'],
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

    public function getFile(Request $request)
    {
        $file = $request->file('file');
    }
}
