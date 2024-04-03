<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\ImageManager;
use App\Constant\ConstantModule;
use App\Services\MediaManager;

class EventController extends Controller
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
        $eventList = Event::orderBy('created_at', 'DESC')->where('is_publish', true)->get();
        // foreach($eventList as $event){
        //     $event->event_title_image_path = $this->imgService->getMultipleImage($event->event_title_image_path,ConstantModule::Event)[0];// Get only First Image
        //     $event->media_path = $this->mediaService->getMultipleVideo($event->media_path,ConstantModule::Event)[0];// Get only First Video
        // }
        foreach($eventList as $event){
            $imageArr[] = $this->imgService->getMultipleImage($event->event_title_image_path, ConstantModule::Event);
            $videoArr[] = $this->mediaService->getMultipleVideo($event->media_path, ConstantModule::Event);
        }
        return view('user.event', compact('eventList','imageArr','videoArr')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $imageArr = $this->imgService->getMultipleImage($event->image_path,ConstantModule::Event);
        $videoArr = $this->mediaService->getMultipleVideo($event->media_path,ConstantModule::Event);
        return view('admin.event.show', compact('event','imageArr','videoArr'));
    }

}
