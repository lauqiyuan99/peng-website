<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Constant\ConstantModule;
use Illuminate\Support\Facades\Storage;

class Notice extends Model
{
    use HasFactory;

    protected $table = 'notice';
    protected $fillable = [
        'notice_name',
        'notice_title_image_path',
        'media_path',
        'notice_content',
        'is_publish',
        'created_by',
        'updated_by'
    ];

    public function delete()
    {
        $imgArr = explode("|",$this->notice_title_image_path);     
        $videoArr =  explode("|",$this->media_path);    
        foreach($imgArr as $imgFile){
            $path  = 'public/'.ConstantModule::Notice.'/images'.'/'.$imgFile; 
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
        foreach($videoArr as $videoFile){
          $path  = 'public/'.ConstantModule::Notice.'/videos'.'/'.$videoFile; 
          if (Storage::exists($path)) {
              Storage::delete($path);
          }
      }
        return parent::delete();
    }
}
