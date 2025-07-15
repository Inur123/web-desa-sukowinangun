<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelahiranController extends Controller
{
      public function index()
    {
        return view('admin.layanan.kelahiran.index');
    }
    public function create()
    {
        return view('user.layanan.kelahiran.create');
    }

     public function store(Request $request)
    {

    }
}
