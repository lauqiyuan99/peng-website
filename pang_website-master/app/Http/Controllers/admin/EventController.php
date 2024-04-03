<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageManager;
use App\Services\MediaManager;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Constant\ConstantModule;

class EventController extends Controller
{

    private $ImgMng;
    private $mediaService;
    private $model;

    public function __construct(ImageManager $imgObj, MediaManager $medObj, Event $eventObj)
    {
        $this->middleware('auth');
        $this->ImgMng = $imgObj;
        $this->mediaService = $medObj;
        $this->model = $eventObj;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'event_name' => 'required',
            'event_title_image_path.*' => 'mimes:jpeg,jpg,png,gif',
            'is_publish' => 'required|boolean',
            'media_path.*' => 'mimes:mp4,mov,ogg' // 50mb
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'DESC')->get();
        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event();
        return view('admin.event.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $event = new Event();
        $event->event_name = $request['event_name'];
        // $event->event_title_image_path = $this->ImgMng->insertImage($request, 'event_title_image_path', 'event');
        $event->event_title_image_path = $this->ImgMng->insertMultipleImage($request, 'event_title_image_path',  ConstantModule::Event);
        $event->media_path = $this->mediaService->insertMultipleVideo($request, 'media_path', ConstantModule::Event);
        $event->event_content = $request['event_content'];
        $event->created_by = Auth::user()->username;
        $event->updated_by = Auth::user()->username;
        $event->created_at = now();
        $event->updated_at = now();
        $isCreated = $event->save();
        if (!$isCreated) {
            return redirect()->route('admin.event.index')->with('error', "Somethings went wrong");
        }
        return redirect()->route('admin.event.index')->with('success', '彭氏来源资料创建成功!');
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
        $imageArr = $this->ImgMng->getMultipleImage($event->event_title_image_path, ConstantModule::Event);
        $videoArr = $this->mediaService->getMultipleVideo($event->media_path, ConstantModule::Event);
        return view('admin.event.show', compact('event', 'imageArr', 'videoArr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $imageArr = $this->ImgMng->getMultipleImage($event->event_title_image_path, ConstantModule::Event);
        $videoArr = $this->mediaService->getMultipleVideo($event->media_path, ConstantModule::Event);
        return view('admin.event.edit', compact('event', 'imageArr', 'videoArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $event = Event::find($id);
        $event->event_name = $request['event_name'];
        $event->event_title_image_path = $this->ImgMng->updateMultipleImage($request, $id, 'event_title_image_path', ConstantModule::Event, ConstantModule::Event);
        // if ($request->isDeletePreviousVideo && $request->isDeletePreviousVideo == 'true') {
        //     $event->media_path = null;
        // } else {
        //     $event->media_path = $this->mediaService->updateMultipleVideo($request, $id, 'media_path', ConstantModule::Event, ConstantModule::Event);
        // }
        $event->media_path = $this->mediaService->updateMultipleVideo($request, $id, 'media_path', ConstantModule::Event, ConstantModule::Event);
        $event->event_content = $request['event_content'];
        $event->is_publish = $request['is_publish'];
        $event->updated_by = Auth::user()->username;
        $event->updated_at = now();
        $isUpdated = $event->save();
        if (!$isUpdated) {
            return redirect()->route('admin.event.index')->with('error', "Somethings went wrong");
        }
        return redirect()->route('admin.event.index')->with('success', "$event->event_name 资料更改成功!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if ($event->delete()) {
            return redirect()->route('admin.event.index')->with('success', "$event->event_name 活动删除成功!");
        }
        return redirect()->route('admin.event.index')->with('error', "Somethings went wrong");
    }
}
