<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Constant\ConstantModule;
use Illuminate\Support\Facades\Storage;

class PeopleHistory extends Model
{
  use HasFactory;

  protected $table = 'people_history';
  protected $fillable = [
    'history_name',
    'description',
    'media_path',
    'incident_date',
    'people_id',
    'onlyIncidentYear',
    'image_path',
  ];

  public function people()
  {
    return $this->belongsTo(People::class);
  }

  //CRUD section
  public function create_update($request, $id, $imgService, $mediaService)
  {
    date_default_timezone_set("Asia/Kuala_Lumpur");
    if ($id) { // Update
      $people_history = $this->find($id);
      $people_history->updated_at = now();
      $people_history->image_path = $imgService->updateMultipleImage($request, $id, 'image_path', ConstantModule::PeopleHistory, ConstantModule::PeopleHistory);

      // if ($request->isDeletePreviousVideo && $request->isDeletePreviousVideo == 'true') {
      //   $people_history->media_path = null;
      // } else {
      //   $people_history->media_path = $mediaService->updateMultipleVideo($request, $id, 'media_path', ConstantModule::PeopleHistory, ConstantModule::PeopleHistory);
      // }
      $people_history->media_path = $mediaService->updateMultipleVideo($request, $id, 'media_path', ConstantModule::PeopleHistory, ConstantModule::PeopleHistory);
      return $this->toDTO($people_history, $request)->save();
    }
    //Create
    $people_history = new PeopleHistory;
    $people_history->created_at = now();
    $people_history->updated_at = now();
    $people_history->image_path = $imgService->insertMultipleImage($request, 'image_path',  ConstantModule::PeopleHistory);
    $people_history->media_path = $mediaService->insertMultipleVideo($request,'media_path', ConstantModule::PeopleHistory);
    return $this->toDTO($people_history, $request)->save();
  }

  public function toDTO($currentRecord, $usrInput)
  {
    $currentRecord->history_name = $usrInput->history_name;
    $currentRecord->description = $usrInput->description;
    $currentRecord->incident_date = $usrInput->incident_date;
    $currentRecord->people_id = $usrInput->people_id;
    return $currentRecord;
  }

  public function deleteRecord($id)
  {
    $people_history = $this->find($id);
    $this->history_name = $people_history->history_name;
    return  $people_history->delete();
  }

  public function delete()
  {
      $imgArr = explode("|",$this->image_path);     
      $videoArr =  explode("|",$this->media_path);    
      foreach($imgArr as $imgFile){
          $path  = 'public/'.ConstantModule::PeopleHistory.'/images'.'/'.$imgFile; 
          if (Storage::exists($path)) {
              Storage::delete($path);
          }
      }
      foreach($videoArr as $videoFile){
        $path  = 'public/'.ConstantModule::PeopleHistory.'/videos'.'/'.$videoFile; 
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
      return parent::delete();
  }
}
