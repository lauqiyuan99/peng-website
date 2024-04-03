<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Job;
use PDF;

class ChartController extends Controller
{

    private $model;


    public function __construct(People $pplObj)
    {
        $this->model = $pplObj;
    }

    public function fetchfamilylist($id)
    {
        return response()->json([
            'familiylist' => $this->getList($id)
        ]);
    }

    public function downloadPDF(Request $request)
    {
        $data = $request->chartData;
        $dompdf = PDF::loadView('user.pdf', compact('data'));
        $dompdf->setPaper('A4', 'landscape');
        //  $dompdf -> setWarnings(true);
        $dompdf->render();
        return $dompdf->download('族谱.pdf');
    }

    public function getList($id)
    {
        $list = [];
        $currentUserRecord = $this->model->where('id', $id)->first();
        $familylist = $this->model->where('family', $currentUserRecord->family)->get();
        // $child_list = $currentUserRecord->child;
        // $currentUserRecord->parent_id = $currentUserRecord->parent_id ? $this->model->returnParentNameByParentID($currentUserRecord->parent_id) : null;
        // $currentUserRecord->gender = "1" ? "男" : "女";
        // $spouse_avatar = explode('|', $currentUserRecord->spouse_avatar);
        // $currentUserRecord->spouse_avatar = $spouse_avatar[0]; // only get First wife avatar
        // $list[] = $currentUserRecord->toArray();
        if ($familylist) {
            foreach ($familylist as $item) {
                $item->parent_id = $item->parent_id ? $this->model->returnParentNameByParentID($item->parent_id) : null; // store all parent Name to parent ID filed
                $item->gender = "1" ? "男" : "女";
                $spouse_avatar = explode('|', $item->spouse_avatar);
                $item->spouse_avatar = $spouse_avatar[0]; // only get First wife avatar
                $list[] = $item;
            }
        }
        return $list;
    }

}
