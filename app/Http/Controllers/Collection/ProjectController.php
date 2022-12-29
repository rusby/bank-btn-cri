<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Collection\DeveloperProject as DevProject;;
use DB;

class ProjectController extends Controller
{
    public function index()
    {
        return view('pages.collection.project.index');
    }

    public function create()
    {
        return view('pages.collection.project.create');
    }

    public function store(Request $request)
    {
        $project = new DevProject();
        return $project->storeDevProject($request);
    }

    public function show($id)
    {
        $project = DevProject::findOrFail($id);
        return view('pages.collection.project.show', compact('project'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }
    
    public function destroy($id)
    {
        //
    }

    public function getDatatble(Request $request){
        if ($request->ajax()) {
            $data = DevProject::latest()->get();
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('collection.project.show', $row->id).'" class="edit btn btn-info btn-sm">Detail</a>';
                return $actionBtn;
            })
            ->addColumn('files', function ($data) {
                $f = '<ul>';
                foreach ($data->files as $value) {
                    $f .= '<li><img src= '.\Helper::showImage($value->path, $value->name) .' style="width: 130px;margin-bottom: 5px;border-radius:5px;" class="zoom"></li>';
                }
                return $f;
            })
            ->rawColumns(['action', 'files'])
            ->make(true);
        }
    }
}
