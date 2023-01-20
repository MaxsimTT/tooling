<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Classes\DownloadToolImages;
use App\Models\Image;
use App\Models\ImageLink;
use App\Models\Tool;
use Validator;

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

    public function downloadFile(Request $request, $tool_id = 0, $tool_type = 'tool') {

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

        $image = Image::create(['image_path' => $file['name']]);

        $image = Image::where('image_id', $image->id)->first();
        $image_link = $image->image_link()->create(['object_type' => $tool_type, 'object_id' => $tool_id]);

        if (!$image_link->id) {
            return 'Ошибка записи ссылки на изображение в БД';
        }

        return true;
    }

    public function createDirUploadImg($path_dir) {
        if (!is_dir($path_dir)) {
            if (!mkdir($path_dir, 0777, true)) {
                return 'Не удалось создать директории...';
            }
        }
        return true;
    }

    public function deleteImage($image_id) {

        $image_id = $image_id;
        if (empty($image_id)) {
            return redirect()->route('homePage');
        }

        $image = Image::where('image_id', $image_id)->first();
        $tool_id = $image->image_link->object_id;
        $tool = Tool::find($tool_id)->delete();
        $image->image_link()->delete();
        $image->where('image_id', $image_id)->delete();

        return redirect()->route('homePage');
    }

    public function setTool(Request $request) {

        if ($request->isMethod('post')) {

            // $rules = [
            //     'tool_code'   => 'required|max:10',
            //     'tool_type'   => 'required|max:10',
            //     'tool_amount' => 'required|max:10',
            //     'photo'       => 'required',
            // ];

            // $this->validate($request, $rules/*, $messages*/);

            $messages = [];

            $validator = Validator::make($request->all(), [
                        'tool_code'   => 'required|max:6',
                        'tool_type'   => 'required|max:6',
                        'tool_amount' => 'required|max:6',
                        'photo'       => 'required',
                    ], $messages);

            if ($validator->fails()) {
                return redirect()->route('homePage')->withErrors($validator)->withInput();
            }

            $tool_data = $request->input();

            $tool = Tool::create([
                'tool_code' => $tool_data['tool_code'],
                'tool_type' => $tool_data['tool_type'],
                'amount'    => $tool_data['tool_amount'],
            ]);

            if (!empty($_FILES['photo']['tmp_name'])) {
              $this->downloadFile($request, $tool->id, $tool->tool_type);
            }

            return redirect()->route('homePage');
            
        }
    }
}
