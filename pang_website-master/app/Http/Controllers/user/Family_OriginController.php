<?php

namespace App\Http\Controllers\User;

use Carbon\CarbonPeriod;
use App\Models\Family_Origin;
use App\Http\Controllers\Controller;
use App\Services\ImageManager;
use App\Constant\ConstantModule;
use App\Services\MediaManager;

class Family_OriginController extends Controller
{
    private $imgService;
    private $mediaService;

    public function __construct(ImageManager $imgObj, MediaManager $mediaObj)
    {
        $this->imgService = $imgObj;
        $this->mediaService = $mediaObj;
    }
    public function index()
    {
        $imageArr = [];
        $videoArr = [];
        $family_origin_list  = Family_Origin::orderBy('created_at', 'ASC')->simplePaginate(5);
        $min_particular_year = explode("-", Family_Origin::all('particular_year')->min('particular_year'));
        $max_particular_year = explode("-", Family_Origin::all('particular_year')->max('particular_year'));
        $year_list = $this->getAllYearBetweenRange($min_particular_year[0], $max_particular_year[0]);
        foreach ($family_origin_list as $family_origin) {
            //  $family_origin->media_path = $family_origin->media_path ? 'assets/videos/family_origin/' . $family_origin->media_path : '';
            $imageArr[] = $this->imgService->getMultipleImage($family_origin->image_path, ConstantModule::Family_Origin);
            $videoArr[] = $this->mediaService->getMultipleVideo($family_origin->media_path, ConstantModule::Family_Origin);
        }
        // dd($imageArr,$videoArr);
        return view('user.background', compact('family_origin_list', 'year_list','imageArr','videoArr'));
    }
    public function getAllYearBetweenRange($minDate, $maxDate)
    {
        $year_list = [];
        if ($maxDate == $minDate) {
            array_push($year_list, $maxDate);
            return $year_list;
        } else {
            $period = CarbonPeriod::create($minDate, $maxDate);

            foreach ($period as $date) {
                array_push($year_list, $date->format('Y'));
            }
            return array_unique($year_list);
        }
    }

    public function getList($year)
    {
        $family_origin_list = Family_Origin::whereYear('particular_year', $year)->simplePaginate(5);
        // $min_particular_year = $family_origin_list  ? explode("-", $family_origin_list->min('particular_year')) : now();
        $min_particular_year = $family_origin_list  ? explode("-", Family_Origin::all('particular_year')->min('particular_year')) : now();
        $max_particular_year = $family_origin_list ? explode("-", Family_Origin::all('particular_year')->max('particular_year')) : now();
        $year_list = $this->getAllYearBetweenRange($min_particular_year[0], $max_particular_year[0]);
        foreach ($family_origin_list as $family_origin) {
            $imageArr[] = $this->imgService->getMultipleImage($family_origin->image_path, ConstantModule::Family_Origin);
            $videoArr[] = $this->mediaService->getMultipleVideo($family_origin->media_path, ConstantModule::Family_Origin);
            // $family_origin->media_path = $family_origin->media_path ? 'assets/videos/family_origin/' . $family_origin->media_path : '';
        }
        return view('user.background', compact('family_origin_list', 'year_list','imageArr','videoArr'));
    }
}
