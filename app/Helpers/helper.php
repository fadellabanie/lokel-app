<?php

use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

/**
 * Generate Code 
 */
if (!function_exists('generateRandomCode')) {
	function generateRandomCode($string)
	{
		return $string .'-'. substr(md5(microtime()), rand(0, 26), 5);
	}
}

if (!function_exists('uploadToPublic')) {
	function uploadToPublic($folder, $image)
	{
		return 'uploads/' . Storage::disk('public_new')->put($folder, $image);
	}
}

if (!function_exists('isActive')) {
	function isActive($type,$end_date="")
	{

		if ($type == 1 || $end_date >= now()) {
			return '<div class="badge badge-light-success fw-bolder">' . __("Active") . '</div>';
		} else{
			return '<div class="badge badge-light-danger fw-bolder">' . __("Not Active") . '</div>';
		}
	}
}

/**
 * Upload
 */
if (!function_exists('upload')) {
	function upload($file, $path)
	{
		$baseDir = 'uploads/' . $path;

		$name = sha1(time() . $file->getClientOriginalName());
		$extension = $file->getClientOriginalExtension();
		$fileName = "{$name}.{$extension}";

		$file->move(public_path() . '/' . $baseDir, $fileName);

		return "{$baseDir}/{$fileName}";
	}
}
