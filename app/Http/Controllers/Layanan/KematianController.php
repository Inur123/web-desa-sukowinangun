<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KematianController extends Controller
{
    public function create()
    {
        return view('user.layanan.kematian.create');
    }

     public function store(Request $request)
    {

    }
}
