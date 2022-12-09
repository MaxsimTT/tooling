<?php

namespace App\Classes;

use App\Classes\DFileHelper;

class DownloadToolImages
{
	public function validate($file) {
		$img_type = $file['type'];
		$img_size = $file['size'];

		if (strstr($img_type, '/', true) != 'image') {
			return $img_type;
		}

		if ($img_size > 10485760) {
			return $img_size;
		}

		return true;
	}

	public function prepareImg($file, $path) {

		$extension = strtolower(substr(strrchr($file['name'], '.'), 1));
		$filename = DFileHelper::getRandomFileName($path, $extension);

		if (empty($filename)) {
			return;
		}

		$file['name'] = $filename . '.' . $extension;

		return $file;
	}

	public function uploadFile($file, $path) {
		$target = $path . '\\' . $file['name'];
		return move_uploaded_file($file['tmp_name'], $target);
	}

	public function convertToWebp($file, $path, $path_to) {
		$img_full_name = $path . '\\' . $file['name'];
		$webp_full_name = $path_to . '\\' . $file['name'] . '.webp';

		if (!is_file($img_full_name)) {
			return 'Изображение не найдено!';
		}

		$img_data = getimagesize($img_full_name);
		$img = imagecreatefromjpeg($img_full_name);

		$res_converter_webp = imagejpeg($img, $webp_full_name, 50);

		return $res_converter_webp;
	}
}
