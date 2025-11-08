<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::select('id', 'name', 'image')->withCount('members')
            ->orderBy('members_count', 'desc')
            ->get();

        // tampilkan data ke view
        return view('dashboard.index', compact('categories'));
    }
}