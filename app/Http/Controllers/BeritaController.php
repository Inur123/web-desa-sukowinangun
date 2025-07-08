<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar semua berita.
     */
 public function index()
{
    $mostViewedPost = Post::where('status', 'active')
                          ->orderByDesc('views')
                          ->first();

    $posts = Post::where('status', 'active')
                 ->orderByDesc('published_at')
                 ->get();

    return view('berita', compact('mostViewedPost', 'posts'));
}

    /**
     * Menampilkan detail berita berdasarkan slug.
     */
public function show($slug)
{
    $post = Post::with('tags')
                ->where('slug', $slug)
                ->where('status', 'active')
                ->firstOrFail();

    $post->increment('views');

    return view('berita-show', compact('post'));
}

}
