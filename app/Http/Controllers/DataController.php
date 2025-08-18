<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Data;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;
use Rap2hpoutre\FastExcel\FastExcel;


class DataController extends Controller
{
public function index(Request $request)
{
    $query = Data::query();

    // Filter pencarian global
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nik', 'like', "%$search%")
            ->orWhere('no_kk', 'like', "%$search%")
            ->orWhere('nama_lengkap', 'like', "%$search%")
            ->orWhere('alamat', 'like', "%$search%")
            ->orWhere('tempat_lahir', 'like', "%$search%")
            ->orWhere('tanggal_lahir', 'like', "%$search%")
            ->orWhere('jenis_kelamin', 'like', "%$search%")
            ->orWhere('golongan_darah', 'like', "%$search%")
            ->orWhere('agama', 'like', "%$search%")
            ->orWhere(function ($sub) use ($search) {
                if (strtolower($search) === 'kawin') {
                    $sub->where('status_perkawinan', 'kawin');
                } elseif (strtolower($search) === 'belum kawin') {
                    $sub->where('status_perkawinan', 'belum kawin');
                } else {
                    $sub->where('status_perkawinan', 'like', "%$search%");
                }
            })
            ->orWhere('status_keluarga', 'like', "%$search%")
            ->orWhere('pendidikan_terakhir', 'like', "%$search%")
            ->orWhere('pekerjaan', 'like', "%$search%")
            ->orWhere('kewarganegaraan', 'like', "%$search%");
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
    // Filter Golongan Darah
    if ($request->filled('golongan_darah')) {
        $query->where('golongan_darah', $request->golongan_darah);
    }

    // Sorting dan paginasi
    $perPage = $request->perPage === 'all' ? $query->count() : ($request->perPage ?? 25);

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
        $query->orderBy('nama_lengkap', 'asc'); // ✅ default: nama A-Z
        break;
}

$datadowangan = $query->paginate($perPage)->withQueryString();

    

    return view('admin.data.index', compact('datadowangan'));
}

    public function create(){

    return view('admin.data.create');
    }

    public function store(Request $request)
        {
            // Validasi data
            $request->validate([
    'nik' => ['required', 'min:16', 'max:16', Rule::unique('data')],
    'no_kk' => 'required|min:16|max:16',
    'nama_lengkap' => 'required|min:1|max:100',
    'alamat' => 'required|max:100',
    'rt' => 'nullable|digits_between:1,3',
    'rw' => 'nullable|digits_between:1,3',
    'tempat_lahir' => 'required|string|max:50',
    'tanggal_lahir' => 'required|date_format:Y-m-d',
    'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
    'golongan_darah' => ['nullable', Rule::in(['A', 'B', 'AB', 'O', '-'])],
    'agama' => 'nullable|max:20',
    'status_perkawinan' => ['required', Rule::in(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])],
    'status_keluarga' => 'nullable|max:30',
    'pendidikan_terakhir' => 'nullable|max:50',
    'pekerjaan' => 'nullable|max:50',
    'kewarganegaraan' => ['required', Rule::in(['WNI', 'WNA'])],
    'disabilitas' => 'nullable|boolean',
], [
    // NIK
    'nik.required' => 'NIK wajib diisi.',
    'nik.min' => 'NIK harus terdiri dari 16 digit.',
    'nik.max' => 'NIK tidak boleh lebih dari 16 digit.',
    'nik.unique' => 'NIK sudah digunakan oleh penduduk lain.',

    // No KK
    'no_kk.required' => 'No KK wajib diisi.',
    'no_kk.min' => 'No KK harus terdiri dari 16 digit.',
    'no_kk.max' => 'No KK tidak boleh lebih dari 16 digit.',

    // Nama
    'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
    'nama_lengkap.min' => 'Nama lengkap minimal 1 karakter.',
    'nama_lengkap.max' => 'Nama lengkap maksimal 100 karakter.',

    // Alamat
    'alamat.required' => 'Alamat wajib diisi.',
    'alamat.max' => 'Alamat maksimal 100 karakter.',

    // RT RW
    'rt.digits_between' => 'RT harus berupa angka 1 sampai 3 digit.',
    'rw.digits_between' => 'RW harus berupa angka 1 sampai 3 digit.',

    // Tempat Lahir
    'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
    'tempat_lahir.max' => 'Tempat lahir maksimal 50 karakter.',

    // Tanggal Lahir
    'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
    'tanggal_lahir.date_format' => 'Format tanggal lahir harus YYYY-MM-DD.',

    // Jenis Kelamin
    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
    'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',

    // Golongan darah
    'golongan_darah.in' => 'Golongan darah tidak valid.',

    // Agama
    'agama.max' => 'Agama maksimal 20 karakter.',

    // Status Perkawinan
    'status_perkawinan.required' => 'Status perkawinan wajib diisi.',
    'status_perkawinan.in' => 'Status perkawinan tidak valid.',

    // Status Keluarga
    'status_keluarga.max' => 'Status keluarga maksimal 30 karakter.',

    // Pendidikan
    'pendidikan_terakhir.max' => 'Pendidikan terakhir maksimal 50 karakter.',

    // Pekerjaan
    'pekerjaan.max' => 'Pekerjaan maksimal 50 karakter.',

    // Kewarganegaraan
    'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
    'kewarganegaraan.in' => 'Kewarganegaraan harus WNI atau WNA.',

    // Disabilitas
    'disabilitas.boolean' => 'Disabilitas harus bernilai Ya atau Tidak.',
]);
$rt = str_pad((int) $request->rt, 2, '0', STR_PAD_LEFT);
$rw = str_pad((int) $request->rw, 2, '0', STR_PAD_LEFT);

            // Simpan ke database
            Data::create([
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
                'rt' => $rt,
                'rw' => $rw,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'golongan_darah' => $request->golongan_darah,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'status_keluarga' => $request->status_keluarga,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'pekerjaan' => $request->pekerjaan,
                'kewarganegaraan' => $request->kewarganegaraan,
                'disabilitas' => (bool) $request->disabilitas,
            ]);

            // Redirect kembali ke halaman utama
            return redirect()->route('admin.data.index')->with('success', 'Data berhasil disimpan.');


        }

