<?php

namespace App\Http\Controllers;

use App\Jobs\PhoneCreate;
use App\PhoneNote;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

        $count = PhoneNote::query()->count();

        if ($offset > $count) {
            return redirect(route('index'));
        }

        $phoneNotes = PhoneNote::query()
            ->offset($offset ?? 0)
            ->limit(10)
            ->orderByDesc('id');

        if ($search) {
            /*$phoneNotes->where('name', 'like', "%$search%")
                ->orWhere('number', 'like', "%$search%");*/
            $phoneNotes = PhoneNote::search($search)->where('user_id', auth()->id());
        }

        return view('phone_notes.index', [
                'phone_notes' => $phoneNotes->get(),
                'search'      => $search,
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

    public function jobCreate($name, $number, $user_id) {
        PhoneNote::create([
            'name'    => $name,
            'number'  => $number,
            'user_id' => $user_id,
        ]);
    }
    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $data = $request->all();

        dispatch(new PhoneCreate($data['name'], $data['number'], Auth::user()->id))->delay(Carbon::now()->addSecond(10));

        /*PhoneNote::create([
            'name'    => $data['name'],
            'number'  => $data['number'],
            'user_id' => Auth::user()->id,
        ]);*/

        return redirect()->route('index');
    }

    public function update(Request $request) {
        if (auth()->check() && Auth::user()->isRole('moderator')) {
            return view('phone_notes.update', [
                'phone_note' => PhoneNote::where(['id' => $request->id])->firstOrFail()
            ]);
        }
        abort(404);
    }

    public function save(Request $request) {
        $messages = [
            'required' => ':attribute нужно заполнить',
        ];

        $rules = [
            'name' => 'required|max:255',
            'number' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('phone.update', ['id' => $request->id]))->withErrors($validator)->withInput();
        }
        $phoneNote = PhoneNote::where(['id' => $request->id])->firstOrFail();
        $phoneNote->name = $request->name;
        $phoneNote->number = $request->number;
        $phoneNote->save();

        return redirect()->back();

    }

    public function delete()
    {
    }

    public function getFile(Request $request)
    {
        $file = $request->file('file');
    }
}
