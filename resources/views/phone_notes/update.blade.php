@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('phone.save') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $phone_note->id }}">

                <input type="text" name="name" value="{{ $phone_note->name }}">

                <input type="text" name="number" value="{{ $phone_note->number }}">

                <button type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection