<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page_Content;
use App\Models\Page;
use Illuminate\Http\Request;
use DateTime;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'media_type'    => 'required|string',
            'media_path'    => 'required|string',
            'description'   => 'string|max:5000|required',
            'is_publish'    => 'string|nullable',
            'year'          => 'required|integer|min:1900|max:'.date('Y'),
            'page_id'       => 'nullable|string'
        ]);
    }

    public function index() {
        $blogs = Page_Content::orderBy('created_at', 'DESC')->simplePaginate(10);

        return view('admin.blog.index', compact('blogs'));
    }

    public function create() {
        $blogs = Page::orderBy('created_at', 'DESC')->get();
        return view('admin.blog.create', compact('blogs'));
    }

    public function store(Request $request) {

        $this->validator($request->all())->validate();

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $blog = new Page_Content();
        $blog->media_type = $request['media_type'];
        $blog->media_path = $request['media_path'];
        $blog->description = $request['description'];
        $blog->is_publish = $request->get('is_publish');
        $blog->year = $request->get('year');
        $blog->page_id = $request->get('page_id');
        $blog->created_at = now();
        $blog->updated_at = now();

        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', '彭氏来源资料创建成功!');
    }

    public function show($id) {
        $blog = Page_Content::find($id);
        $blogs = DB::table('pages')->where('id', $blog->page_id)->get();
        return view('admin.blog.show', compact('blog', 'blogs'));
    }

    public function edit($id) {
        $blog = Page_Content::find($id);
        $blogs = DB::table('pages')->where('id', $blog->page_id)->get();

        $page_id = Page::orderBy('id', 'ASC')->get()->except($blog->page_id);

        return view('admin.blog.edit', compact('blog', 'blogs', 'page_id'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'media_type'    => 'string',
            'media_path'    => 'string',
            'description'   => 'string|max:5000',
            'is_publish'    => 'string',
            'year'          => 'integer|min:1900|max:'.date('Y'),
            'page_id'       => 'nullable|string'
        ]);

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $blog = Page_Content::find($id);
        $blog->media_type = $request['media_type'];
        $blog->media_path = $request['media_path'];
        $blog->description = $request['description'];
        $blog->is_publish = $request['is_publish'];
        $blog->year = $request->get('year');
        $blog->page_id = $request->get('page_id');
        // $blog->created_at = now();
        $blog->updated_at = now();

        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', "彭氏来源资料更改成功!");
    }

    public function destroy($id) {
        $blog = Page_Content::find($id);
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', "$blog->id 资料删除成功!");
    }
}
