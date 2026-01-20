<?php

namespace App\Http\Controllers;

use App\Models\OutgoingLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Exception;

class OutgoingLetterController extends Controller
{
    public function index(Request $request)
    {
        $query = OutgoingLetter::latest();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('reference_number', 'like', "%{$search}%")
                    ->orWhere('recipient', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $outgoingletters = $query->paginate(12)->withQueryString();

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
            $validated['file'] = $filename;
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
            try {
                if (File::exists(public_path('outgoing_letters/' . $letter->file))) {
                    File::delete(public_path('outgoing_letters/' . $letter->file));
                }

                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('outgoing_letters'), $filename);
                $letter->file = $filename;
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }

        $letter->update($request->except(['file']));

        return redirect()->route('outgoingletters.index')->with('success', 'Outgoing letter updated!');
    }

    public function destroy($id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        // Hapus file fisik jika ada
        if ($letter->file && File::exists(public_path('outgoing_letters/' . $letter->file))) {
            File::delete(public_path('outgoing_letters/' . $letter->file));
        }



        $letter->delete();

        return redirect()->route('outgoingletters.index')->with('success', 'Outgoing letter deleted!');
    }
}
