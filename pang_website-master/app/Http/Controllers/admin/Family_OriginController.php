<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Family_Origin;
use App\Services\ImageManager;
use App\Services\MediaManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\FamilyOriginRequest;
use App\Constant\ConstantModule;

class Family_OriginController extends Controller
{
    public $mediaService;
    private $ImgMng;

    public function __construct(MediaManager $medObj, ImageManager $imgObj)
    {
        $this->middleware('auth');
        $this->mediaService = $medObj;
        $this->ImgMng = $imgObj;
    }

    public function index()
    {
        $family_origin_list = Family_Origin::orderBy('created_at', 'ASC')->get();
        return view('admin.family_origin.index', compact('family_origin_list'));
    }

    public function show($id)
    {
        $family_origin = Family_Origin::find($id);
        $imageArr = $this->ImgMng->getMultipleImage($family_origin->image_path, ConstantModule::Family_Origin);
        $videoArr = $this->mediaService->getMultipleVideo($family_origin->media_path, ConstantModule::Family_Origin);
        return view('admin.family_origin.show', compact('family_origin','imageArr','videoArr'));
    }

    public function create()
    {
        return view('admin.family_origin.create');
    }

    public function store(FamilyOriginRequest $request)
    {
        try {
            $family_origin = new Family_Origin;
            // $family_origin->image_path = $this->ImgMng->insertImage($request, 'image_path', 'family_origin');
            // $family_origin->media_path = $this->mediaService->insertVideo($request, 'family_origin');
            $family_origin->image_path = $this->ImgMng->insertMultipleImage($request, 'image_path',  ConstantModule::Family_Origin);
            $family_origin->media_path = $this->mediaService->insertMultipleVideo($request, 'media_path', ConstantModule::Family_Origin);
            $family_origin->family_origin_content = $request->family_origin_content;
            $family_origin->particular_year = $request->particular_year;
            $family_origin->created_at = now();
            $family_origin->updated_at = now();
            $family_origin->save();
            return redirect()->route('admin.family_origin.index')->with('success', '彭氏渊源资料创建成功!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.family_origin.index')->with('error', "创建失败,未知错误" . $ex);
        }
    }

    public function edit($id)
    {
        $family_origin = Family_Origin::find($id);
        $imageArr = $this->ImgMng->getMultipleImage($family_origin->image_path, ConstantModule::Family_Origin);
        $videoArr = $this->mediaService->getMultipleVideo($family_origin->media_path, ConstantModule::Family_Origin);
        return view('admin.family_origin.edit', compact('family_origin','imageArr','videoArr'));
    }

    public function update(FamilyOriginRequest $request, $id)
    {
        // if ($request->isDeletePreviousVideo && $request->isDeletePreviousVideo == 'true') {
        //     $media_path = null;
        // } else {
        //     $media_path = $this->mediaService->updateMultipleVideo($request, $id, 'media_path', ConstantModule::Family_Origin, ConstantModule::Family_Origin);
        // }
        // $currentRecord = Family_Origin::find($id);

        $numRowAffected = Family_Origin::where('id', $id)->update([
            'family_origin_content' => $request->family_origin_content,
            'updated_at' => now(),
            'media_path'    => $this->mediaService->updateMultipleVideo($request, $id, 'media_path', ConstantModule::Family_Origin, ConstantModule::Family_Origin),
            'particular_year' => $request->particular_year,
            'image_path' => $this->ImgMng->updateMultipleImage($request, $id, 'image_path', ConstantModule::Family_Origin, ConstantModule::Family_Origin)
        ]);

        if ($numRowAffected > 0) {
            return redirect()->route('admin.family_origin.index')->with('success', '彭氏渊源资料修改成功!');
        } else {
            return redirect()->route('admin.family_origin.index')->with('error', "创建失败,未知错误");
        }
    }

    public function destroy($id)
    {
        $currentRecord = Family_Origin::find($id);
        if ($currentRecord->delete()) {
            return redirect()->route('admin.family_origin.index')->with('success', '彭氏渊源删除成功!');
        } else {
            return redirect()->route('admin.family_origin.index')->with('error', "删除失败,未知错误");
        }
    }
}
