<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // jumlah data yang ditampilkan per paginasi halaman
        $maxData = 8;

        if (request('search')) {
            // menampilkan pencarian data
            $categories = Category::select('id', 'name', 'image')
                ->where('name', 'like', '%' . request('search') . '%')
                ->paginate($maxData)
                ->withQueryString();
        } else {
            // menampilkan semua data
            $categories = Category::select('id', 'name', 'image')
                ->latest()
                ->paginate($maxData);
        }

        // tampilkan data ke view
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // tampilkan form add data
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'name'        => 'required|unique:categories',
            'description' => 'required',
            'image'       => 'required|image|mimes: jpeg,jpg,png|max: 1024'
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/categories', $image->hashName());

        // create data
        Category::create([
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $image->hashName()
        ]);

        // redirect ke halaman index dan tampilkan pesan berhasil simpan data
        return redirect()->route('categories.index')->with(['success' => 'The new category has been saved.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // get data by ID
        $category = Category::findOrFail($id);

        // tampilkan form detail data
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // get data by ID
        $category = Category::findOrFail($id);

        // tampilkan form edit data
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // validasi form
        $request->validate([
            'name'        => 'required|unique:categories,name,' . $id,
            'description' => 'required',
            'image'       => 'image|mimes: jpeg,jpg,png|max: 1024'
        ]);

        // get data by ID
        $category = Category::findOrFail($id);

        // cek jika image diubah
        if ($request->hasFile('image')) {
            // upload image baru
            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            // delete image lama
            Storage::delete('public/categories/' . $category->image);

            // update data
            $category->update([
                'name'        => $request->name,
                'description' => $request->description,
                'image'       => $image->hashName()
            ]);
        }
        // jika image tidak diubah
        else {
            // update data
            $category->update([
                'name'        => $request->name,
                'description' => $request->description
            ]);
        }

        // redirect ke halaman index dan tampilkan pesan berhasil ubah data
        return redirect()->route('categories.show', $category->id)->with(['success' => 'The category has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        // get data by ID
        $category = Category::findOrFail($id);

        // delete image
        Storage::delete('public/categories/' . $category->image);

        // delete data
        $category->delete();

        // redirect ke halaman index dan tampilkan pesan berhasil hapus data
        return redirect()->route('categories.index')->with(['success' => 'The category has been deleted!']);
    }
}