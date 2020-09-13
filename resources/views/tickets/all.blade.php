@extends('welcome')

@section('content')

@foreach ($tickets as $t )
    <h2><a href ="{{ route('tickets.show',$t['id']) }}">{{$t['title']}}</a></h2>
    <p>
        {{$t['content']}}
    </p>

    
    <a href ="{{ route('tickets.edit',$t['id']) }}">edit </a>

@endforeach


@endsection