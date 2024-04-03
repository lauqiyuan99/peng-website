<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DateTime;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Services\ImageManager;

class PersonController extends Controller
{
    private $ImgMng;
    private $model;

    public function __construct(ImageManager $imgObj, People $peopleObj)
    {
        $this->middleware('auth');
        $this->ImgMng = $imgObj;
        $this->model = $peopleObj;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'              => 'required|string|max:50',
            'avatar'            => 'image|mimes:jpeg,png,jpg',
            'spouse_name'       => 'max:50|nullable',
            'spouse_avatar.*'   => 'image|mimes:jpeg,png,jpg',
            'gender'            => 'required|string',
            'state'             => 'string|required',
            'nationality'       => 'string|required',
            'dob_date'          => 'date_format:"Y-m-d"|required',
            'dead_date'         => 'date|nullable',
            'parent_id'         => 'string|nullable',
            'era'               => 'string|required',
            'seniority'         => 'string|required',
            'family'            => 'string|nullable'
        ]);
    }

    public function index()
    {
        $persons = People::orderBy('created_at', 'DESC')->get();
        $negeriList = $this->model->getNegeriList();
        return view('admin.person.index', compact('persons', 'negeriList'));
    }

    public function create()
    {
        $persons = People::orderBy('created_at', 'DESC')->get();
        $negeriList = $this->model->getNegeriList();
        return view('admin.person.create', compact('persons', 'negeriList'));
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $person = new People;
        // $request->request->add(['image_path' => $request->file('avatar')]);
        $person->avatar = $this->ImgMng->insertImage($request, 'avatar', 'avatar');
        $person->name = $request['name'];
        $person->gender = $request['gender'];
        $person->negeri = $request['negeri'];
        $person->state = $request['state'];
        $person->nationality = $request['nationality'];
        // $person->dob_date = DateTime::createFromFormat('d/m/Y', $request->get('dob_date'))->format('Y-m-d');
        $person->dob_date = $request->dob_date;
        $person->dead_date = $request->dead_date;
        $person->parent_id = $this->model->getParentIDByParentName($request->parent_id);
        $person->created_at = now();
        $person->updated_at = now();
        $person->era = $request['era'];
        $person->seniority = $request['seniority'];
        $person->address = $request['address'];
        // temporary solved relationship bug for edit page
        // $person->family = !is_null($request->parent_id) ? $person->getFamily($request->parent_id) : "F" . $request['name'];
        $person->family = !is_null($person->parent_id) ? $person->getFamily($person->parent_id) : "F" . $request['name'];
        $currentTime = time(); // ensure  time wont affect by code performance.

        //Spouse
        $person->spouse_name = implode('|', $request->get('spouse_name'));
        $spouseImgArr = explode(',', $request->storeSpouseImgSrc);
        foreach ($spouseImgArr as $value) {
            if ($value == 'noimage.jpg') {
                $imageNameArray[] = 'noimage.jpg';
            } else {
                $fileName = pathinfo($value, PATHINFO_FILENAME);  // Get File Name           
                $extension = pathinfo($value, PATHINFO_EXTENSION); // get Extension
                $filenameSaved = $fileName . '_' . $currentTime . '.' . $extension;
                $imageNameArray[] = $filenameSaved;
            }
        }
        $person->spouse_avatar = implode('|', $imageNameArray);

        if ($request->hasFile('spouse_avatar')) {
            foreach ($request->file('spouse_avatar') as $image) {
                $destinationPath = 'image/avatar';
                $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $filenameSaved = $fileName . '_' . $currentTime . '.' . $extension;
                $image->move($destinationPath, $filenameSaved);
            }
        }

        if ($person->save()) {
            return redirect()->route('admin.relationship.index')->with('success', '亲属关系创建成功!');
        }
        return redirect()->route('admin.job.index')->with('error', "Somethings went wrong");
    }

    public function show($id)
    {
        $person = People::find($id);
        $spouseNameArr = explode('|', $person->spouse_name);
        $spouseImgArr = explode('|', $person->spouse_avatar);
        $spouseAttrList = collect();
        for ($i = 0; $i < count($spouseNameArr); $i++) {
            $spouseAttrList->push(['index' => $i, 'spouse_name' => $spouseNameArr[$i], 'spouse_avatar' => $spouseImgArr[$i]]);
        }
        return view('admin.person.show', compact('person', 'spouseAttrList'));
    }

    public function edit($id)
    {
        $person = People::find($id);
        // $persons = People::orderBy('id', 'ASC')->get()->except($person->parent_id);
        $family = People::get()->pluck('family')->unique();
        $persons = People::orderBy('id', 'ASC')->get();
        $parent_name = $this->model->returnParentNameByParentID($person->parent_id);

        $spouseNameArr = explode('|', $person->spouse_name);
        $spouseImgArr = explode('|', $person->spouse_avatar);
        $spouseAttrList = collect();
        for ($i = 0; $i < count($spouseNameArr); $i++) {
            $spouseAttrList->push(['index' => $i, 'spouse_name' => $spouseNameArr[$i], 'spouse_avatar' => $spouseImgArr[$i]]);
        }
        $negeriList = $this->model->getNegeriList();

        return view('admin.person.edit', compact('person', 'persons', 'family', 'spouseAttrList', 'negeriList', 'parent_name'));
    }

    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $person = People::find($id);
        $previousFamily = $person->family;
        $person->name = $request['name'];
        $person->avatar = $this->ImgMng->updateImage($request, $id, 'avatar', 'avatar', 'people');
        $person->gender = $request['gender'];
        $person->negeri = $request['negeri'];
        $person->state = $request['state'];
        $person->nationality = $request['nationality'];
        $person->dob_date = $request->dob_date;
        $person->dead_date = $request->dead_date;
        $person->parent_id = $this->model->getParentIDByParentName($request->parent_id);
        $person->updated_at = now();
        $person->era = $request['era'];
        $person->seniority = $request['seniority'];
        $person->address = $request['address'];
        // temporary solved relationship bug for edit page
        // $person->family = !is_null($request->parent_id) ? $person->getFamily($request->parent_id) : "F" . $request['name'];
        $person->family = !is_null($person->parent_id) ? $person->getFamily($person->parent_id) : "F" . $request['name'];
        $currentPersonChildList = People::where('family', $previousFamily)->get();
        if ($currentPersonChildList) {
            foreach ($currentPersonChildList as $child) {
                if($child->parent_id){
                    $child->family = $person->family;
                    $child->save();
                } 
            }
        }
        $currentTime = time(); // ensure  time wont affect by code performance.
        // Check Spouse Array Empty or not
        if ($request->has('spouse_name') && $request->has('storeSpouseImgSrc')) {
            $person->spouse_name = implode('|', $request->get('spouse_name'));
            $spouseImgArr = explode(',', $request->storeSpouseImgSrc);
            //current record image
            $currentRecordImg = explode("|", $person->spouse_avatar);
            $i = 0;
            foreach ($spouseImgArr as $value) {
                if ($value == '' && $i < $request->numofSpouse) {
                    $imageNameArray[] = $currentRecordImg[$i];
                    $i++;
                } else {
                    if ($value != '') {
                        $fileName = pathinfo($value, PATHINFO_FILENAME);  // Get File Name           
                        $extension = pathinfo($value, PATHINFO_EXTENSION); // get Extension
                        $filenameSaved = $fileName . '_' . $currentTime . '.' . $extension;
                        $imageNameArray[] = $filenameSaved;
                    } else {
                        $imageNameArray[] = 'noimage.jpg';
                    }
                }
            }
            $person->spouse_avatar = implode('|', $imageNameArray);
        } else {
            $person->spouse_name = null;
            $person->spouse_avatar = null;
            $spouseImgArr = '';
        }

        if ($request->hasFile('spouse_avatar')) {
            foreach ($request->file('spouse_avatar') as $image) {
                $destinationPath = 'image/avatar';
                $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $filenameSaved = $fileName . '_' . $currentTime . '.' . $extension;
                $image->move($destinationPath, $filenameSaved);
            }
        }

        if ($person->save()) {
            return redirect()->route('admin.relationship.index')->with('success', '亲属关系创建成功!');
        }
        return redirect()->route('admin.job.index')->with('error', "Somethings went wrong");
    }

    public function destroy($id)
    {
        $person = People::find($id);
        if ($person->delete()) {
            return redirect()->route('admin.relationship.index')->with('success', "$person->name 资料删除成功");
        }
        return redirect()->route('admin.job.index')->with('error', "Somethings went wrong");
    }
}
