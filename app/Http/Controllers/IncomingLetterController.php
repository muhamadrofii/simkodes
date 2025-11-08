<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use Illuminate\Http\Request;

class IncomingLetterController extends Controller
{
    public function index()
    {
        // Ambil data dengan urutan terbaru dan pagination
        $incomingletters = IncomingLetter::latest()->paginate(12);

        return view('letters.incoming.index', compact('incomingletters'));
    }

    public function create()
    {
        return view('letters.incoming.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'reference_number' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Simpan file di public/incoming_letters/
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('incoming_letters'), $filename);
            $validated['file'] = 'incoming_letters/' . $filename;
        }

        IncomingLetter::create($validated);

        return redirect()->route('incomingletters.index')->with('success', 'Incoming letter added!');
    }

    public function show($id)
    {
        $letter = IncomingLetter::findOrFail($id);
        return view('letters.incoming.show', compact('letter'));
    }

    public function edit($id)
    {
        $letter = IncomingLetter::findOrFail($id);
        return view('letters.incoming.edit', compact('letter'));
    }

    public function update(Request $request, $id)
    {
        $letter = IncomingLetter::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'reference_number' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('incoming_letters'), $filename);
            $validated['file'] = 'incoming_letters/' . $filename;
        }

        $letter->update($validated);

        return redirect()->route('incomingletters.index')->with('success', 'Incoming letter updated!');
    }

    public function destroy($id)
    {
        $letter = IncomingLetter::findOrFail($id);

        // Hapus file fisik jika ada
        if ($letter->file && file_exists(public_path($letter->file))) {
            unlink(public_path($letter->file));
        }

        $letter->delete();

        return redirect()->route('incomingletters.index')->with('success', 'Incoming letter deleted!');
    }
}
