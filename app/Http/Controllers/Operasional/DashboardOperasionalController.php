<?php

namespace App\Http\Controllers\Operasional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection\{
	CollectionFile,
	CollStatusHistory
};

class DashboardOperasionalController extends Controller
{
    public function index(){
    	$data = CollectionFile::all();
    	$notif = CollStatusHistory::latest()->limit(10)->get();
        return view('pages.operasional.dashboard', compact('data', 'notif'));
    }
}
