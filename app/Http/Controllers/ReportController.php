<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // tampilkan view
        return view('report.index');
    }

    /**
     * filter
     */
    public function filter(Request $request): View
    {
        // validasi form
        $request->validate([
            'start_date' => 'required',
            'end_date'   => 'required|date|after:start_date'
        ]);

        // data filter
        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        // menampilkan data berdasarkan filter
        $members = Member::with('category:id,name')
            ->whereBetween('join_date', [$startDate, $endDate])
            ->oldest()
            ->get();

        // tampilkan data ke view
        return view('report.index', compact('members'));
    }

    /**
     * print
     */
    public function print($startDate, $endDate)
    {   
        // menampilkan data berdasarkan filter
        $members = Member::with('category:id,name')
            ->whereBetween('join_date', [$startDate, $endDate])
            ->oldest()
            ->get();

        // load view PDF
        $pdf = Pdf::loadview('report.print', compact('members'))->setPaper('a4', 'landscape');
        // tampilkan ke browser
        return $pdf->stream('Members.pdf');
    }
}