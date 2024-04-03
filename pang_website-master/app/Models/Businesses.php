<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Constant\ConstantModule;
use Illuminate\Support\Facades\Storage;

class Businesses extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'note',
        'image_path',
        'category',
        'salary',
        'background',
        'address',
        'posted_on',
        'status'
    ];

    protected $businessCategoryList = array(
        'DEF' => '--商业--',
        'consumer' => '消费产品与服务',
        'industrial' => '工业产品与服务',
        'construction' => '建筑',
        'finance' => '金融服务',
        'technology' => '科技',
        'properties' => '产品',
        'plantation' => '种植',
        'healthcare' => '医疗保健',
        'transportation' => '交通与物流',
        'reits' => '产生投资信托',
        'telecommunications' => '电讯与媒体',
        'utilities' => '公用事业',
        'energy' => '能源',
        'OTH' => '其他'
        // 'AF' => '会计与金融',
        // 'HR' => '行政/人力资源',
        // 'SM' => '销售与市场营销',
        // 'AMC' => '艺术/媒体/通讯',
        // 'SER' => '服务',
        // 'HOR'=> '酒店/餐厅',
        // 'ET' => '教育/培训',
        // 'IT' => '计算机/信息技术',
        // 'ENGE' => '工程',
        // 'MANU' => '制造业',
        // 'BUL' => '建筑/施工',
        // 'SC' => '科学',
        // 'HC' => '卫生保健',
        // 'OTH' => '其他'
    );

    public function getCatList()
    {
        return $this->businessCategoryList;
    }

    public function getFullCategoryName($catCode)
    {
        return $this->businessCategoryList[$catCode];
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'business_id');
    }

    public function delete()
    {
        $imgArr = explode("|",$this->image_path);
        
        foreach($imgArr as $imgFile){
            $path  = 'public/'.ConstantModule::Businesses.'/images'.'/'.$imgFile; 
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
        parent::delete();
    }
}
