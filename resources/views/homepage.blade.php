<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>
	<form enctype="multipart/form-data" method="POST" action="{{ route('downloadFile') }}">
		@csrf
		<p>Загрузите ваши фотографии на сервер</p>
		<div>
			<label for="tool_code">Номер остнастки:</label>
			<input type="text" name="tool_code" id="tool_code"><br>
			<label for="tool_type">Тип остнастки:</label>
			<input type="text" name="tool_type" id="tool_type"><br>
			<label for="tool_amount">Количество остнастки:</label>
			<input type="text" name="tool_amount" id="tool_amount"><br>
			<input type="file" name="photo" multiple accept="image/*,image/jpeg">
		</div>
		<div>
			<input type="submit" value="Отправить" name="upload">
		</div>
	</form>
	@if (!empty($images))
		@foreach ($images as $img)
			<div>
				<div>
					<p>Номер остнастки: {{ $img['tool_code'] }}</p>
					<p>Тип остнастки: {{ $img['tool_type'] }}</p>
					<p>Статус остнастки: {{ $img['status'] }}</p>
					<p>Количество остнастки: {{ $img['amount'] }}</p>
				</div>
	    		<img style="max-width: 20%" src="{{ $img['img_path'] }}" alt="{{ $img['img_name'] }}">
	    		<a href="{{ url('/image_delete', ['image_id' => $img['img_id']]) }}">
					<button class="btn btn-default">Delete</button>
				</a>
	    	</div>
	    @endforeach
	@endif
</body>
</html>