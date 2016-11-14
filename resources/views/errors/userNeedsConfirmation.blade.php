<?php
    $route_name = Route::getCurrentRoute()->getPath();
?>
@extends('layouts.app')
@section('content')

@if ($route_name!='logout' )
We still have not confirmed your email address. 
@endif
Please check your email and follow the link provided to confirm your email address.
@endsection
