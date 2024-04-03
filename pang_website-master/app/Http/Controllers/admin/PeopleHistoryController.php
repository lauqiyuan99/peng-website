<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\People;
use App\Models\PeopleHistory;
use App\Services\ImageManager;
use App\Services\MediaManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Constant\ConstantModule;
use App\Http\Requests\PeopleHistoryRequest;

class PeopleHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $model;
    public $imgService;
    public $mediaService;

    public function __construct(PeopleHistory $obj, ImageManager $imgObj, MediaManager $medObj)
    {
        $this->middleware('auth');
        $this->model = $obj;
        $this->imgService = $imgObj;
        $this->mediaService = $medObj;
    }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'history_name' => 'required',
    //         'image_path.*' => 'mimes:jpeg,jpg,png,gif',
    //         'incident_date' => 'required',
    //         'incident_person' => 'required',
    //         'media_path.*' => 'mimes:mp4,mov,ogg'// 50mb
    //     ]);
    // }
    public function index()
    {
        $people_history = $this->model::orderBy('created_at', 'DESC')->get();
        foreach ($people_history as $ppl) {
            $currentPerson = People::find($ppl->people_id);
            $ppl->people_id = $currentPerson && $currentPerson->name ? $currentPerson->name : '无事件人物';
        }
        return view('admin.people_history.index', compact('people_history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pplNameArr = People::select('name', 'id')->get();
        $selectedPerson = null;
        return view('admin.people_history.create', compact('pplNameArr', 'selectedPerson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleHistoryRequest $request)
    {
        // $this->validator($request->all())->validate();
        $request->people_id = People::where('name', $request->incident_person)->value('id');
        $isCreated = $this->model->create_update($request, null, $this->imgService, $this->mediaService);
        if ($isCreated) {
            return redirect()->route('admin.people_history.index')->with('success', '事迹创建成功!');
        }
        return redirect()->route('admin.people_history.index')->with('error', "Somethings went wrong");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $people_history = PeopleHistory::find($id);
        $currentParentInfo = People::select('name', 'id')->where('id', '=', $people_history->people_id)->first();
        $imageArr = $this->imgService->getMultipleImage($people_history->image_path,ConstantModule::PeopleHistory);
        $videoArr = $this->mediaService->getMultipleVideo($people_history->media_path,ConstantModule::PeopleHistory);
        return view('admin.people_history.show', compact('people_history', 'currentParentInfo','imageArr','videoArr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $people_history = PeopleHistory::find($id);
        $pplNameArr = People::select('name', 'id')->get();
        $imageArr = $this->imgService->getMultipleImage($people_history->image_path,ConstantModule::PeopleHistory);
        $videoArr = $this->mediaService->getMultipleVideo($people_history->media_path,ConstantModule::PeopleHistory);
        foreach ($pplNameArr as $ppl) {
            if ($ppl->id == $people_history->people_id) {
                $incident_person_name = $ppl->name;
            }
        }
        return view('admin.people_history.edit', compact('people_history', 'pplNameArr', 'incident_person_name','imageArr','videoArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeopleHistoryRequest $request, $id)
    {

        // $this->validator($request->all())->validate();
        $request->people_id = People::where('name', $request->incident_person)->value('id');
        $isUpdated = $this->model->create_update($request, $id, $this->imgService, $this->mediaService);
        if ($isUpdated) {
            return redirect()->route('admin.people_history.index')->with('success', '事迹更改成功!');
        }
        return redirect()->route('admin.people_history.index')->with('error', "Somethings went wrong");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentRecord = PeopleHistory::find($id);
        $isDeleted = $currentRecord->delete();
        if ($isDeleted) {
            return redirect()->route('admin.people_history.index')->with('success', "$currentRecord->history_name 资料删除成功!");
        }
        return redirect()->route('admin.people_history.index')->with('error', "Somethings went wrong");
    }
}
