@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Телефонный справочник</div>
                    <div class="panel-body">
                        Привет, {{ Auth::user()->name }} ({{ Auth::user()->id }})!
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">Номер</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phone_notes as $phone_note)
                                    <tr>
                                        <th scope="row">{{ $phone_note->id }}</th>
                                        <td>{{ $phone_note->name }}</td>
                                        <td>{{ $phone_note->number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form method="post" action="/phone-notes/create" class="form-inline">

                            {{ csrf_field() }}

                            <label class="sr-only" for="inlineFormInputName2">Имя</label>
                            <input type="text"
                                   class="form-control mb-2 mr-sm-2"
                                   id="inlineFormInputName2"
                                   placeholder="Имя"
                                   name="name">

                            <label class="sr-only" for="inlineFormInputGroupUsername2">Телефон</label>
                            <input type="text"
                                   class="form-control"
                                   id="inlineFormInputGroupUsername2"
                                   placeholder="Телефон"
                                   name="number">

                            <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
