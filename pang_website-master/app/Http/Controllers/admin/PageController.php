<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use DateTime;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title'        => 'required|string|max:50',
            // 'url'          => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'url'          => 'required|url',
            'ranking'      => 'required|integer',
            // 'parent_id'    => 'nullable|integer',
            'description'  =>'required'
        ]);
    }

    public function index() {
        $pages = Page::orderBy('created_at', 'DESC')->simplePaginate(10);
        return view('admin.page.index', compact('pages'));
    }

    public function create() {
        $pages = Page::orderBy('created_at', 'DESC')->get();
        return view('admin.page.create', compact('pages'));
    }

    public function store(Request $request) {
        $this->validator($request->all())->validate();

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $page = new Page;
        $page->title = $request['title'];
        $page->url = $request['url'];
        $page->ranking = $request['ranking'];
        $page->description = $request['description'];
        $page->created_at = now();
        $page->updated_at = now();

        $page->save();

        return redirect()->route('admin.page.index')->with('success', '页面创建成功!');
    }

    public function show($id) {
        $page = Page::find($id);
        return view('admin.page.show', compact('page'));
    }

    public function edit($id) {
        $page = Page::find($id);
        $pages = Page::orderBy('id', 'ASC')->get()->except($page->id);;
        return view('admin.page.edit', compact('page', 'pages'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'title'        => 'string|max:50|required',
            'url'          => 'string|url|required',
            'ranking'      => 'integer|required',
            // 'parent_id'    => 'integer|nullable',
            'description'  => 'required'
        ]);

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $page = Page::find($id);
        $page->title = $request['title'];
        $page->url = $request['url'];
        $page->ranking = $request['ranking'];
        // $page->parent_id = $request->parent_id;
        $page->description = $request['description'];
        // $page->created_at = now();
        $page->updated_at = now();

        $page->save();

        return redirect()->route('admin.page.index')->with('success', "$page->title 页面更改成功!");

    }

    public function destroy($id) {
        $page = Page::find($id);
        $page->delete();

        return redirect()->route('admin.page.index')->with('success', "$page->title 页面删除成功!");
    }
}
