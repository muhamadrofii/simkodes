<?php

namespace App\Http\Controllers;

use App\Models\SubsidyCheck;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SubsidyReportExport;

class SubsidyCheckController extends Controller
{
    /**
     * Halaman utama checker subsidi (penerima).
     */
    public function index(Request $request): View
    {
        $result = null;
        $nik = $request->query('nik');
        $no_kk = $request->query('no_kk');
        $subsidy_id = $request->query('subsidy_id');
        $checkStatus = null; // 'empty', 'claimed_nik', 'claimed_kk', 'ready'

        $programs = SubsidyCheck::whereNull('parent_id')->get();
        $selectedProgram = null;

        if ($subsidy_id) {
            $selectedProgram = SubsidyCheck::whereNull('parent_id')->find($subsidy_id);
        }

        if ($nik && $no_kk && $subsidy_id) {
            // 1. Cek apakah NIK ini sudah claim program ini
            $claimByNik = SubsidyCheck::where('parent_id', $subsidy_id)
                ->where('nik', $nik)
                ->first();

            // 2. Cek apakah KK ini sudah claim program ini
            $claimByKk = SubsidyCheck::where('parent_id', $subsidy_id)
                ->where('no_kk', $no_kk)
                ->first();

            if ($claimByNik) {
                $checkStatus = 'claimed_nik';
                $result = $claimByNik;
            } elseif ($claimByKk) {
                $checkStatus = 'claimed_kk';
                $result = $claimByKk;
            } else {
                $checkStatus = 'ready';
            }
        }

        return view('subsidychecks.index', compact(
            'result', 'nik', 'no_kk', 'subsidy_id', 
            'checkStatus', 'programs', 'selectedProgram'
        ));
    }

    /**
     * Cek NIK dan KK apakah sudah pernah dapat subsidi terpilih.
     */
    public function check(Request $request)
    {
        $request->validate([
            'subsidy_id' => 'required|exists:subsidy_checks,id',
            'nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'no_kk' => 'required|string|size:16|regex:/^[0-9]+$/',
        ], [
            'subsidy_id.required' => 'Program subsidi wajib dipilih.',
            'subsidy_id.exists' => 'Program subsidi tidak valid.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.size' => 'Nomor KK harus 16 digit.',
            'no_kk.regex' => 'Nomor KK hanya boleh berisi angka.',
        ]);

        return redirect()->route('subsidychecks.index', [
            'subsidy_id' => $request->subsidy_id,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk
        ]);
    }

    /**
     * Simpan data penerima subsidi baru (klaim).
     */
    public function store(Request $request)
    {
        $request->validate([
            'subsidy_id' => 'required|exists:subsidy_checks,id',
            'nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'no_kk' => 'required|string|size:16|regex:/^[0-9]+$/',
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'subsidy_id.required' => 'Program subsidi wajib dipilih.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.size' => 'Nomor KK harus 16 digit.',
            'no_kk.regex' => 'Nomor KK hanya boleh berisi angka.',
            'nama.required' => 'Nama penerima wajib diisi.',
        ]);

        // Cek lagi rules: 1 KK hanya boleh 1 penerima per program subsidi
        $claimByNik = SubsidyCheck::where('parent_id', $request->subsidy_id)
            ->where('nik', $request->nik)
            ->first();

        if ($claimByNik) {
            return redirect()->back()->withInput()->with('error', 'Penerima dengan NIK ini sudah pernah mengklaim subsidi ini.');
        }

        $claimByKk = SubsidyCheck::where('parent_id', $request->subsidy_id)
            ->where('no_kk', $request->no_kk)
            ->first();

        if ($claimByKk) {
            return redirect()->back()->withInput()->with('error', 'Nomor KK ini sudah menerima subsidi ini atas nama ' . $claimByKk->nama . ' (Kuota KK habis).');
        }

        SubsidyCheck::create([
            'parent_id' => $request->subsidy_id,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('subsidychecks.index', ['subsidy_id' => $request->subsidy_id])
            ->with('success', 'Data penerima subsidi berhasil ditambahkan.');
    }

    /**
     * Hapus data klaim penerima subsidi.
     */
    public function destroy($id)
    {
        $subsidyCheck = SubsidyCheck::findOrFail($id);
        $subsidyCheck->delete();

        return redirect()->route('subsidies.reports.index')
            ->with('success', 'Data penerima subsidi berhasil dihapus.');
    }

    // ==========================================
    // MANAJEMEN MASTER SUBSIDI (parent_id = null)
    // ==========================================

    /**
     * Halaman manajemen program subsidi.
     */
    public function subsidyIndex(Request $request): View
    {
        $search = $request->query('search');
        $query = SubsidyCheck::whereNull('parent_id');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', '%' . $search . '%')
                  ->orWhere('tahun', 'LIKE', '%' . $search . '%')
                  ->orWhere('periode', 'LIKE', '%' . $search . '%');
            });
        }

