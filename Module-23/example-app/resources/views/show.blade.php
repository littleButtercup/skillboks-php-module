@extends('layouts.app')
@section('content')
    <form action="update" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" value="{{$text->id}}"/>
        <input name="title" value="{{$text->title}}"/>
        <input name="text" value="{{$text->text}}"/>
        <input name="public" type="checkbox" {{$text->public===true?'checked':''}}/>
        <button type="submit">submit</button>
    </form>
@endsection

