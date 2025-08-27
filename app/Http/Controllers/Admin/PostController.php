<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\AITraining;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
            'image'         => 'nullable|image|max:10240',
            'tags'          => 'nullable|string',
            'additional_images.*' => 'nullable|image|max:10240', // validasi gambar tambahan
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
            'image'         => 'nullable|image|max:10240',
            'tags'          => 'nullable|string',
            'additional_images.*' => 'nullable|image|max:10240',
        ]);

        // Update main image if uploaded
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('posts', 'public');
        }

        // Handle image deletions and updates in a transaction
        DB::transaction(function () use ($request, $post) {
            // Process deleted images
            if ($request->has('deleted_additional_images')) {
                foreach ($request->deleted_additional_images as $imageId) {
                    $image = $post->additionalImages()->find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete($image->image);
                        $image->delete();
                    }
                }
            }

            // Process remaining existing images
            $remainingIds = $request->existing_additional_images ?? [];
            $post->additionalImages()
                ->whereNotIn('id', $remainingIds)
                ->each(function ($image) {
                    Storage::disk('public')->delete($image->image);
                    $image->delete();
                });

            // Add new images
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    $path = $image->store('post-images', 'public');
                    $post->additionalImages()->create(['image' => $path]);
                }
            }
        });

        // Update main post data
        $post->update([
            'title'         => $request->title,
            'content'       => $request->content,
            'summary'       => $request->summary,
            'status'        => $request->status,
            'category'      => $request->category,
            'published_at'  => $request->published_at,
        ]);

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
  public function generateContent(Request $request)
{
    $request->validate([
        'prompt' => 'required|string',
    ]);

    $apiKey = env('GEMINI_API_KEY');
    $tanggal = now()->translatedFormat('j F Y');
    $namaLurah = "Agus Dwi Aryanto";
    $namaKelurahan = "Sukowinangun";
    $alamatKelurahan = "Kelurahan $namaKelurahan, Kecamatan Magetan, Kabupaten Magetan, Jawa Timur";

    $instruction = <<<EOT
    Anda adalah penulis berita resmi Kelurahan Sukowinangun. Tulis artikel berita formal berdasarkan informasi yang diberikan dengan ketentuan:

    1. FORMAT PENULISAN:
    - Judul berita (1 baris)
    - 1 baris kosong
    - Paragraf pembuka (mengandung 5W+1H)
    - 1 baris kosong
    - Paragraf isi (uraian lengkap kegiatan/konten)
    - 1 baris kosong
    - Paragraf penutup (kesimpulan/harapan)
    - 1 baris kosong
    - Tagar (diawali #)

    2. KETENTUM KHUSUS:
    - Gunakan bahasa Indonesia formal dan profesional
    - Selalu sebut alamat lengkap: $alamatKelurahan
    - Cantumkan nama Lurah: $namaLurah
    - Tanggal kegiatan: $tanggal
    - Tidak perlu tanda bintang (**) atau format markdown
    - Fokus pada informasi faktual dan positif

    3. CONTOH STRUKTUR:
    [Judul Berita]

    [Pembuka] Kelurahan Sukowinangun menggelar...[jelaskan kegiatan secara ringkas].

    [Isi] Kegiatan dimulai dengan...[uraian lengkap]. Menurut $namaLurah...[kutipan/reaksi]. Peserta kegiatan...[deskripsi partisipasi].

    [Penutup] Dengan terselenggaranya acara ini...[harapan/kesimpulan].

    EOT;

    $finalPrompt = $instruction . "\n\nBuat berita tentang: " . $request->prompt;

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'X-goog-api-key' => $apiKey,
    ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent', [
        'contents' => [
            [
                'parts' => [
                    ['text' => $finalPrompt]
                ]
            ]
        ],
        'generationConfig' => [
            'temperature' => 0.7,
            'topP' => 0.9,
            'topK' => 40,
            'maxOutputTokens' => 2048,
            'stopSequences' => []
        ],
        'safetySettings' => [
            [
                'category' => 'HARM_CATEGORY_HARASSMENT',
                'threshold' => 'BLOCK_ONLY_HIGH'
            ],
            [
                'category' => 'HARM_CATEGORY_HATE_SPEECH',
                'threshold' => 'BLOCK_ONLY_HIGH'
            ]
        ]
    ]);

    if ($response->successful()) {
        $data = $response->json();
        $output = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

        // Post-processing to ensure format consistency
        $output = str_replace(['**', '*', '• '], '', $output);
        $output = preg_replace('/\n{3,}/', "\n\n", $output);

        return response()->json([
            'output' => trim($output),
            'source' => null,
        ]);
    } else {
        $errorDetails = $response->json();
        return response()->json([
            'output' => null,
            'source' => null,
            'error' => $errorDetails ?? 'Gagal menghubungi API Gemini'
        ], 500);
    }
}
}
