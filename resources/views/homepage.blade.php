<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>
	<form enctype="multipart/form-data" method="POST" action="download">
		@csrf
		<p>Загрузите ваши фотографии на сервер</p>
		<p><input type="file" name="photo" multiple accept="image/*,image/jpeg">
		<input type="submit" value="Отправить" name="upload"></p>
	</form>
	@if (!empty($images))
		@foreach ($images as $img)
			<div>
	    		<img style="max-width: 20%" src="{{ $img['img_path'] }}" alt="{{ $img['img_name'] }}">
	    		<a href="{{ url('/image_delete', ['image_id' => $img['img_id']]) }}">
					<button class="btn btn-default">Delete</button>
				</a>
	    	</div>
	    @endforeach
	@endif
</body>
</html>