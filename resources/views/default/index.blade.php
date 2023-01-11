@extends('default.layouts.layout')

@section('navbar')
	@parent
@endsection

@section('header')
	@parent
@endsection


@section('sidebar')
	@parent
	
	<div class="sidebar-module">
     <h4>About</h4>
     <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>
	
@endsection



@section('content')
      	@include('default.content')
@endsection 

