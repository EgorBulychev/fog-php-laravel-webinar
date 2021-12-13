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
            <form action="{{ route('users.create') }}" method="POST">
                {{ csrf_field() }}
                <input type="text" name="name" placeholder="Имя">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password">

                <select name="role" id="">
                    <option value="user" selected>user</option>
                    <option value="moderator">moderator</option>
                    <option value="admin">admin</option>
                </select>

                <button type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection