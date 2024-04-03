<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageManager;
use App\Services\MediaManager;
use App\Models\Notice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Constant\ConstantModule;

class NoticeController extends Controller
{
    private $ImgService;
    private $mediaService;
    private $model;

    public function __construct(ImageManager $imgObj, MediaManager $medObj, Notice $noticeObj)
    {
        $this->middleware('auth');
        $this->ImgService = $imgObj;
        $this->mediaService = $medObj;
        $this->model = $noticeObj;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'notice_name' => 'required',
            'notice_title_image_path.*' => 'mimes:jpeg,jpg,png,gif',
            'is_publish'=>'required|boolean',
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
        $notices = Notice::orderBy('created_at', 'DESC')->get();
        return view('admin.notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notice = new Notice();
        return view('admin.notice.create', compact('notice'));
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

        $notice = new Notice();
        $notice->notice_name = $request['notice_name'];
        // $notice->notice_title_image_path = $this->ImgService->insertImage($request, 'notice_title_image_path', 'notice');
        // $notice->media_path = $this->mediaService->insertVideo($request, 'notice');
        $notice->notice_title_image_path = $this->ImgService->insertMultipleImage($request, 'notice_title_image_path',  ConstantModule::Notice);
        $notice->media_path = $this->mediaService->insertMultipleVideo($request, 'media_path', ConstantModule::Notice);
        $notice->notice_content = $request['notice_content'];
        $notice->created_by = Auth::user()->username;
        $notice->updated_by = Auth::user()->username;
        $notice->created_at = now();
        $notice->updated_at = now();
        $isCreated = $notice->save();
        if (!$isCreated) {
            return redirect()->route('admin.notice.index')->with('error', "Somethings went wrong");
        }
        return redirect()->route('admin.notice.index')->with('success', '彭氏来源资料创建成功!');
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
        $imageArr = $this->ImgService->getMultipleImage($notice->notice_title_image_path, ConstantModule::Notice);
        $videoArr = $this->mediaService->getMultipleVideo($notice->media_path, ConstantModule::Notice);
        return view('admin.notice.show', compact('notice','imageArr','videoArr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice = Notice::find($id);
        $imageArr = $this->ImgService->getMultipleImage($notice->notice_title_image_path, ConstantModule::Notice);
        $videoArr = $this->mediaService->getMultipleVideo($notice->media_path, ConstantModule::Notice);
        return view('admin.notice.edit', compact('notice','imageArr','videoArr'));
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

        $notice = Notice::find($id);
        $notice->notice_name = $request['notice_name'];
        $notice->notice_title_image_path = $this->ImgService->updateMultipleImage($request, $id, 'notice_title_image_path', ConstantModule::Notice, ConstantModule::Notice);
        // if ($request->isDeletePreviousVideo && $request->isDeletePreviousVideo == 'true') {
        //     $notice->media_path = null;
        // } else {
        //     $notice->media_path = $this->mediaService->updateMultipleVideo($request, $id, 'media_path', ConstantModule::Notice, ConstantModule::Notice);
        // }
        $notice->media_path = $this->mediaService->updateMultipleVideo($request, $id, 'media_path', ConstantModule::Notice, ConstantModule::Notice);
        $notice->notice_content = $request['notice_content'];
        $notice->is_publish = $request['is_publish'];
        $notice->updated_by = Auth::user()->username;
        $notice->updated_at = now();
        $isUpdated = $notice->save();
        if (!$isUpdated) {
            return redirect()->route('admin.notice.index')->with('error', "Somethings went wrong");
        }
        return redirect()->route('admin.notice.index')->with('success', "$notice->notice_name 资料更改成功!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::find($id);
        if($notice->delete()){
            return redirect()->route('admin.notice.index')->with('success', "$notice->notice_name 活动删除成功!");
        }
        return redirect()->route('admin.notice.index')->with('error', "Somethings went wrong");
    }
}
