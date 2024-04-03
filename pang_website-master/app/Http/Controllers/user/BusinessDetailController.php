<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Businesses;
use App\Constant\ConstantModule;
use App\Services\ImageManager;


class BusinessDetailController extends Controller
{
    private $imgService;
    public function __construct(Job $jobObj, ImageManager $imgObj)
    {
        $this->model = $jobObj;
        $this->imgService = $imgObj;
    }
    
    public function getBusinessDetail($id) {
        $businessDetail = Businesses::find($id);
        $businessDetail->category = $businessDetail->getFullCategoryName($businessDetail->category);
        $imageArr = $this->imgService->getMultipleImage($businessDetail->image_path, ConstantModule::Businesses);
        $jobList = $businessDetail->jobs->where('is_publish', 1);
        $jobCatList = [];
        foreach ($jobList as $job) {
            array_push($jobCatList, $this->model->getFullCategoryName($job->category)); // get only related record categories           
            $job->category = $job->getFullCategoryName($job->category);
            $job->image_path = $this->imgService->getMultipleImage($job->image_path, ConstantModule::Job)[0];// Get only First Image
        }
        $jobCatList = array_unique($jobCatList); // ensure unique categories
        return view('user.businessDetail', compact('businessDetail', 'imageArr', 'jobList', 'jobCatList'));
    }
}
