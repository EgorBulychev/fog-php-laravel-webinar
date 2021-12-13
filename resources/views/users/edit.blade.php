@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('users.save') }}" method="POST">
                {{ csrf_field() }}
                {{ $user->name }}
                <input type="hidden" name="id" value="{{ $user->id }}">

                <select name="role" id="">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>user</option>
                    <option value="moderator" {{ $user->role === 'moderator' ? 'selected' : '' }}>moderator</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                </select>

                <button type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection