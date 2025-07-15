<?php



namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\View; // Misalnya ada tabel view_berita
use Carbon\Carbon;

class DashboardController extends Controller
{
   public function index()
{
    $totalPosts = Post::count();
    $postsThisMonth = Post::whereMonth('created_at', now()->month)->count();
    $visitorGrowth = '+12% minggu ini';
    $latestPosts = Post::orderBy('views', 'desc')->take(4)->get();
    $totalViews = DB::table('posts')->sum('views');
    $viewGrowth = '+8% hari ini';

    $totalSku = Sku::count();

    // Ambil data pengajuan SKU untuk 7 hari terakhir
    $skuPerHari = Sku::select(DB::raw('DATE(created_at) as tanggal'), DB::raw('COUNT(*) as total'))
        ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->tanggal => $item->total];
        });

    // Buat label hari dan isi data 0 jika tidak ada
    $labels = collect();
    $data = collect();
    for ($i = 6; $i >= 0; $i--) {
        $tanggal = Carbon::now()->subDays($i);
        $labels->push($tanggal->translatedFormat('l')); // Senin, Selasa, dst
        $data->push($skuPerHari[$tanggal->toDateString()] ?? 0);
    }

    return view('admin.dashboard', [
        'totalPosts' => $totalPosts,
        'postsThisMonth' => $postsThisMonth,
        'visitorGrowth' => $visitorGrowth,
        'totalViews' => $totalViews,
        'viewGrowth' => $viewGrowth,
        'latestPosts' => $latestPosts,
        'totalSku' => $totalSku,
        'skuLabels' => $labels,
        'skuData' => $data,
    ]);
}
}
