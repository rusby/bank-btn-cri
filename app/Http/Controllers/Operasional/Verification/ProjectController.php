<?php

namespace App\Http\Controllers\Operasional\Verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Collection\DeveloperProject;

class ProjectController extends Controller
{
    public function index()
    {
        return view('pages.operasional.verification.project.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $data['data'] = User::findOrFail($id);
        return view('pages.operasional.verification.project.show')->with($data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            if (isset($request->project_verif)) {
                DeveloperProject::whereNotIn('id', $request->project_verif)
                                ->where([
                                    ['is_approved', 1],
                                    ['developer_id', $id]
                                ])
                                ->update(['is_approved' => 0]);
            }else{
                DeveloperProject::where([
                                    ['is_approved', 1],
                                    ['developer_id', $id]
                                ])
                                ->update(['is_approved' => 0]);
            }
            if (isset($request->project_notverif)) {
                DeveloperProject::whereIn('id', $request->project_notverif)->update(['is_approved' => 1]);    
            }
            return redirect()->route('operasional.verification.project.index')->with('alert-success', 'Berhasil memverifikasi project !');
        } catch (Exception $e) {
            return redirect()->route('operasional.verification.project.index')->with('alert-error', 'Ada kesalahan, silakan coba lagi !');
        }
    }
    
    public function destroy($id)
    {
        //
    }

    public function getDatatble(Request $request){
        if ($request->ajax()) {
            $data = User::latest()
                        ->role('collection')
                        ->with('devProjectVerif', function($q1){
                            $q1->take(4);
                        })
                        ->with('devProjectNotVerif', function($q1){
                            $q1->take(4);
                        })
                        ->where('is_approved', true)
                        ->get();

            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('badges_status', function($row){
                $actionStatus = '<span class="badge badge-primary">Approved</span>';
                return $actionStatus;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('operasional.verification.project.show', $row->id).'" class="edit btn btn-success btn-sm">Detail</a>';
                return $actionBtn;
            })
            ->addColumn('project_verif', function($row){
                if (!$row->devProjectVerif()->exists()) {
                    return '-';
                }
                $projV = '<ul>';
                foreach ($row->devProjectVerif as $val) {
                    $projV .= "<li>{$val->project_name}</li>";   
                }                
                $projV .= '</ul>';
                return $projV;
            })
            ->addColumn('project_notverif', function($row){
                if (!$row->devProjectNotVerif()->exists()) {
                    return '-';
                }
                $projNV = '<ul>';
                foreach ($row->devProjectNotVerif as $val) {
                    $projNV .= "<li>{$val->project_name}</li>";   
                }                
                $projNV .= '</ul>';
                return $projNV;
            })
            ->rawColumns(['action', 'badges_status', 'project_verif', 'project_notverif'])
            ->make(true);
        }
    }
}
