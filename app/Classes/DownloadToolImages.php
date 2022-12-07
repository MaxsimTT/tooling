<?php

namespace App\Classes;

use Illuminate\Http\Request;

class DownloadToolImages
{
	public function test(Request $request) {
		return $request->input();
	}
}