public function update(Request $request, $id)
{
$rt = $request->filled('rt') ? str_pad((int) $request->rt, 2, '0', STR_PAD_LEFT) : null;
$rw = $request->filled('rw') ? str_pad((int) $request->rw, 2, '0', STR_PAD_LEFT) : null;


    $data = Data::findOrFail($id);

    $request->validate([
    'nik' => ['required', 'min:16', 'max:16', Rule::unique('data')->ignore($data->id)],
    'no_kk' => 'required|min:16|max:16',
    'nama_lengkap' => 'required|min:1|max:100',
    'alamat' => 'required|max:100',
    'rt' => 'nullable|digits_between:1,3',
    'rw' => 'nullable|digits_between:1,3',
    'tempat_lahir' => 'required|string|max:50',
    'tanggal_lahir' => 'required|date_format:Y-m-d',
    'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
    'golongan_darah' => ['nullable', Rule::in(['A', 'B', 'AB', 'O', '-'])],
    'agama' => 'nullable|max:20',
    'status_perkawinan' => ['required', Rule::in(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])],
    'status_keluarga' => 'nullable|max:30',
    'pendidikan_terakhir' => 'nullable|max:50',
    'pekerjaan' => 'nullable|max:50',
    'kewarganegaraan' => ['required', Rule::in(['WNI', 'WNA'])],
    'disabilitas' => 'nullable|boolean',
], [
    // NIK
    'nik.required' => 'NIK wajib diisi.',
    'nik.min' => 'NIK harus terdiri dari 16 digit.',
    'nik.max' => 'NIK tidak boleh lebih dari 16 digit.',
    'nik.unique' => 'NIK sudah digunakan oleh penduduk lain.',

    // No KK
    'no_kk.required' => 'No KK wajib diisi.',
    'no_kk.min' => 'No KK harus terdiri dari 16 digit.',
    'no_kk.max' => 'No KK tidak boleh lebih dari 16 digit.',

    // Nama
    'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
    'nama_lengkap.min' => 'Nama lengkap minimal 1 karakter.',
    'nama_lengkap.max' => 'Nama lengkap maksimal 100 karakter.',

    // Alamat
    'alamat.required' => 'Alamat wajib diisi.',
    'alamat.max' => 'Alamat maksimal 100 karakter.',

    // RT RW
    'rt.digits_between' => 'RT harus berupa angka 1 sampai 3 digit.',
    'rw.digits_between' => 'RW harus berupa angka 1 sampai 3 digit.',

    // Tempat Lahir
    'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
    'tempat_lahir.max' => 'Tempat lahir maksimal 50 karakter.',

    // Tanggal Lahir
    'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
    'tanggal_lahir.date_format' => 'Format tanggal lahir harus YYYY-MM-DD.',

    // Jenis Kelamin
    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
    'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',

    // Golongan darah
    'golongan_darah.in' => 'Golongan darah tidak valid.',

    // Agama
    'agama.max' => 'Agama maksimal 20 karakter.',

    // Status Perkawinan
    'status_perkawinan.required' => 'Status perkawinan wajib diisi.',
    'status_perkawinan.in' => 'Status perkawinan tidak valid.',

    // Status Keluarga
    'status_keluarga.max' => 'Status keluarga maksimal 30 karakter.',

    // Pendidikan
    'pendidikan_terakhir.max' => 'Pendidikan terakhir maksimal 50 karakter.',

    // Pekerjaan
    'pekerjaan.max' => 'Pekerjaan maksimal 50 karakter.',

    // Kewarganegaraan
    'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
    'kewarganegaraan.in' => 'Kewarganegaraan harus WNI atau WNA.',

    // Disabilitas
    'disabilitas.boolean' => 'Disabilitas harus bernilai Ya atau Tidak.',
]);

    $data->update([
        'nik' => $request->nik,
        'no_kk' => $request->no_kk,
        'nama_lengkap' => $request->nama_lengkap,
        'alamat' => $request->alamat,
        'rt' => $rt,
        'rw' => $rw, 
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'golongan_darah' => $request->golongan_darah,
        'agama' => $request->agama,
        'status_perkawinan' => $request->status_perkawinan,
        'status_keluarga' => $request->status_keluarga,
        'pendidikan_terakhir' => $request->pendidikan_terakhir,
        'pekerjaan' => $request->pekerjaan,
        'kewarganegaraan' => $request->kewarganegaraan,
        'disabilitas' => (bool) $request->disabilitas,
    ]);

    return redirect()->route('admin.data.index')->with('success', 'Data berhasil diperbarui.');
}
    // Tampilkan form edit data
   public function edit($id)
{
    $data = Data::findOrFail($id); // ambil data berdasarkan ID

    return view('admin.data.edit', compact('data'));
}


    // Hapus data berdasarkan ID
    public function destroy($id)
    {
        $data = Data::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.data.index')->with('success', 'Data berhasil dihapus.');
    }



