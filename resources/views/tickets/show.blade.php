@extends('welcome')

@section('content')


    <h2>{{$ticket['title']}}</h2>
    <p>
        {{$ticket['content']}}
    </p>



@endsection