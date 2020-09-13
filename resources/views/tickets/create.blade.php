@extends('welcome')

@section('content')

<form action="{{ route('tickets.add') }}" method="POST">
    @csrf
    <label>Title<label>
    <input type ="text" name="title">

    <label>Content<label>
    <input type ="text" name="content">

   <input type ="submit" value="add"/>

</form>


@endsection