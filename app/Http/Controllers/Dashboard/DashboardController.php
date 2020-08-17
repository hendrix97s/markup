<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    private $request;

    public function __construct(Request $request)
    {
            $this->request = $request;
    }

    public function index(){
        return view('dashboard.index');
    }
}
