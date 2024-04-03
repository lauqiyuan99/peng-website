<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Constant\ConstantModule;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';
    protected $fillable = [
        'event_name',
        'event_title_image_path',
        'media_path',
        'event_content',
        'is_publish',
        'created_by',
        'updated_by'
    ];

    public function delete()
    {
        $imgArr = explode("|",$this->event_title_image_path);     
        $videoArr =  explode("|",$this->media_path);    
        foreach($imgArr as $imgFile){
            $path  = 'public/'.ConstantModule::Event.'/images'.'/'.$imgFile; 
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
        foreach($videoArr as $videoFile){
          $path  = 'public/'.ConstantModule::Event.'/videos'.'/'.$videoFile; 
          if (Storage::exists($path)) {
              Storage::delete($path);
          }
      }
        return parent::delete();
    }

}
