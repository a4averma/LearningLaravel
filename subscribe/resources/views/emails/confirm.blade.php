@extends('layouts.app')

@section('content')
<h1>Thanks for Signing up</h1>
<a href='{{url("register/confirm/{$user->verify_token}")}}'>Here</a>

@endsection