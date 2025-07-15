<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelahiranController extends Controller
{
    public function create()
    {
        return view('user.layanan.kelahiran.create');
    }
}
