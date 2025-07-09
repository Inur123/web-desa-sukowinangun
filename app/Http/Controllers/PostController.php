<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
 public function index()
{
    $totalBerita = Post::count();

    $bulanIni = Post::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    $activePosts = Post::where('status', 'active')->count();

    // Tambahkan total views
    $totalViews = Post::sum('views');

    $posts = Post::with('tags')->latest()->paginate(10);

    return view('admin.posts.index', compact('posts', 'totalBerita', 'bulanIni', 'activePosts', 'totalViews'));
}


    public function create()
    {
        $categories = [
            'Pembangunan',
            'Budaya',
            'Ekonomi',
            'Kesehatan',
            'Lingkungan',
            'Pendidikan',
            'Pertanian'
        ];
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title'         => 'required|string|max:255',
        'content'       => 'nullable|string',

        // Validasi summary max 100 huruf (tanpa spasi/simbol)
        'summary'       => ['nullable', 'string', function ($attribute, $value, $fail) {
            $letterCount = strlen(preg_replace('/[^a-zA-Z]/u', '', $value));
            if ($letterCount > 100) {
                $fail('Ringkasan maksimal 100 huruf (tidak termasuk spasi dan simbol).');
            }
        }],

        'status'        => 'required|in:active,nonactive',
        'category'      => 'required|in:Pembangunan,Budaya,Ekonomi,Kesehatan,Lingkungan,Pendidikan,Pertanian',
        'published_at'  => 'nullable|date',
        'image'         => 'nullable|image|max:2048',
        'tags'          => 'nullable|string',
        'additional_images.*' => 'nullable|image|max:2048', // validasi gambar tambahan
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    $post = Post::create([
        'title'         => $request->title,
        'content'       => $request->content,
        'summary'       => $request->summary,
        'status'        => $request->status,
        'category'      => $request->category,
        'published_at'  => $request->published_at,
        'image'         => $imagePath,
    ]);

    // Simpan gambar tambahan (jika ada)
    if ($request->hasFile('additional_images')) {
        foreach ($request->file('additional_images') as $image) {
            $path = $image->store('post-images', 'public');
            $post->additionalImages()->create(['image' => $path]);
        }
    }

    $this->syncTags($post, $request->tags);

    return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan!');
}


    public function edit(Post $post)
    {
        $categories = [
            'Pembangunan',
            'Budaya',
            'Ekonomi',
            'Kesehatan',
            'Lingkungan',
            'Pendidikan',
            'Pertanian'
        ];

        // Ambil tag menjadi string terpisah koma
        $tagString = $post->tags->pluck('name')->implode(', ');

        return view('admin.posts.edit', compact('post', 'categories', 'tagString'));
    }

    public function update(Request $request, Post $post)
{
    $request->validate([
        'title'         => 'required|string|max:255',
        'content'       => 'nullable|string',
        'summary' => ['nullable', 'string', function ($attribute, $value, $fail) {
            $letterCount = strlen(preg_replace('/[^a-zA-Z]/u', '', $value));
            if ($letterCount > 100) {
                $fail('Ringkasan maksimal 100 huruf (tidak termasuk spasi dan simbol).');
            }
        }],
        'status'        => 'required|in:active,nonactive',
        'category'      => 'required|in:Pembangunan,Budaya,Ekonomi,Kesehatan,Lingkungan,Pendidikan,Pertanian',
        'published_at'  => 'nullable|date',
        'image'         => 'nullable|image|max:2048',
        'tags'          => 'nullable|string',
        'additional_images.*' => 'nullable|image|max:2048', // validasi gambar tambahan
    ]);

    // Ganti gambar utama jika diupload baru
    if ($request->hasFile('image')) {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->image = $request->file('image')->store('posts', 'public');
    }

    // Update data utama
    $post->update([
        'title'         => $request->title,
        'content'       => $request->content,
        'summary'       => $request->summary,
        'status'        => $request->status,
        'category'      => $request->category,
        'published_at'  => $request->published_at,
        'image'         => $post->image, // pastikan gambar utama tidak hilang saat update
    ]);

    // Simpan gambar tambahan (jika ada)
    if ($request->hasFile('additional_images')) {
        foreach ($request->file('additional_images') as $image) {
            $path = $image->store('post-images', 'public');
            $post->additionalImages()->create(['image' => $path]);
        }
    }

    $this->syncTags($post, $request->tags);

    return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui!');
}

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }


    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus!');
    }

    /**
     * Helper untuk sinkronisasi tag
     */
    private function syncTags(Post $post, $tags)
    {
        if (!$tags) {
            $post->tags()->detach();
            return;
        }

        $tagNames = array_map('trim', explode(',', $tags));
        $tagIds = [];

        foreach ($tagNames as $name) {
            $tag = Tag::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);
    }
}
