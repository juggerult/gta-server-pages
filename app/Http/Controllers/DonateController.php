<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonateController extends BaseController
{

    public function donateForm(Request $request){
        $data = $request->input('data');

        $this->service->donateForm($data);
    }


}
