<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IncomingLetter;
use App\Models\Inventory;
use App\Models\Member;
use App\Models\Officer;
use App\Models\OutgoingLetter;
use App\Models\Supervisor;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // menampilkan data kategori dengan jumlah data member
        $categories = Category::select('id', 'name', 'image')
            ->withCount(['members', 'supervisors', 'officers'])
            ->orderBy('members_count', 'desc')
            ->get();

        // rangkuman jumlah data untuk infografis
        $summaryCounts = [
            'members' => Member::count(),
            'supervisors' => Supervisor::count(),
            'officers' => Officer::count(),
            'inventories' => Inventory::count(),
            'incoming_letters' => IncomingLetter::count(),
            'outgoing_letters' => OutgoingLetter::count(),
            'categories' => Category::count(),
        ];

        // data grafik jumlah member per kategori
        $memberCategoryLabels = $categories->pluck('name');
        $memberCategoryCounts = $categories->pluck('members_count');

        // data grafik surat masuk/keluar per bulan (6 bulan terakhir)
        $startMonth = Carbon::now()->startOfMonth()->subMonths(5);
        $endMonth = Carbon::now()->startOfMonth();
        $period = CarbonPeriod::create($startMonth, '1 month', $endMonth);

        $monthKeys = collect();
        $monthLabels = collect();
        foreach ($period as $date) {
            $monthKeys->push($date->format('Y-m'));
            $monthLabels->push($date->format('M Y'));
        }

        // gunakan created_at karena tabel surat tidak memiliki kolom received_date
        $incomingByMonth = IncomingLetter::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as total")
            ->whereNotNull('created_at')
            ->where('created_at', '>=', $startMonth->toDateString())
            ->groupBy('ym')
            ->pluck('total', 'ym');

        $outgoingByMonth = OutgoingLetter::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as total")
            ->whereNotNull('created_at')
            ->where('created_at', '>=', $startMonth->toDateString())
            ->groupBy('ym')
            ->pluck('total', 'ym');

        $incomingSeries = $monthKeys->map(fn ($ym) => (int) ($incomingByMonth[$ym] ?? 0));
        $outgoingSeries = $monthKeys->map(fn ($ym) => (int) ($outgoingByMonth[$ym] ?? 0));

        // tampilkan data ke view
        return view('dashboard.index', compact(
            'categories',
            'summaryCounts',
            'memberCategoryLabels',
            'memberCategoryCounts',
            'monthLabels',
            'incomingSeries',
            'outgoingSeries'
        ));
    }
}
