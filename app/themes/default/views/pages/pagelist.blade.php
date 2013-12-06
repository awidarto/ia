@extends('layout.front')

@section('content')
    <h2>Pages</h2>
    @foreach($pages as $p)
    <h3>{{$p['title']}}</h3>
    {{$p['body']}}
    @endforeach

@stop