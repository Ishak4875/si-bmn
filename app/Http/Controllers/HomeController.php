<?php

namespace App\Http\Controllers;

use App\Models\OutputModel;
use App\Models\PaketModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $PaketModel;
    private $OutputModel;
    public function __construct()
    {
        $this->PaketModel = new PaketModel();
        $this->OutputModel = new OutputModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('v_dashboard');
    }
}
