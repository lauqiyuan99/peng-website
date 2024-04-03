<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Services\ImageManager;
use App\Constant\ConstantModule;
use App\Services\MediaManager;

class NoticeController extends Controller
{

    private $imgService;
    private $mediaService;

    public function __construct(ImageManager $imgObj, MediaManager $mediaObj)
    {
        $this->imgService = $imgObj;
        $this->mediaService = $mediaObj;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imageArr = [];
        $videoArr = [];        
        $noticeList = Notice::orderBy('created_at', 'DESC')->where('is_publish', true)->get();
        foreach ($noticeList as $notice) {
            $imageArr[] = $this->imgService->getMultipleImage($notice->notice_title_image_path, ConstantModule::Notice);
            $videoArr[] = $this->mediaService->getMultipleVideo($notice->media_path, ConstantModule::Notice);
        }
        return view('user.notice', compact('noticeList','imageArr','videoArr')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice = Notice::find($id);
        $imageArr = $this->imgService->getMultipleImage($notice->notice_title_image_path, ConstantModule::Notice);
        $videoArr = $this->mediaService->getMultipleVideo($notice->media_path, ConstantModule::Notice);
        return view('admin.notice.show', compact('notice', 'imageArr', 'videoArr'));
    }
}
