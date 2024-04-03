<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Businesses;
use Illuminate\Http\Request;
use App\Services\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Constant\ConstantModule;
use App\Http\Requests\JobRequest;

class JobController extends Controller
{

    private $ImgMng;
    private $model;

    public function __construct(ImageManager $imgObj, Job $jobObj)
    {
        $this->middleware('auth');
        $this->ImgMng = $imgObj;
        $this->model = $jobObj;
    }

    public function index()
    {
        $jobs = Job::orderBy('created_at', 'DESC')->get();
        return view('admin.job.index', compact('jobs'));
    }

    public function create()
    {
        $job = new Job();
        $jobCatList = $this->model->getCatList();
        $business_list =Businesses::orderBy('id','ASC')->get();
        $selectedCode = "DEF";
        return view('admin.job.create', compact('jobCatList', 'selectedCode', 'business_list'));
    }

    public function store(JobRequest $request)
    {

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $job = new Job();
        $job->name = $request['name'];
        $job->description = $request['description'];
        $job->note = $request['note'];
        $job->image_path = $this->ImgMng->insertMultipleImage($request, 'image_path', ConstantModule::Job);
        $job->category = $request['category'];
        $job->salary = $request['salary'];
        $job->background = $request['background'];
        $job->address = $request['address'];
        $job->posted_on = $request['posted_on'];
        $job->status = $request['status'] == null ? false : $request['status'];
        $job->created_at = now();
        $job->updated_at = now();
        $job->business_id = Businesses::where('name', $request['business_list'])->value('id');
        $isCreated = $job->save();
        if ($isCreated) {
            return redirect()->route('admin.job.index')->with('success', '工作资料创建成功!');
        }
        return redirect()->route('admin.job.index')->with('error', "Somethings went wrong");
    }


    public function show($id)
    {
        $job = Job::find($id);
        $jobCatName = $this->model->getFullCategoryName($job->category);
        $currentBusiness  = $job->business;
        $imageArr = $this->ImgMng->getMultipleImage($job->image_path, ConstantModule::Job);
        return view('admin.job.show', compact('job', 'jobCatName','currentBusiness', 'imageArr'));
    }

    public function edit($id)
    {
        $job = Job::find($id);
        $jobCatList = $this->model->getCatList();
        $business_list = Businesses::all();
        $currentBusiness = $job->business;
        $imageArr = $this->ImgMng->getMultipleImage($job->image_path, ConstantModule::Job);
        return view('admin.job.edit', compact('job', 'jobCatList', 'business_list', 'currentBusiness', 'imageArr'));
    }

    public function update(JobRequest $request, $id)
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $job = Job::find($id);
        $job->name = $request['name'];
        $job->description = $request['description'];
        $job->note = $request['note'];
        $job->image_path = $this->ImgMng->updateMultipleImage($request, $id, 'image_path', ConstantModule::Job, ConstantModule::Job);
        $job->category = $request['category'];
        $job->salary = 'RM '.$request['salary'];
        $job->background = $request['background'];
        $job->address = $request['address'];
        $job->posted_on = $request['posted_on'];
        $job->status = $request['status'] == null ? false : $request['status'];
        $job->business_id = Businesses::where('name', $request['business_list'])->value('id');
        $job->updated_at = now();
        $isUpdated = $job->save();
        if ($isUpdated) {
            return redirect()->route('admin.job.index')->with('success', "$job->name 资料更改成功!");
        }
        return redirect()->route('admin.job.index')->with('error', "Somethings went wrong");
    }

    public function destroy($id)
    {
        $job = Job::find($id);
        if($job->delete()){
            return redirect()->route('admin.job.index')->with('success', "$job->name 资料删除成功!");
        }
        return redirect()->route('admin.job.index')->with('error', "Somethings went wrong");
        
 
    }
}