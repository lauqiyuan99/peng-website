<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\People;

class SearchController extends Controller
{
    protected $appends = ['name'];

    public function index(Request $request) {
        $search_persons = People::orderBy('created_at', 'DESC')->get();

        // $search_people = People::selectRaw("people.*")
        //     ->where(function($query) use ($request) {
        //         if (($keyword = $request->get('search_text'))) {
        //             $query->where('people.name', 'like', "%$keyword%");
        //         }
        //     });
        // $search_person = $search_people->get();
        
        $keyword = $request->get('search_text');
        $search_persons = People::query()
        ->where('name', 'LIKE', "%{$keyword}%")
        ->get();


        return view('user.search', compact('search_persons'));
    }
    

    public function create() {

    }

    public function store() {

    }

    public function show($id) {
        $chart_persons = People::find($id);

        return view('user.chart', compact('chart_persons'));
    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }//

}
