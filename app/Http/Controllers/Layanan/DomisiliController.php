<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DomisiliController extends Controller
{

    public function index()
    {
        return view('admin.layanan.domisili.index');
    }
    public function create()
    {
        return view('user.layanan.domisili.create');
    }

     public function store(Request $request)
    {

    }
}
