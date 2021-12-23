@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('post.save') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $post->id }}">
                <input type="text" name="name" value="{{ $post->name }}"><br>
                <textarea name="post" style="width: 100%" rows="10">{{ $post->post }}</textarea>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection