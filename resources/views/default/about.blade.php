@extends('default.layouts.layout')

@section('header')

@endsection

@section('sidebar')

@endsection

@section('content')
		<div class="jumbotron">	
			@if ($page)
				<h2 class="blog-post-title">{{ $page->name }}</h2>
	            {!! $page->text !!}
			@endif
           </div>
@endsection