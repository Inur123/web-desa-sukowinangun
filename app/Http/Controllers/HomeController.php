<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

        return view('home', compact('posts'));
    }
}
