<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DateTime;
use App\Models\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ThemeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $themes = Variable::get();
        return view('admin.theme.index', compact('themes'));
    }

    public function show($id) {
        $themes = Variable::find($id);
        return view('admin.theme.show', compact('themes'));
    }

    public function edit($id) {
        $themes = Variable::find($id);
        return view('admin.theme.edit', compact('themes'));
    }

    public function update(Request $request, $id) {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        if(($id >= 1 && $id <= 3) || ($id >= 6 && $id <= 11)) {
            $this->validate($request, [
                'value' => 'string|nullable',
            ]);

            $theme = Variable::find($id);
            // $theme->key = $request['key'];
            $theme->value = $request['value'] ?? '';
            $theme->updated_at = now();
            $theme->save();

            return redirect()->route('admin.theme.index')->with('success', "$theme->key 主题更改成功!");
        }
        elseif($id == 4 || $id == 5) {
            if($request->hasFile('value')) {
                $fileNameUploaded = $request->file('value')->getClientOriginalName();
                $fileName = pathinfo($fileNameUploaded, PATHINFO_FILENAME);
                $extension = $request->file('value')->getClientOriginalExtension();
                $image = $fileName.'_'.time().'.'.$extension;
                $value = $request->file('value')->move('image', $image);
            }
            else {
                $value = DB::table('variables')
                    ->where('id', $id)
                    ->pluck('value')
                    ->toArray();

                $value = implode("",$value);
            }
            $theme = Variable::find($id);
            $theme->value = $value;
            $theme->updated_at = now();
            $theme->save();

            return redirect()->route('admin.theme.index')->with('success', "$theme->key 主题更改成功!");
        }
    }
}
