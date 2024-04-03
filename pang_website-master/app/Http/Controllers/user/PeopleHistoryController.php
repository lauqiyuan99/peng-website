<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Support\Carbon as DateCovertor;
use App\Services\ImageManager;
use App\Services\MediaManager;
use App\Constant\ConstantModule;

class PeopleHistoryController extends Controller
{
    public function __construct(ImageManager $imgObj, MediaManager $medObj)
    {
        $this->imgService = $imgObj;
        $this->mediaService = $medObj;
    }
    public function getPeople($id)
    {
        $imageArr = [];
        $videoArr = [];
        $currentPerson = People::find($id);
        $currentPersonHistory = $currentPerson->people_history;
        foreach ($currentPersonHistory as $cph) {
            $cph->onlyIncidentYear = DateCovertor::parse($cph->incident_date)->year;
            $cph->people_id = $currentPerson->name;
            $imageArr[] = $this->imgService->getMultipleImage($cph->image_path, ConstantModule::PeopleHistory);
            $videoArr[] = $this->mediaService->getMultipleVideo($cph->media_path, ConstantModule::PeopleHistory);
        }
        $currentPersonHistory =  $currentPersonHistory->sortByDesc('onlyIncidentYear');  // Sort Desc By Year
        $numOfHistory  = count($currentPersonHistory);
        return view('user.history', compact('currentPerson', 'currentPersonHistory', 'numOfHistory', 'imageArr', 'videoArr'));
    }
}
