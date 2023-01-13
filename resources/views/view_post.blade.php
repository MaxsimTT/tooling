@extends('default.layouts.layout')

@section('content')

<div class="col-md-9">

	<div class="">
		<h2>Пост</h2>
    </div>
	
	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	@if (session('message'))
	    <div class="alert alert-success">
	        {{ session('message') }}
	    </div>
	@endif
	
	<form method="post" action="{{ route('admin_update_post_p', ['post' => $post_id]) }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="form-group">
	    <label for="name">Заголовок</label>
	    <input type="text" class="form-control" id="name" name="name" value="{{ $post->name }}" placeholder="Заголовок">
	  </div>
	  <div class="form-group">
	    <input type="hidden" class="form-control" id="user_id" value="{{ $user_id }}" name="user_id">
	    <input type="hidden" class="form-control" id="post_id" value="{{ $post_id }}" name="post_id">
	  </div>
	  <div class="form-group">
	    <label for="text">Текст</label>
	    <textarea class="form-control" id="text" name="text" rows="3">{{ $post->description }}</textarea>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>	
@endsection