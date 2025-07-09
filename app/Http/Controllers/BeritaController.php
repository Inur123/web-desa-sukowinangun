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
 $breakingNews = Post::latest()->take(3)->get();
    $posts = Post::where('status', 'active')
                 ->orderByDesc('published_at')
                 ->get();

    return view('user.berita.index', compact('mostViewedPost', 'posts', 'breakingNews'));
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

    return view('user.berita.show', compact('post'));
}

}
