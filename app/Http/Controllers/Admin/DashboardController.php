<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Sku;
use App\Models\Post;
use App\Models\Sktm;
use App\Models\Lainnya;
use App\Models\Domisili;
use App\Models\Kematian;
use App\Models\Kelahiran;
use App\Models\HargaTanah;
use App\Models\Kehilangan;
use App\Models\Penghasilan;
use App\Models\BelumMenikah;
use App\Models\PengantarSkck;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index(Request $request)
    {
        $period = $request->input('period', 'today'); // Default to today

        $totalPosts = Post::count();
        $postsThisMonth = Post::whereMonth('created_at', now()->month)->count();
        $visitorGrowth = '+12% minggu ini';
        $latestPosts = Post::orderBy('views', 'desc')->take(4)->get();
        $totalViews = DB::table('posts')->sum('views');
        $viewGrowth = '+8% hari ini';

        // Get counts for all services
        $totalSku = Sku::count();
        $totalBelumMenikah = BelumMenikah::count();
        $totalDomisili = Domisili::count();
        $totalHargaTanah = HargaTanah::count();
        $totalKehilangan = Kehilangan::count();
        $totalKelahiran = Kelahiran::count();
        $totalPengantarSkck = PengantarSkck::count();
        $totalSktm = Sktm::count();
        $totalKematian = Kematian::count();
        $totalLainnya = Lainnya::count();
        $totalPenghasilan = Penghasilan::count();


        // Get data for selected period
       $services = [
    'SKU' => Sku::class,
    'Belum Menikah' => BelumMenikah::class,
    'Domisili' => Domisili::class,
    'Harga Tanah' => HargaTanah::class,
    'Kehilangan' => Kehilangan::class,
    'Kelahiran' => Kelahiran::class,
    'Pengantar SKCK' => PengantarSkck::class,
    'SKTM' => Sktm::class,
    'Kematian' => Kematian::class,
    'Lainnya' => Lainnya::class,
    'Penghasilan' => Penghasilan::class
];


        list($labels, $datasets) = $this->getChartData($services, $period);

        return view('admin.dashboard', [
            'totalPosts' => $totalPosts,
            'postsThisMonth' => $postsThisMonth,
            'visitorGrowth' => $visitorGrowth,
            'totalViews' => $totalViews,
            'viewGrowth' => $viewGrowth,
            'latestPosts' => $latestPosts,
            'totalSku' => $totalSku,
            'totalBelumMenikah' => $totalBelumMenikah,
            'totalDomisili' => $totalDomisili,
            'totalHargaTanah' => $totalHargaTanah,
            'totalKehilangan' => $totalKehilangan,
            'totalKelahiran' => $totalKelahiran,
            'totalPengantarSkck' => $totalPengantarSkck,
            'totalSktm' => $totalSktm,
            'chartLabels' => $labels,
            'chartDatasets' => $datasets,
            'selectedPeriod' => $period,
            'totalKematian' => $totalKematian,
'totalLainnya' => $totalLainnya,
'totalPenghasilan' => $totalPenghasilan,

        ]);
    }

    private function getChartData($services, $period)
    {
        $labels = collect();
        $datasets = [];
        $days = 0;
        $groupBy = 'DATE(created_at)';
        $format = 'H:i'; // Format jam untuk hari ini

        switch ($period) {
            case 'today':
                $groupBy = 'HOUR(created_at)';
                $format = 'H:i'; // Format jam
                break;
            case '7days':
                $days = 7;
                $groupBy = 'DATE(created_at)';
                $format = 'l'; // Format hari (Senin, Selasa, etc)
                break;
            case '30days':
                $days = 30;
                $groupBy = 'DATE(created_at)';
                $format = 'j M'; // Format tanggal (1 Jan, 2 Jan, etc)
                break;
            case 'this_month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now();
                $days = $startDate->diffInDays($endDate);
                $groupBy = 'DATE(created_at)';
                $format = 'j M';
                break;
            case 'last_month':
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                $days = $startDate->diffInDays($endDate);
                $groupBy = 'DATE(created_at)';
                $format = 'j M';
                break;
            case 'this_year':
                $groupBy = 'MONTH(created_at)';
                $format = 'M'; // Format bulan (Jan, Feb, etc)
                $labels = collect(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']);
                break;
        }

        // Jika bukan this_year, buat labels berdasarkan periode
        if ($period !== 'this_year') {
            if ($period === 'today') {
                // Untuk hari ini, tampilkan per jam
                for ($hour = 0; $hour <= 23; $hour++) {
                    $time = Carbon::now()->startOfDay()->addHours($hour);
                    $labels->push($time->format('H:00'));
                }
            } else {
                // Untuk periode lainnya (7 hari, 30 hari, bulan ini, bulan lalu)
                for ($i = $days; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i);

                    if ($period === 'this_month' || $period === 'last_month') {
                        $start = Carbon::now()->startOfMonth();
                        if ($period === 'last_month') {
                            $start = Carbon::now()->subMonth()->startOfMonth();
                        }
                        $date = $start->copy()->addDays($days - $i);
                    }

                    $labels->push($date->translatedFormat($format));
                }
            }
        }

        $serviceColors = $this->getServiceColors();

        // Prepare data for each service
        foreach ($services as $serviceName => $model) {
            $data = $this->getServiceData($model, $period, $groupBy, $days);
            $color = $serviceColors[$serviceName] ?? '#3B82F6'; // Default blue if not found

            $datasets[] = [
                'label' => $serviceName,
                'data' => $data,
                'backgroundColor' => $this->hexToRgba($color, 0.2),
                'borderColor' => $color,
                'borderWidth' => 2,
                'fill' => true,
                'tension' => 0.4
            ];
        }

        return [$labels, $datasets];
    }

    private function getServiceData($model, $period, $groupBy, $days)
    {
        $data = collect();

        if ($period === 'this_year') {
            // Data per bulan untuk 1 tahun
            for ($month = 1; $month <= 12; $month++) {
                $count = $model::whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', $month)
                    ->count();
                $data->push($count);
            }
        } elseif ($period === 'today') {
            // Data per jam untuk hari ini
            for ($hour = 0; $hour <= 23; $hour++) {
                $start = Carbon::now()->startOfDay()->addHours($hour);
                $end = $start->copy()->addHour();

                $count = $model::whereBetween('created_at', [$start, $end])
                    ->count();
                $data->push($count);
            }
        } else {
            // Data per hari untuk periode lainnya
            for ($i = $days; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);

                if ($period === 'this_month' || $period === 'last_month') {
                    $start = Carbon::now()->startOfMonth();
                    if ($period === 'last_month') {
                        $start = Carbon::now()->subMonth()->startOfMonth();
                    }
                    $date = $start->copy()->addDays($days - $i);
                }

                $count = $model::whereDate('created_at', $date->toDateString())
                    ->count();
                $data->push($count);
            }
        }

        return $data;
    }

   private function getServiceColors()
{
    return [
        'SKU' => '#3B82F6', // Biru
        'Belum Menikah' => '#10B981', // Hijau
        'Domisili' => '#F59E0B', // Kuning
        'Harga Tanah' => '#6366F1', // Ungu
        'Kehilangan' => '#EF4444', // Merah
        'Kelahiran' => '#EC4899', // Pink
        'Pengantar SKCK' => '#14B8A6', // Teal
        'SKTM' => '#F97316', // Orange
        'Kematian' => '#8B5CF6', // Violet
        'Lainnya' => '#0EA5E9', // Sky Blue
        'Penghasilan' => '#22C55E' // Emerald
    ];
}


    private function hexToRgba($hex, $alpha)
    {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        return "rgba($r, $g, $b, $alpha)";
    }
}