public function export()
{
    $query = Data::query();

    if (request('rt')) {
        $query->where('rt', request('rt'));
    }

    if (request('rw')) {
        $query->where('rw', request('rw'));
    }
    if (request('golongan_darah')) {
    $query->where('golongan_darah', request('golongan_darah'));
    }


    if (request('search')) {
        $search = request('search');
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
              ->orWhere('nik', 'like', "%$search%")
              ->orWhere('no_kk', 'like', "%$search%")
              ->orWhere('nama_lengkap', 'like', "%$search%")
              ->orWhere('alamat', 'like', "%$search%")
              ->orWhere('rt', 'like', "%$search%")
              ->orWhere('rw', 'like', "%$search%")
              ->orWhere('tempat_lahir', 'like', "%$search%")
              ->orWhere('tanggal_lahir', 'like', "%$search%")
              ->orWhere('jenis_kelamin', 'like', "%$search%")
              ->orWhere('golongan_darah', 'like', "%$search%")
              ->orWhere('agama', 'like', "%$search%")
              ->orWhere('status_perkawinan', 'like', "%$search%")
              ->orWhere('status_keluarga', 'like', "%$search%")
              ->orWhere('pendidikan_terakhir', 'like', "%$search%")
              ->orWhere('pekerjaan', 'like', "%$search%")
              ->orWhere('kewarganegaraan', 'like', "%$search%")
              ->orWhere('disabilitas', 'like', "%$search%")
              ->orWhere('created_at', 'like', "%$search%")
              ->orWhere('updated_at', 'like', "%$search%");
        });
    }


    $data = $query->orderBy('nama_lengkap')->get()->values();
    $filename = 'data_penduduk_' . now()->format('Ymd_His') . '.xlsx';

    if ($data->isEmpty()) {
        return redirect()->back()->with('export_empty', 'Data tidak ditemukan, silakan periksa filter atau pencarian.');
    }

    return (new \Rap2hpoutre\FastExcel\FastExcel($data))->download($filename, function ($row) use ($data) {
        $index = $data->search($row) + 1;
        return [
            'No' => $index,
            'NIK' => $row->nik,
            'No KK' => $row->no_kk,
            'Nama Lengkap' => $row->nama_lengkap,
            'Alamat' => $row->alamat,
            'RT' => $row->rt,
            'RW' => $row->rw,
            'Tempat Lahir' => $row->tempat_lahir,
            'Tanggal Lahir' => $row->tanggal_lahir ? \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') : '',
            'Jenis Kelamin' => $row->jenis_kelamin,
            'Gol. Darah' => $row->golongan_darah,
            'Agama' => $row->agama,
            'Status Perkawinan' => $row->status_perkawinan,
            'Status Keluarga' => $row->status_keluarga,
            'Pendidikan Terakhir' => $row->pendidikan_terakhir,
            'Pekerjaan' => $row->pekerjaan,
            'Kewarganegaraan' => $row->kewarganegaraan,
            'Disabilitas' => $row->disabilitas ? 'Ya' : 'Tidak',
        ];
    });
}

}
