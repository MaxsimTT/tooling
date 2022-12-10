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

	public function convertToWebp(array $file, string $path, string $path_to, int $quality): string
	{
		$img_full_name = $path . '\\' . $file['name'];
		$webp_full_name = $path_to . '\\' . $file['name'] . '.webp';

		if (!is_file($img_full_name)) {
			return 'Изображение не найдено!';
		}

		$img_data = getimagesize($img_full_name);
		$is_alpha = false;

		if ($img_data['mime'] == 'image/png') {
			$is_alpha = true;
			$img = imagecreatefrompng($img_full_name);
		} elseif ($img_data['mime'] == 'image/jpeg') {
			$img = imagecreatefromjpeg($img_full_name);
		} else {
			return $img_full_name;
		}

		if ($is_alpha) {
			imagepalettetotruecolor($img);
			imagealphablending($img, true);
			imagesavealpha($img, true);
		}

		$res_converter_webp = imagewebp($img, $webp_full_name, $quality);

		return $res_converter_webp;
	}
}
