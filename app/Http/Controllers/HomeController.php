<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PopupBanner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
      public function index()
    {
        // Ambil 6 berita terbaru yang status-nya 'active'

        $posts = Post::where('status', 'active')
                     ->orderBy('published_at', 'desc')
                     ->take(6)
                     ->get();
        $popupBanner = PopupBanner::where('is_active', true)->latest()->first();
        return view('home', compact('posts', 'popupBanner'));
    }
}
