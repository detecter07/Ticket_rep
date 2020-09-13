@extends('welcome')

@section('content')

<form action="{{ route('tickets.update',$ticket->id) }}" method="POST">
    @csrf
    <label>Title<label>
    <input type ="text" name="title" value="{{$ticket->title}}">

    <label>Content<label>
    <input type ="text" name="content" value="{{$ticket->content }}">

   <input type ="submit" value="edit"/>

</form>


@endsection