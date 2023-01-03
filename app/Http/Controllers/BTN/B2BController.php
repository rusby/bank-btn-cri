<?php

namespace App\Http\Controllers\BTN;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Spatie\Crypto\Rsa\KeyPair;
use DataTables;


class B2BController extends Controller
{
    function b2btab(){
        return view('pages.operasional.collection.b2b.index');
    }

    function financetypetab(){
        return view('pages.operasional.collection.b2b.finace-type');
    }

    function loantypetab(){
        return view('pages.operasional.collection.b2b.loan-type');
    }

    function employmenttypetab(){
        return view('pages.operasional.collection.b2b.employment-type');
    }

    function searchdatatab(){
        return view('pages.operasional.collection.b2b.search-data');
    }

    function housingloanapplicationtab(){
        return view('pages.operasional.collection.b2b.housingloan-application');
    }

    function smeloantypeapplicationtab(){
        return view('pages.operasional.collection.b2b.smeloantype-application');
    }
}
