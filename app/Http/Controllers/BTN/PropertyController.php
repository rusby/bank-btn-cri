<?php

namespace App\Http\Controllers\BTN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Spatie\Crypto\Rsa\KeyPair;
use DataTables;

class PropertyController extends Controller
{
    function propertytab(){
        return view('pages.operasional.collection.properties.index');
    } 

    function retrievehousingtab(){
        return view('pages.operasional.collection.properties.retrievehouse');
    }

    function retrievehousetypetab(){
        return view('pages.operasional.collection.properties.retrievehouse-type');
    }

    function retrievehouselottab(){
        return view('pages.operasional.collection.properties.retrievehouse-lot');
    }

    function retrievehousenearbytab(){
        return view('pages.operasional.collection.properties.retrievehouse-nearby');
    }

    function searchdatapropertiestab(){
        return view('pages.operasional.collection.properties.search-data');
    }

}
