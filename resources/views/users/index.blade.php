@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{ route('users.new') }}">Создать</a>, <a href="{{ route('users.export') }}">Экспорт</a>
            <a href="{{ route('users.import') }}">Импорт</a>
    <table class="table">

        <thead>
            <tr>
                <th>Имя</th>
                <th>E-mail</th>
                <th>Роль</th>
                <th></th>
            </tr>
        </thead>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role}}</td>
            <td><a href="{{ route('users.edit', ['id' => $user->id]) }}">Ред.</a></td>
        </tr>
    @endforeach
    </table>
        </div>
        </div>
@endsection