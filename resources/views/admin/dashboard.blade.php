@extends('layout.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
    <!-- Kartu: Total Data Penduduk -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Data Penduduk
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalData) }}</div>
                </div>
                <div class="ml-2">
                    <a href="{{ route('admin.data.index') }}" class="btn btn-sm btn-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu: Total Konten -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Konten
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalContent) }}</div>
                </div>
                <div class="ml-2">
                    <a href="{{ route('admin.content.index') }}" class="btn btn-sm btn-success">Lihat</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
