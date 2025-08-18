<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // ✅ Penulisan benar
use App\Models\Data;
use App\Models\Content;


class UserController extends Controller
{
    public function home(Request $request)
{
    $query = Data::query();

    if ($request->filled('rt')) {
        $query->where('rt', $request->rt);
    }

    if ($request->filled('rw')) {
        $query->where('rw', $request->rw);
    }

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nik', 'like', '%' . $request->search . '%')
              ->orWhere('no_kk', 'like', '%' . $request->search . '%')
              ->orWhere('nama_lengkap', 'like', '%' . $request->search . '%');
        });
    }

    switch ($request->sort) {
        case 'nama_desc':
            $query->orderBy('nama_lengkap', 'desc');
            break;
        case 'tanggal_asc':
            $query->orderBy('created_at', 'asc');
            break;
        case 'tanggal_desc':
            $query->orderBy('created_at', 'desc');
            break;
        default:
            $query->orderBy('nama_lengkap', 'asc');
            break;
    }

    $perPage = $request->perPage === 'all' ? $query->count() : ($request->perPage ?? 25);
    $data = $query->paginate($perPage)->withQueryString();
    $contents = Content::orderBy('created_at', 'desc')->get();

    return view('user.home', compact('data', 'contents'));
}
public function data(Request $request)
{
    $query = Data::query();

    // Filter Search
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
              ->orWhere('nik', 'like', '%' . $request->search . '%')
              ->orWhere('alamat', 'like', '%' . $request->search . '%');
        });
    }

    // Filter RT
    if ($request->filled('rt')) {
        $query->where('rt', $request->rt);
    }

    // Filter RW
    if ($request->filled('rw')) {
        $query->where('rw', $request->rw);
    }

    // Sorting
    switch ($request->sort) {
        case 'nama_asc':
            $query->orderBy('nama_lengkap', 'asc');
            break;
        case 'nama_desc':
            $query->orderBy('nama_lengkap', 'desc');
            break;
        case 'tanggal_asc':
            $query->orderBy('created_at', 'asc');
            break;
        case 'tanggal_desc':
            $query->orderBy('created_at', 'desc');
            break;
        default:
            $query->orderBy('nama_lengkap', 'asc');
    }

    // Per Page
    $perPage = $request->perPage ?? 25;

if ($perPage === 'all') {
    $perPage = $query->count(); // ambil semua data
}

$data = $query->paginate($perPage)->appends($request->all());
    $contents = Content::all();
    

    return view('user.home', compact('data', 'contents'));

}
    public function show($id)
{
    $content = \App\Models\Content::findOrFail($id);
    return view('pages.content.show', compact('content'));
}

}
