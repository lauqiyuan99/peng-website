<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Constant\ConstantModule;
use App\Models\Businesses;
use App\Models\PeopleHistory;
use App\Models\Notice;
use App\Models\Event;
use App\Models\Family_Origin;
use App\Models\Job;

class MediaManager
{
    public function saveToFolder($request, $folder)
    {
        $fileName = pathinfo($request->file('media_path')->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file('media_path')->getClientOriginalExtension();
        $filenameSaved = $fileName . '_' . time() . '.' . $extension;
        $directory = 'assets/videos/' . $folder;
        $request->file('media_path')->move($directory, $filenameSaved);
        return $filenameSaved;
    }

    public function updateVideo($request, $id, $folder, $table_name)
    {
        if ($id && $request->hasFile('media_path')) {
            $filename = $this->saveToFolder($request, $folder);
            return $filename;
        } else {
            $currentRecord = DB::table($table_name)->where('id', $id)->first();
            return $currentRecord->media_path;
        }
    }

    public function insertVideo($request, $folder)
    {
        if ($request->hasFile('media_path')) {
            $filename = $this->saveToFolder($request, $folder);
            return $filename;
        }
    }

    public function insertMultipleVideo($request, $attributes, $folder)
    {
        $rtnValue = '';
        $videoArr = [];
        if ($request->$attributes) {
            foreach ($request->file($attributes) as $videofile) {
                $fileName = pathinfo($videofile->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $videofile->getClientOriginalExtension();
                $filenameSaved = $fileName . '_' . time() . '.' . $extension;
                Storage::putFileAs('public/' . $folder . '/videos' . '/', $videofile, $filenameSaved);
                $videoArr[] = $filenameSaved;
            }
        }
        $rtnValue = implode("|", $videoArr);
        return $rtnValue;
    }

    public function getMultipleVideo($video_path, $folder_name)
    {
        if (!$video_path) {
            $contents[] = 'noVideo';
            return $contents;
        }
        $imgArr = explode("|", $video_path);
        $contents = [];
        foreach ($imgArr as $imgFile) {
            $contents[] = 'storage/' . $folder_name . '/videos' . '/' . $imgFile;
        }
        return $contents;
    }

    public function updateMultipleVideo($request, $id, $attributes, $folder, $table_name)
    {
        $rtnValue = '';
        $videoArr = [];
        if (!is_int($id)) { //To Int If the Var is String
            $id = (int)$id;
        }

        $currentRecord = DB::table($table_name)->where('id', $id)->first();
        if ($currentRecord->$attributes) {
            foreach (explode('|', $currentRecord->$attributes) as $video) {
                $videoArr[] = $video;
            }
        }
        if ($id && $request->$attributes) {
            // $this->deletePreviousVideoFile($id,$attributes,$folder,$table_name);
            foreach (explode('|', $currentRecord->$attributes) as $vid) {
                $videoArr[] = $vid;
            }
            foreach ($request->file($attributes) as $videofile) {
                $fileName = pathinfo($videofile->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $videofile->getClientOriginalExtension();
                $filenameSaved = $fileName . '_' . time() . '.' . $extension;
                Storage::putFileAs('public/' . $folder . '/videos' . '/', $videofile, $filenameSaved);
                $videoArr[] = $filenameSaved;
            }
        } else {
            return $currentRecord->$attributes;
        }
        $rtnValue = implode("|", $videoArr);
        return $rtnValue;
    }

    public function deletePreviousVideoFile($id, $attributes, $folder, $table_name)
    {
        $currentRecord = DB::table($table_name)->where('id', $id)->first();
        $videoArr = explode("|", $currentRecord->$attributes);
        foreach ($videoArr as $videoFile) {
            $path  = 'public/' . $folder . '/videos' . '/' . $videoFile;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }

    public function deleteVideoFile(Request $request)
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
            return response()->json('视频不存在');
        }
    }
    public function updateRecord($table_name, $id, $pathArr)
    {
        switch ($table_name) {
            case (ConstantModule::Businesses):
                return $this->deleteExistingVideoPath(Businesses::find($id), 'media_path', $pathArr);
                break;
            case (ConstantModule::PeopleHistory):
                return $this->deleteExistingVideoPath(PeopleHistory::find($id), 'media_path', $pathArr);
                break;
            case (ConstantModule::Job):
                return $this->deleteExistingVideoPath(Job::find($id), 'media_path', $pathArr);
                break;
            case (ConstantModule::Event):
                return $this->deleteExistingVideoPath(Event::find($id), 'media_path', $pathArr);
                break;
            case (ConstantModule::Notice):
                return $this->deleteExistingVideoPath(Notice::find($id), 'media_path', $pathArr);
                break;
            case (ConstantModule::Family_Origin):
                return $this->deleteExistingVideoPath(Family_Origin::find($id), 'media_path', $pathArr);
                break;
        }
    }

    public function deleteExistingVideoPath($currentRecord, $attributes, $pathArr)
    {
        $vidArr = explode('|', $currentRecord->$attributes);
        foreach ($vidArr as $index => $vid) {
            if ($vid === $pathArr[3]) { // vid name
                array_splice($vidArr, $index, 1);
            }
        }
        $currentRecord->$attributes = implode('|', $vidArr);
        return $currentRecord->save();
    }
}
