<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * LIST (admin) + search/sort/paginate
     */
    public function index(Request $request)
    {
        $contents = Content::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = $request->search;
                $q->where(function ($qq) use ($s) {
                    $qq->where('title', 'like', "%{$s}%")
                       ->orWhere('description', 'like', "%{$s}%");
                });
            })
            ->when($request->sort === 'judul', fn($q) => $q->orderBy('title', 'asc'))
            ->when($request->sort === 'lama',  fn($q) => $q->orderBy('created_at', 'asc'))
            ->when(!in_array($request->sort, ['judul', 'lama'], true), fn($q) => $q->orderBy('created_at', 'desc'))
            ->paginate(10)
            ->withQueryString();

        return view('admin.content.index', compact('contents'));
    }

    /**
     * CREATE (admin)
     */
    public function create()
    {
        return view('admin.content.create');
    }

    /**
     * STORE (admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image',
            'youtube_url' => 'nullable|url',
        ], [
            'title.required'       => 'Judul wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'image.required'       => 'Foto wajib diunggah.',
            'image.image'          => 'File foto harus berupa gambar.',
            'youtube_url.url'      => 'Link YouTube tidak valid.',
        ]);

        // batasi 10 konten: hapus terlama
        if (Content::count() >= 15) {
            $oldest = Content::orderBy('created_at', 'asc')->first();
            if ($oldest) {
                if ($oldest->image && Storage::disk('public')->exists($oldest->image)) {
                    Storage::disk('public')->delete($oldest->image);
                }
                $oldest->delete();
            }
        }

        $imagePath = $request->file('image')->store('contents', 'public');

        Content::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'youtube_url'  => $request->youtube_url,
        ]);

        return redirect()->route('admin.content.index')->with('success', 'Konten berhasil disimpan!');
    }

    /**
     * EDIT (admin)
     */
    public function edit(Content $content)
    {
        return view('admin.content.edit', compact('content'));
    }

    /**
     * UPDATE (admin)
     */
    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'youtube_url' => 'nullable|url',
        ]);

        $data = $request->only('title', 'description', 'youtube_url');

        if ($request->hasFile('image')) {
            if ($content->image) {
                Storage::disk('public')->delete($content->image);
            }
            $data['image'] = $request->file('image')->store('contents', 'public');
        }

        $content->update($data);

        return redirect()->route('admin.content.index')->with('success', 'Konten berhasil diperbarui');
    }

    /**
     * DESTROY (admin)
     */
    public function destroy(Content $content)
    {
        if ($content->image) {
            Storage::disk('public')->delete($content->image);
        }
        $content->delete();

        return redirect()->route('admin.content.index')->with('success', 'Konten berhasil dihapus');
    }

    /**
     * SHOW (publik) — jika kamu ingin detail konten tampil di sisi user/public.
     * Kalau maunya show versi admin, ubah view di bawah ke 'admin.content.show'
     * dan taruh route-nya di grup admin.
     */
    public function show($id)
    {
        $content = Content::findOrFail($id);
        return view('user.content.show', compact('content'));
    }
    // app/Http/Controllers/ContentController.php
public function pemuda()
{
    // ambil data sesuai kebutuhan pemuda
    $contents = \App\Models\Content::orderBy('created_at','desc')->paginate(10);
    return view('admin.content.pemuda', compact('contents'));
}

}
