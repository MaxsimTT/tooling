<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\ImageLink;

class HomePageController extends Controller
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

    public function getHomePage(Request $request)
    {

        $tools_img =
                Image::leftJoin('images_links', 'images.image_id', '=', 'images_links.detailed_id')
                ->select(
                    'images.image_id as id',
                    'images.image_path as img_name',
                    'images_links.object_id',
                    'images_links.object_type',
                    'images_links.type')
                ->orderByDesc('id')
                ->get();

        // dump(Image::where('image_id', 1)->first()->image_id);
        // $image_test = Image::where('image_id', 1)->first();
        // dump($image_test->image_id);
        // $image_test->image_id = 888;
        // dump($image_test->image_id);
        
        $img_get_path = '\storage\app\public\img\tool\\';
        $img_get_path_webp = '\storage\app\public\img\tool\webp\\';
        $images_path = [];

        if (!empty($tools_img)) {
            foreach ($tools_img as $key => $tool_img) {
                $images_path[$key] = [
                    'img_path' => $img_get_path . $tool_img->img_name,
                    'img_name' => $tool_img->img_name,
                    'img_id'   => $tool_img->id,
                ];
                if (is_file(storage_path('app\public\img\tool\webp\\' . $tool_img->img_name . '.webp'))) {
                    $images_path[$key]['img_path'] = $img_get_path_webp . $tool_img->img_name . '.webp';
                }
            }
        }
        // dump($images_path);
        return view('homepage', ['images' => $images_path]);
    }
}
