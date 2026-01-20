<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Exception;

class IncomingLetterController extends Controller
{
    public function index(Request $request)
    {
        $query = IncomingLetter::latest();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('reference_number', 'like', "%{$search}%")
                    ->orWhere('sender', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $incomingletters = $query->paginate(12)->withQueryString();

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
            $validated['file'] = $filename;
        }
        // dd($validated);
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
            try {


                if (File::exists(public_path('incoming_letters/' . $letter->file))) {
                    File::delete(public_path('incoming_letters/' . $letter->file));
                }

                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('incoming_letters'), $filename);
                $letter->file = $filename;
            } catch (Exception $e) {
                dd($e->getMessage());
            }

        }
        // dd($request);
        $letter->update($request->except(['file']));

        return redirect()->route('incomingletters.index')->with('success', 'Incoming letter updated!');
    }

    public function destroy($id)
    {
        $letter = IncomingLetter::findOrFail($id);

        // Hapus file fisik jika ada

        // unlink(public_path($letter->file));
        if ($letter->file && File::exists(public_path('incoming_letters/' . $letter->file))) {
            File::delete(public_path('incoming_letters/' . $letter->file));
        }

        $letter->delete();

        return redirect()->route('incomingletters.index')->with('success', 'Incoming letter deleted!');
    }
}
