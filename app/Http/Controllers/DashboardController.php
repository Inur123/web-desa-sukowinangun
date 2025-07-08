<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\View; // Misalnya ada tabel view_berita
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $postsThisMonth = Post::whereMonth('created_at', now()->month)->count();
        $visitorGrowth = '+12% minggu ini'; // contoh statis
        $latestPosts = Post::orderBy('views', 'desc')->take(4)->get();
        $totalViews = DB::table('posts')->sum('views');
        $viewGrowth = '+8% hari ini'; // contoh statis

        return view('admin.dashboard', [
            'totalPosts' => $totalPosts,
            'postsThisMonth' => $postsThisMonth,
            'visitorGrowth' => $visitorGrowth,
            'totalViews' => $totalViews,
            'viewGrowth' => $viewGrowth,
            'latestPosts' => $latestPosts,
        ]);
    }
}
