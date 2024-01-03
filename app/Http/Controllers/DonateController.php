<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonateController extends BaseController
{

    public function donateForm(Request $request){
        $data = $request->input('data');

        $this->service->donateForm($data);
    }
}
