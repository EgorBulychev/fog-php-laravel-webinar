@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('users.save.profile') }}" method="POST">
            {{ csrf_field() }}
        <div class="row">
            <input type="text" name="name" value="{{ $user->name }}">
        </div>
        <div class="row">
            <strong>Email:</strong> {{ $user->email }}
        </div>
        <div class="row">
            <strong>Роль:</strong> {{ $user->role }}
        </div>
        <div class="row">
            <strong>API TOKEN:</strong>
            @if (empty($user->api_token))
                <a href="{{ route('users.token') }}">Создать ключ</a>
            @else
                <pre>{{ $user->api_token }}</pre>
                <a href="{{ route('users.token') }}">Пересоздать ключ</a>
            @endif
        </div>
            <button type="submit">Сохранить</button>
        </form>
    </div>
@endsection