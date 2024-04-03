<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Businesses;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Constant\ConstantModule;
use App\Services\ImageManager;

class JobListController extends Controller
{

    private $imgService;

    public function __construct(Job $jobObj, ImageManager $imgObj)
    {
        $this->model = $jobObj;
        $this->imgService = $imgObj;
    }

    public function index()
    {
        $jobList = Job::orderBy('created_at', 'DESC')->where('is_publish', 1)->get();
        foreach($jobList as $job){$job->category = $job->getFullCategoryName($job->category);}
        $job = new Job();
        $jobCatList = $this->model->getCatList();
        foreach ($jobList as $job) {
            $job->image_path = $this->imgService->getMultipleImage($job->image_path, ConstantModule::Job)[0]; // Get only First Image
        }
        return view('user.job', compact('jobList', 'jobCatList', 'job'));
    }

    public function show($id) {
        $jobList = Businesses::find($id)->jobs->where('is_publish', 1);
        $jobCatList = [];
        foreach ($jobList as $job) {
            array_push($jobCatList, $this->model->getFullCategoryName($job->category)); // get only related record categories           
            $job->category = $job->getFullCategoryName($job->category);
            $job->image_path = $this->imgService->getMultipleImage($job->image_path, ConstantModule::Job)[0];// Get only First Image
        }
        $jobCatList = array_unique($jobCatList); // ensure unique categories
        return view('user.job', compact('jobList', 'jobCatList'));

        // $jobList = Job::orderBy('created_at', 'DESC')->where('is_publish', 1)->where('business_id', $id)->get();
        // foreach($jobList as $job){$job->category = $job->getFullCategoryName($job->category);}
        // $job = Job::find($id);
        // $job->category = $job->getFullCategoryName($job->category);
        // $jobCatList = $this->model->getCatList();
        // return view('user.job', compact('jobList', 'jobCatList', 'job'));  
    
    }
}
