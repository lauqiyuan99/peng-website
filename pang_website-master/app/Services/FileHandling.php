<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileHandling
{

    public function insertMultipleFile($files, $folder_name)
    {
        $arr = [];
        if (!$files) {
            return;
        }
        foreach ($files as $file) {
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameSaved = $fileName . '_' . time() . '.' . $extension;
            $to_folder = $extension == 'mp4' ? 'videos' : 'images';
            Storage::putFileAs('public/' . $folder_name . '/' . $to_folder . '/', $file, $filenameSaved);
            $arr[] = $filenameSaved;
        }
        return implode("|", $arr);
    }

    public function getMultipleFile($file_path, $folder_name, $isVideo = false)
    {
        $contents = [];
        if (!$file_path) {
            return $contents;
        }
        $file_path_arr = explode("|", $file_path);
        $to_folder = $isVideo ? 'videos' : 'images';
        foreach ($file_path_arr as $file_path) {
            $contents[] = 'storage/' . $folder_name . '/'.$to_folder . '/' . $file_path;
        }
        return $contents;
    }

    public function deleteExistingFile($file_name, $folder_name, $isVideo = false)
    {
        $to_folder = $isVideo ? 'videos' : 'images';
        $path  = 'public/' . $folder_name . '/' .$to_folder. '/' . $file_name;
        if (Storage::exists($path)) {
            Storage::delete($path);
        }   
    }
}
