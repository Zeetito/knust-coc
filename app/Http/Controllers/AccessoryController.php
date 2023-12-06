<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{

    // Redirct when System offline is thrown
    public function system_offline(){

        if (Accessory::where('name','system_online')->first()->value == 0) {
            return view('components.control.system-offline');
        }else{
            return redirect(route('home'));
        }
    }


    
}
