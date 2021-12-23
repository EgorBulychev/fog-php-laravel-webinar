@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('post') }}" method="GET">
            <input type="text" name="query" value="{{ $query }}">
            <button type="submit">Поиск</button>
        </form>

        @foreach($posts as $post)
        <div class="row">
            {{ $post->name }}<br>
            {{ $post->post }}<br>
            <a href="{{ route('post.edit', ['id' => $post->id]) }}">Ред.</a>
            <hr>
        </div>
        @endforeach

        {{ $posts->render() }}
    </div>
@endsection