<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\DownloadToolImages;

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
        // dump($request->input());
        print_r($_FILES);
        $download_processor = new DownloadToolImages;
        // dump($download_processor->test($request));
        // return redirect()->route('/homePage');
    }
}
