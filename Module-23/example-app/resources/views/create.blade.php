@extends('layouts.app')
@section('content')
    <form action="update" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input name="title"/>
        <input name="text"/>
        <input name="public" type="checkbox"/>
        <button type="submit">submit</button>
    </form>
@endsection

