@extends('layouts.app')

@section('content')
    <ul>
        @foreach($phones as $phone)
            <li>
                {{ $phone->id }}. {{ $phone->email }}
            </li>
        @endforeach
    </ul>
@endsection