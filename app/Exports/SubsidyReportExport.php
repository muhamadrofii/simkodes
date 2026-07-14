<?php

namespace App\Exports;

use App\Models\SubsidyCheck;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SubsidyReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $subsidyId;
    protected $tahun;
    protected $search;
    protected $rowNumber = 0;

    public function __construct($subsidyId = null, $tahun = null, $search = null)
    {
        $this->subsidyId = $subsidyId;
        $this->tahun = $tahun;
        $this->search = $search;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = SubsidyCheck::whereNotNull('parent_id')->with('program');

        if ($this->subsidyId) {
            $query->where('parent_id', $this->subsidyId);
        }

        if ($this->tahun) {
            $query->whereHas('program', function ($q) {
                $q->where('tahun', $this->tahun);
            });
        }

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'LIKE', '%' . $search . '%')
                  ->orWhere('no_kk', 'LIKE', '%' . $search . '%')
                  ->orWhere('nama', 'LIKE', '%' . $search . '%');
            });
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIK Penerima',
            'No KK Penerima',
            'Nama Penerima',
            'Program Subsidi',
            'Tahun',
            'Periode',
            'Keterangan',
            'Tanggal Ambil',
            'Status'
        ];
    }

    public function map($claim): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            "'" . $claim->nik, // Memaksa Excel membaca NIK sebagai string text
            "'" . $claim->no_kk, // Memaksa Excel membaca No KK sebagai string text
            $claim->nama,
            $claim->program->nama ?? '-',
            $claim->program->tahun ?? '-',
            $claim->program->periode ?? '-',
            $claim->keterangan ?? '-',
            !empty($claim->periode) ? \Carbon\Carbon::parse($claim->periode)->format('d/m/Y H:i') : '-',
            !empty($claim->periode) ? 'Sudah Diklaim' : 'Belum Diklaim'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Tebalkan baris header.
            1 => ['font' => ['bold' => true]],
        ];
    }
}
