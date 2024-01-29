<?php

//use App\Models\Url;
namespace App\Http\Controllers;
use Illuminate\Routing\Middleware\ThrottleRequests;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function __construct()
    {
        $this->middleware(ThrottleRequests::class.':3,1')->only('create');
    }

    public function create()
    {
        // Your route logic here
    }

}
