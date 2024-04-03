<?php

namespace App\Services;

use App\Models\Job;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Constant\ConstantModule;
use App\Models\Businesses;
use App\Models\PeopleHistory;
use App\Models\Notice;
use App\Models\Event;
use App\Models\Family_Origin;


class ImageManager
{

    public function saveToFolder($request, $atrributes, $folder)
    {
        $fileName = pathinfo($request->file($atrributes)->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file($atrributes)->getClientOriginalExtension();
        $filenameSaved = $fileName . '_' . time() . '.' . $extension;
        $directory = 'image/' . $folder;
        $request->file($atrributes)->move($directory, $filenameSaved);
        return $filenameSaved;
    }


    public function updateImage($request, $id, $attributes, $folder, $table_name)
    {
        if (!is_int($id)) { //To Int If the Var is String
            $id = (int)$id;
        }
        if ($id && $request->hasFile($attributes)) {
            $filename = $this->saveToFolder($request, $attributes, $folder);
            return $filename;
        } else {
            $currentRecord = DB::table($table_name)->where('id', $id)->first();
            return $currentRecord->$attributes;
        }
    }

    public function insertImage($request, $attributes, $folder)
    {
        if ($request->hasFile($attributes)) {
            $filename = $this->saveToFolder($request, $attributes, $folder);
            return $filename;
        } else {
            return "noimage.jpg";
        }
    }

    public function insertMultipleImage($request, $attributes, $folder)
    {
        $rtnValue = '';
        $imageArr = [];
        if ($request->$attributes) {
            foreach ($request->file($attributes) as $imagefile) {
                $fileName = pathinfo($imagefile->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $imagefile->getClientOriginalExtension();
                $filenameSaved = $fileName . '_' . time() . '.' . $extension;
                Storage::putFileAs('public/' . $folder . '/images' . '/', $imagefile, $filenameSaved);
                $imageArr[] = $filenameSaved;
            }
        }
        $rtnValue = implode("|", $imageArr);
        return $rtnValue;
    }

    public function getMultipleImage($image_path, $folder_name)
    {
        if (!$image_path) {
            $contents[] = 'storage/noimage.jpg';
            return $contents;
        }
        $imgArr = explode("|", $image_path);
        $contents = [];
        foreach ($imgArr as $imgFile) {
            $contents[] = 'storage/' . $folder_name . '/images' . '/' . $imgFile;
        }
        return $contents;
    }

    public function updateMultipleImage($request, $id, $attributes, $folder, $table_name)
    {
        $rtnValue = '';
        $imageArr = [];
        if (!is_int($id)) { //To Int If the Var is String
            $id = (int)$id;
        }
        $currentRecord = DB::table($table_name)->where('id', $id)->first();
        if ($currentRecord->$attributes) {
            foreach (explode('|', $currentRecord->$attributes) as $image) {
                $imageArr[] = $image;
            }
        }
        if ($id && $request->$attributes) {
            // $this->deletePreviousImageFile($id,$attributes,$folder,$table_name);
            foreach ($request->file($attributes) as $imagefile) {
                $fileName = pathinfo($imagefile->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $imagefile->getClientOriginalExtension();
                $filenameSaved = $fileName . '_' . time() . '.' . $extension;
                Storage::putFileAs('public/' . $folder . '/images' . '/', $imagefile, $filenameSaved);
                $imageArr[] = $filenameSaved;
            }
        } else {
            return $currentRecord->$attributes;
        }
        $rtnValue = implode("|", $imageArr);
        return $rtnValue;
    }

    public function deletePreviousImageFile($id, $attributes, $folder, $table_name)
    {
        $currentRecord = DB::table($table_name)->where('id', $id)->first();
        $imgArr = explode("|", $currentRecord->$attributes);
        foreach ($imgArr as $imgFile) {
            $path  = 'public/' . $folder . '/images' . '/' . $imgFile;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }
    public function deleteImageFile(Request $request)
    {
        $path = str_replace('storage', 'public', $request->get('path'));
        $pathArr = explode('/', $path);
        if (Storage::exists($path)) {
            Storage::delete($path);
            $isSuccess = $this->updateRecord($pathArr[1], $request->get('id'), $pathArr);
            if ($isSuccess) {
                return response()->json('删除成功');
            } else {
                return response()->json('存储失败');
            }
        } else {
            return response()->json('照片不存在');
        }
    }
    public function updateRecord($table_name, $id, $pathArr)
    {
        switch ($table_name) {
            case (ConstantModule::Businesses):
                return $this->deleteExistingImagePath(Businesses::find($id), 'image_path', $pathArr);
                break;
            case (ConstantModule::PeopleHistory):
                return $this->deleteExistingImagePath(PeopleHistory::find($id), 'image_path', $pathArr);
                break;
            case (ConstantModule::Job):
                return $this->deleteExistingImagePath(Job::find($id), 'image_path', $pathArr);
                break;
            case (ConstantModule::Event):
                return $this->deleteExistingImagePath(Event::find($id), 'event_title_image_path', $pathArr);
                break;
            case (ConstantModule::Notice):
                return $this->deleteExistingImagePath(Notice::find($id), 'notice_title_image_path', $pathArr);
                break;
            case (ConstantModule::Family_Origin):
                return $this->deleteExistingImagePath(Family_Origin::find($id), 'image_path', $pathArr);
                break;
        }
    }

    public function deleteExistingImagePath($currentRecord, $attributes, $pathArr)
    {
        $imgArr = explode('|', $currentRecord->$attributes);
        foreach ($imgArr as $index => $img) {
            if ($img === $pathArr[3]) { // img name
                array_splice($imgArr, $index, 1);
            }
        }
        $currentRecord->$attributes = implode('|', $imgArr);
        return $currentRecord->save();
    }
}
