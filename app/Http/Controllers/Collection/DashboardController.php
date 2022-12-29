<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection\CollectionFile;

class DashboardController extends Controller
{
	public function index(){
		$data['data'] = CollectionFile::with('unitKerja')
		->where('createdBy', \Auth::user()->id)
        ->limit(10)
		->orderBy('updated_at', 'DESC')
		->get();
		$data['role'] = \Auth::user()->getRoleNames()->first();
		return view('dashboard')->with($data);
	}
}
