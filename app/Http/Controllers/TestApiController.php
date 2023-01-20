<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestApiController extends Controller
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

    public function show(Request $request)
    {
        $url = 'http://127.0.0.1:8000/api/tests';

        $opts = [
            'http' => [
                'method'=>"POST",
                'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n" . "Authorization: Bearer 38|vJJBlZEVbS5m5aOfNmWBggHSj8luthCdbRlJRMww"
            ],
        ];

        $context = stream_context_create($opts);

        $result = file_get_contents($url, false, $context);

        return $result;
    }
}
