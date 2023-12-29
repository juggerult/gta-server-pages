<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends BaseController
{

    public function getNewsData(){
        $data = News::orderBy('created_at', 'desc')->get();

        return response()->json(NewsResource::collection($data));
    }

}
