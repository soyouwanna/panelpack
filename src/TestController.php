<?php

namespace Decoweb\Panelpack;
use App\Http\Controllers\Controller;
// comment

class TestController extends Controller
{
    public function index()
    {
        return response('Oki',200);
    }
}
