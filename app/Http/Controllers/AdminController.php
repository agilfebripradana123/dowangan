<?php

namespace App\Http\Controllers;

use App\Models\DataDowangan;
use Illuminate\Http\Request;
use App\Models\Data;      // ✅ import model
use App\Models\Content;   // ✅ import model

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalData     = Data::count();
        $totalContent  = Content::count();
        $latestContents = Content::orderBy('created_at', 'desc')->take(10)->get();

        return view('admin.dashboard', compact('totalData', 'totalContent', 'latestContents'));
    }

    public function contentIndex()
    {
        return view('admin.content.index');
    }

    public function dataIndex()
    {
        $datadowangan = DataDowangan::latest()->paginate(10);
        return view('admin.data.index', compact('datadowangan'));
    }
    
}
