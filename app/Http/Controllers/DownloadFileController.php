<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Classes\DownloadToolImages;
use App\Models\Image;
use App\Models\ImageLink;

class DownloadFileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function downloadFile(Request $request) {

        if (empty($request->input('upload'))) {
            return;
        }

        if (empty($_FILES['photo']['tmp_name'])) {
           return;
        }

        $file = $_FILES['photo'];

        if ($file['error'] != NULL) {
            return $file['error'];
        }

        $download_processor = new DownloadToolImages;

        if ($download_processor->validate($file) !== true) {
           return;
        }

        $img_upload_path = storage_path('app\public\img\tool');

        $this->createDirUploadImg($img_upload_path);

        $file = $download_processor->prepareImg($file, $img_upload_path);

        if (empty($file)) {
            return;
        }

        $res = $download_processor->uploadFile($file, $img_upload_path);

        if ($res == false) {
            return;
        }

        $img_to_webp_dir = storage_path('app\public\img\tool\webp');
        $this->createDirUploadImg($img_to_webp_dir);
        $download_processor->convertToWebp($file, $img_upload_path, $img_to_webp_dir, 50);

        $image = new Image;
        $image_link = new ImageLink;

        $image->image_path = $file['name'];
        $image->save();

        $image_link->detailed_id = $image->id;
        $image_link->object_type = 'tool';
        $image_link->save();

        if (!$image_link->id) {
            return 'Ошибка записи ссылки на изображение в БД';
        }

        return redirect()->route('homePage');
    }

    public function createDirUploadImg($path_dir) {
        if (!is_dir($path_dir)) {
            if (!mkdir($path_dir, 0777, true)) {
                return 'Не удалось создать директории...';
            }
        }
        return true;
    }
}
