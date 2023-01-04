<?php

namespace App\Http\Controllers\BTN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Spatie\Crypto\Rsa\KeyPair;
use DataTables;

class SimulationController extends Controller
{
    function simulationtab(){
        return view('pages.operasional.collection.simulation.index');
    }  
    
    function HousingLoanConventionaltab(){
        return view('pages.operasional.collection.simulation.housingloan-conventional');
    } 
       
    function HousingLoanShariatab(){
        return view('pages.operasional.collection.simulation.housingloan-sharia');
    }    
}
