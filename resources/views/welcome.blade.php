@extends('layouts.base')
@section('content')
<h1>The best Url-Shortener Out there</h1>
<form action="" method="POST">
    {{ csrf_field() }}
    <input type="text" name="url" placeholder="Enter your original url here" value="{{old('url')}}">
    <input type="submit" value="Shorten URL" id="">
    {!! $errors->first('url','<p class="error-mgs">:message</p>')!!}

</form>
@stop