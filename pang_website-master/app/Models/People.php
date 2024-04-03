<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
        'spouse_name',
        'spouse_avatar',
        'gender',
        'state',
        'nationality',
        'dob_date',
        'parent_id',
        'era',
        'family',
    ];

    protected $negeriList = array(
        'DEF'=>'--未选择--',
        'johor' => '柔佛',
        'kedah' => '吉打',
        'kelatan' => '吉兰丹',
        'malacca' => '马六甲',
        'negeri sembilan' => '森美兰',
        'pahang' => '彭亨',
        'penang' => '槟城',
        'perak' => '霹雳',
        'perlis' => '玻璃市',
        'selangor' => '雪兰莪',
        'terengganu' => '登嘉楼',
        'sabah' => '沙巴',
        'sarawak' => '砂拉越',
        'OTH' => '其他'
    );
    
    public function getNegeriList(){
        return $this->negeriList;
    }

    public function getFullNegeriName($negeriCode){
        return $this->negeriList[$negeriCode];
    }

    public function child()
    {
        return $this->hasMany('App\Models\People', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\People', 'parent_id');
    }

    public function returnParentNameByParentID($parentID)
    {
        return $this->where('id', $parentID)->value('name');
    }

    public function people_history()
    {
        return $this->hasMany('App\Models\PeopleHistory');
    }


    // function to convert arrays to string
    public function convertArraysToString($array, $separator)
    {
        $array = array_column($array, 'spouse_name'); // Covert to Normal Array
        $str = implode($separator, $array);
        return $str;
    }

    public function getParent($parent_id)
    {
        return $this->where('id', $parent_id)->first();
    }

    public function getChild($id)
    {
        return $this->where('parent_id', $id)->get();
    }

    public function getFamily($parentId)
    {
        return $this->where('id', $parentId)->value('family');
    }

    public function getParentIDByParentName($parentName)
    {
        return $this->where('name', $parentName)->value('id');
    }
}