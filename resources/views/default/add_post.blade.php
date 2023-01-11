@extends('default.layouts.layout')

@section('content')

<div class="col-md-9">

	<div class="">
		<h2>Добавление нового материала</h2>
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
	
	<form method="post" action="{{ route('admin_add_post_p') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="form-group">
	    <label for="name">Заголовок</label>
	    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Заголовок">
	  </div>
	  <div class="form-group">
	    <label for="img">Изображение</label>
	    <input type="text" class="form-control" id="img" value="{{ old('img') }}" name="img" placeholder="img">
	  </div>
	  <div class="form-group">
	    <label for="text">Text</label>
	    <textarea class="form-control" id="text" name="text" rows="3">{{ old('text') }}</textarea>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>	
@endsection