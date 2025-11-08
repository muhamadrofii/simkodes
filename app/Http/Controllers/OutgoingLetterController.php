<?php

namespace App\Http\Controllers;

use App\Models\OutgoingLetter;
use Illuminate\Http\Request;

class OutgoingLetterController extends Controller
{
    public function index()
    {
        // Ambil data dengan urutan terbaru dan pagination
        $outgoingletters = OutgoingLetter::latest()->paginate(12);

        return view('letters.outgoing.index', compact('outgoingletters'));
    }

    public function create()
    {
        return view('letters.outgoing.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'reference_number' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Simpan file di public/outgoing_letters/
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('outgoing_letters'), $filename);
            $validated['file'] = 'outgoing_letters/' . $filename;
        }

        OutgoingLetter::create($validated);

        return redirect()->route('outgoingletters.index')->with('success', 'Outgoing letter added!');
    }

    public function show($id)
    {
        $letter = OutgoingLetter::findOrFail($id);
        return view('letters.outgoing.show', compact('letter'));
    }

    public function edit($id)
    {
        $letter = OutgoingLetter::findOrFail($id);
        return view('letters.outgoing.edit', compact('letter'));
    }

    public function update(Request $request, $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'reference_number' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('outgoing_letters'), $filename);
            $validated['file'] = 'outgoing_letters/' . $filename;
        }

        $letter->update($validated);

        return redirect()->route('outgoingletters.index')->with('success', 'Outgoing letter updated!');
    }

    public function destroy($id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        // Hapus file fisik jika ada
        if ($letter->file && file_exists(public_path($letter->file))) {
            unlink(public_path($letter->file));
        }

        $letter->delete();

        return redirect()->route('outgoingletters.index')->with('success', 'Outgoing letter deleted!');
    }
}
