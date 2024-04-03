<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Constant\ConstantModule;
use Illuminate\Support\Facades\Storage;


class Family_Origin extends Model
{
    use HasFactory;

    protected $table = 'family_origin';

    protected $fillable = [
        'media_path',
        'family_origin_content',
        'particular_year',
        'image_path',
    ];

    public function delete()
    {
        $imgArr = explode("|",$this->image_path);     
        $videoArr =  explode("|",$this->media_path);    
        foreach($imgArr as $imgFile){
            $path  = 'public/'.ConstantModule::Family_Origin.'/images'.'/'.$imgFile; 
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
        foreach($videoArr as $videoFile){
          $path  = 'public/'.ConstantModule::Family_Origin.'/videos'.'/'.$videoFile; 
          if (Storage::exists($path)) {
              Storage::delete($path);
          }
      }
        return parent::delete();
    }
}
