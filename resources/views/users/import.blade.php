@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('users.import.data') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="file" name="import">

                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
@endsection