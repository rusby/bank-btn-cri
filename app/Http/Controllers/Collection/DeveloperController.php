<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Collection\Developer;
use DB;

class DeveloperController extends Controller
{
    public function index()
    {
        return view('pages.collection.developer.index');
    }

    public function create()
    {
        return view('pages.collection.developer.create');
    }

    public function store(Request $request)
    {
        $developer = new Developer();
        return $developer->storeDeveloper($request);
    }

    public function show($id)
    {
        $developer = Developer::findOrFail($id);
        return view('pages.collection.developer.show', compact('developer'));
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
            $data = Developer::latest()->get();
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('collection.developer.show', $row->id).'" class="edit btn btn-info btn-sm">Detail</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
