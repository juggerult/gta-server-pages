<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\Post\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

}
