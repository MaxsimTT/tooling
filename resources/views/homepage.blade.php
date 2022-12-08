<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>
	<div>
		<p>Method: {{ $method }}</p>
	</div>
	<form enctype="multipart/form-data" method="POST" action="download">
		@csrf
		<p>Загрузите ваши фотографии на сервер</p>
		<p><input type="file" name="photo" multiple accept="image/*,image/jpeg">
		<input type="submit" value="Отправить" name="upload"></p>
	</form>
</body>
</html>