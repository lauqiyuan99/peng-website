<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Constant\ConstantModule;
use App\Services\ImageManager;

class JobDetailController extends Controller
{
    private $imgService;
    public function __construct(Job $jobObj, ImageManager $imgObj)
    {
        $this->model = $jobObj;
        $this->imgService = $imgObj;
    }

    public function show($id) {
        $jobDetail = Job::find($id);
        $jobDetail->category = $jobDetail->getFullCategoryName($jobDetail->category);
        $imageArr = $this->imgService->getMultipleImage($jobDetail->image_path, ConstantModule::Job);
        return view('user.jobDetail', compact('jobDetail', 'imageArr'));
    }
}