        $subsidies = $query->latest()->paginate(10)->withQueryString();

        return view('subsidies.index', compact('subsidies'));
    }

    /**
     * Simpan program subsidi baru.
     */
    public function subsidyStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|string|size:4|regex:/^[0-9]+$/',
            'periode' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'nama.required' => 'Nama subsidi wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.size' => 'Tahun harus 4 digit.',
            'tahun.regex' => 'Tahun hanya boleh berisi angka.',
            'periode.required' => 'Periode wajib diisi.',
        ]);

        SubsidyCheck::create([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'periode' => $request->periode,
            'keterangan' => $request->keterangan,
            'parent_id' => null,
            'nik' => null,
            'no_kk' => null,
        ]);

        return redirect()->route('subsidies.index')
            ->with('success', 'Program subsidi berhasil ditambahkan.');
    }

    /**
     * Update program subsidi.
     */
    public function subsidyUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|string|size:4|regex:/^[0-9]+$/',
            'periode' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'nama.required' => 'Nama subsidi wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.size' => 'Tahun harus 4 digit.',
            'tahun.regex' => 'Tahun hanya boleh berisi angka.',
            'periode.required' => 'Periode wajib diisi.',
        ]);

        $subsidy = SubsidyCheck::whereNull('parent_id')->findOrFail($id);
        $subsidy->update([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'periode' => $request->periode,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('subsidies.index')
            ->with('success', 'Program subsidi berhasil diperbarui.');
    }

    /**
     * Hapus program subsidi.
     */
    public function subsidyDestroy($id)
    {
        $subsidy = SubsidyCheck::whereNull('parent_id')->findOrFail($id);
        $subsidy->delete();

        return redirect()->route('subsidies.index')
            ->with('success', 'Program subsidi berhasil dihapus beserta seluruh riwayat klaimnya.');
    }

    /**
     * Import data penerima subsidi dari Excel.
     */
    public function subsidyImport(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ], [
            'file.required' => 'File Excel wajib diunggah.',
            'file.mimes' => 'Format file harus berupa xlsx, xls, atau csv.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 10MB.',
        ]);

        $program = SubsidyCheck::whereNull('parent_id')->findOrFail($id);

        try {
            $file = $request->file('file');
            // Membaca isi spreadsheet
            $sheets = Excel::toArray(new class implements \Maatwebsite\Excel\Concerns\ToArray {
                public function array(array $array) {}
            }, $file);

            $rows = $sheets[0] ?? [];
            if (empty($rows)) {
                return redirect()->back()->with('error', 'File Excel kosong atau tidak terbaca.');
            }

            // Cek jika baris pertama adalah header, tapi jika tidak ada header, mari kita periksa baris pertama.
            $startRow = 0;
            if (count($rows) > 0) {
                $firstRow = $rows[0];
                $isHeader = false;
                foreach ($firstRow as $cell) {
                    $cellLower = strtolower(trim((string)$cell));
                    if (str_contains($cellLower, 'nik') || str_contains($cellLower, 'kk') || str_contains($cellLower, 'nama') || str_contains($cellLower, 'no')) {
                        $isHeader = true;
                        break;
                    }
                }
                if ($isHeader) {
                    $startRow = 1;
                }
            }

            $successCount = 0;
            $skipCount = 0;
            $errors = [];

            for ($i = $startRow; $i < count($rows); $i++) {
                $row = $rows[$i];
                
                // Ambil kolom-kolomnya:
                // Col 0: No (diabaikan)
                // Col 1: NIK
                // Col 2: No KK
                // Col 3: Nama
                // Col 4: Keterangan
                
                $nik = isset($row[1]) ? trim((string)$row[1]) : '';
                $no_kk = isset($row[2]) ? trim((string)$row[2]) : '';
                $nama = isset($row[3]) ? trim((string)$row[3]) : '';
                $keterangan = isset($row[4]) ? trim((string)$row[4]) : '';

                // Jika data kosong semua, lewati saja
                if (empty($nik) && empty($no_kk) && empty($nama)) {
                    continue;
                }

                $rowNumber = $i + 1;

                // Validasi data
                if (empty($nik) || empty($no_kk) || empty($nama)) {
                    $skipCount++;
                    $errors[] = "Baris {$rowNumber}: Kolom NIK, No KK, dan Nama wajib diisi.";
                    continue;
                }

                // Cek jika scientific notation
                if (str_contains(strtolower($nik), 'e+')) {
                    $nik = number_format((float)$nik, 0, '', '');
                }
                if (str_contains(strtolower($no_kk), 'e+')) {
                    $no_kk = number_format((float)$no_kk, 0, '', '');
                }

                $nik = preg_replace('/[^0-9]/', '', $nik);
                $no_kk = preg_replace('/[^0-9]/', '', $no_kk);

                if (strlen($nik) !== 16) {
                    $skipCount++;
                    $errors[] = "Baris {$rowNumber}: NIK harus 16 digit angka (ditemukan: " . strlen($nik) . " digit).";
                    continue;
                }

                if (strlen($no_kk) !== 16) {
                    $skipCount++;
                    $errors[] = "Baris {$rowNumber}: No KK harus 16 digit angka (ditemukan: " . strlen($no_kk) . " digit).";
                    continue;
                }

                // Cek apakah NIK sudah claim program ini
                $existsNik = SubsidyCheck::where('parent_id', $id)
                    ->where('nik', $nik)
                    ->exists();

                if ($existsNik) {
                    $skipCount++;
                    $errors[] = "Baris {$rowNumber}: NIK {$nik} sudah terdaftar di program ini.";
                    continue;
                }

                // Cek apakah KK sudah claim program ini (1 KK 1 Penerima)
                $existsKk = SubsidyCheck::where('parent_id', $id)
                    ->where('no_kk', $no_kk)
                    ->exists();

                if ($existsKk) {
                    $skipCount++;
                    $errors[] = "Baris {$rowNumber}: No KK {$no_kk} sudah menerima subsidi ini (Kuota KK habis).";
                    continue;
                }

                // Simpan
                SubsidyCheck::create([
                    'parent_id' => $id,
                    'nik' => $nik,
                    'no_kk' => $no_kk,
                    'nama' => $nama,
                    'keterangan' => $keterangan,
                ]);

                $successCount++;
            }

            $message = "Berhasil mengimport {$successCount} data penerima.";
            if ($skipCount > 0) {
                $message .= " {$skipCount} data dilewati karena kesalahan format atau duplikasi.";
            }

            if ($successCount === 0 && $skipCount > 0) {
                return redirect()->route('subsidies.index')
                    ->with('error', 'Gagal mengimport data. Semua baris dilewati.')
                    ->with('import_errors', $errors);
            }

            if ($skipCount > 0) {
                return redirect()->route('subsidies.index')
                    ->with('success', $message)
                    ->with('import_errors', $errors);
            }

            return redirect()->route('subsidies.index')->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses file Excel: ' . $e->getMessage());
        }
    }

    /**
     * Halaman Laporan Penerima Subsidi.
     */
    public function reportIndex(Request $request)
    {
        $programs = SubsidyCheck::whereNull('parent_id')->get();
        $query = SubsidyCheck::whereNotNull('parent_id')->with('program');

        if ($request->filled('subsidy_id')) {
            $query->where('parent_id', $request->subsidy_id);
        }

        if ($request->filled('tahun')) {
            $query->whereHas('program', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'LIKE', '%' . $search . '%')
                  ->orWhere('no_kk', 'LIKE', '%' . $search . '%')
                  ->orWhere('nama', 'LIKE', '%' . $search . '%');
            });
        }

        $claims = $query->latest()->paginate(15)->withQueryString();

        return view('subsidies.reports.index', compact('programs', 'claims'));
    }

    /**
     * Ekspor Laporan Penerima Subsidi ke PDF.
     */
    public function reportPdf(Request $request)
    {
        $query = SubsidyCheck::whereNotNull('parent_id')->with('program');

        if ($request->filled('subsidy_id')) {
            $query->where('parent_id', $request->subsidy_id);
        }

        if ($request->filled('tahun')) {
            $query->whereHas('program', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'LIKE', '%' . $search . '%')
                  ->orWhere('no_kk', 'LIKE', '%' . $search . '%')
                  ->orWhere('nama', 'LIKE', '%' . $search . '%');
            });
        }

        $claims = $query->latest()->get();
        
        $programName = 'Semua Program';
        if ($request->filled('subsidy_id')) {
            $prog = SubsidyCheck::find($request->subsidy_id);
            if ($prog) {
                $programName = $prog->nama;
            }
        }

        $pdf = Pdf::loadView('subsidies.reports.print', compact('claims', 'programName'))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Penerima_Subsidi_' . date('Ymd_His') . '.pdf');
    }

    /**
     * Ekspor Laporan Penerima Subsidi ke Excel.
     */
    public function reportExcel(Request $request)
    {
        return Excel::download(
            new SubsidyReportExport($request->subsidy_id, $request->tahun, $request->search),
            'Laporan_Penerima_Subsidi_' . date('Ymd_His') . '.xlsx'
        );
    }
}
