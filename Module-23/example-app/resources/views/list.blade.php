@extends('layouts.app')
@section('content')
    @foreach ($texts as $text)
        <div style="display: flex">
        <div style="flex: 1">{{ $text->title }}</div>
        <div style="flex: 1">{{ $text->text }}</div>
        <div style="flex: 1">{{ $text->public }}</div>
            <a href="show?id={{ $text->id }}">Редактировать</a>
            <form action="delete" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{$text->id}}"/>
                <button type="submit">Удалить</button>
            </form>
        </div>

    @endforeach
    <a href="create">Создать</a>

@endsection

