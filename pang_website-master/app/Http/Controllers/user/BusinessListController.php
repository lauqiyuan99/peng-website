<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Businesses;
use App\Services\ImageManager;
use App\Constant\ConstantModule;

class BusinessListController extends Controller
{
    private $model;

    public function __construct(Businesses $businessObj,ImageManager $imgObj)
    {
        $this->model = $businessObj;
        $this->imgService = $imgObj;
    }

    public function index()
    {
        $businessList = Businesses::orderBy('created_at', 'DESC')->where('is_publish', 1)->get();    
        foreach($businessList as $business){$business->category = $business->getFullCategoryName($business->category);}
        $business = new Businesses();
        $businessCatList = $this->model->getCatList();
        $selectedCode = "DEF";
        foreach($businessList as $business){
            $business->image_path = $this->imgService->getMultipleImage($business->image_path,ConstantModule::Businesses)[0];// Get only First Image
        }
        return view('user.business', compact('businessList', 'businessCatList', 'business'));  
    }

    public function show($id) {
        $Business = Businesses::find($id);
        $Business->category = $Business->getFullCategoryName($Business->category);
        $imgArr = $this->imgService->getMultipleImage($Business->image_path,ConstantModule::Businesses);        
        return view('user.business', compact('Business','imgArr'));
    }
}
