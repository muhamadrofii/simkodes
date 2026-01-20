<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoryExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Inventory::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Barang',
            'Tanggal',
            'Jumlah',
            'Harga Satuan',
            'Total Harga',
            'Umur Teknis',
            'Umur Ekonomis',
            'Keterangan',
            'Dibuat Pada'
        ];
    }

    public function map($inventory): array
    {
        return [
            $inventory->id,
            $inventory->nama_barang,
            $inventory->tanggal ? \Carbon\Carbon::parse($inventory->tanggal)->format('d/m/Y') : '-',
            $inventory->jumlah,
            'Rp ' . number_format($inventory->harga_satuan, 0, ',', '.'),
            'Rp ' . number_format($inventory->jumlah_rupiah, 0, ',', '.'),
            $inventory->umur_teknis . ' th',
            $inventory->umur_ekonomis . ' th',
            $inventory->keterangan,
            $inventory->created_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}
