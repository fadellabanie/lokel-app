<?php

use Carbon\Carbon;

use App\Models\City;
use App\Models\Country;
use App\Models\Experience;
use Illuminate\Support\Facades\Storage;

/**
 * Generate Code 
 */
if (!function_exists('generateRandomCode')) {
	function generateRandomCode($string)
	{
		return $string . '-' . substr(md5(microtime()), rand(0, 26), 5);
	}
}

if (!function_exists('uploadToPublic')) {
	function uploadToPublic($folder, $image)
	{
		return 'uploads/' . Storage::disk('public_new')->put($folder, $image);
	}
}

if (!function_exists('isActive')) {
	function isActive($type, $end_date = "")
	{
		if ($type == 1 || $end_date >= now()) {
			return '<div class="badge badge-light-success fw-bolder">' . __("Active") . '</div>';
		} else {
			return '<div class="badge badge-light-danger fw-bolder">' . __("Not Active") . '</div>';
		}
	}
}
if (!function_exists('calculateAge')) {
	function calculateAge($birthday)
	{
		$age =  date_diff(date_create($birthday), date_create(date("d-m-Y")));
		return $age->format("%y");
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

if (!function_exists('cities')) {
	function cities()
	{
		$cities = City::get();
		return $cities;
	}
}
if (!function_exists('countries')) {
	function countries()
	{
		$countries = Country::get();
		return $countries;
	}
}
if (!function_exists('getCountry')) {
	function getCountry($city_id)
	{
		$city = City::whereId($city_id)->select('country_id')->first();
		return $city->country_id;
	}
}


if (!function_exists('userSuspend')) {
	function userSuspend($type)
	{
		if ($type == true) {
			return '<a href="#"><div class="badge badge-light-success fw-bolder">' . __("Active") . '</div></a>';
		} elseif ($type == false) {
			return '<a href="#"><div class="badge badge-light-danger fw-bolder">' . __("Freeze") . '</div></a>';
		}
	}
}

if (!function_exists('userStatus')) {
	function userStatus($type)
	{
		if ($type == true) {
			return '<a href="#"><div class="badge badge-light-success fw-bolder">' . __("verify") . '</div></a>';
		} elseif ($type == false) {
			return '<a href="#"><div class="badge badge-light-danger fw-bolder">' . __("Un Verify") . '</div></a>';
		}
	}
}

if (!function_exists('status')) {
	function status($status)
	{
		if ($status == Experience::ACCEPT) {
			return __("ACCEPT");
		} elseif ($status == Experience::PENDING) {
			return __("PENDING");
		} elseif ($status == Experience::REJECT) {
			return __("REJECT");
		} elseif ($status == Experience::EXPIRED) {
			return __("EXPIRED");
		}
	}
}
