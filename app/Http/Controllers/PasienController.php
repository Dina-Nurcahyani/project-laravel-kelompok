<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    public function data()
    {
        $produks = Pasien::query();

        return DataTables::of($produks)
            ->addIndexColumn()
            ->addColumn('gambar', function ($row) {
                return $row->gambar
                    ? '<img src="' . asset('storage/' . $row->gambar) . '" height="80">'
                    : 'Tidak ada';
            })
            ->addColumn('aksi', function ($row) {
                return '
                <a href="' . route('pasien.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                <form action="' . route('pasien.destroy', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Hapus?\')">Hapus</button>
                </form>
            ';
            })
            ->rawColumns(['gambar', 'aksi']) // agar gambar dan tombol tidak di-escape
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pasien.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nik' => 'required|integer',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'status' => 'required|in:Rawat Jalan,Rawat Inap,Rujuk Keluar',
            'tanggal_masuk' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('pasien', 'public'); // simpan ke storage/app/public/pasien
            $data['gambar'] = $gambar;
        }

        Pasien::create($data);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
        return view('pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nik' => 'required|integer',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'status' => 'required|in:Rawat Jalan,Rawat Inap,Rujuk Keluar',
            'tanggal_masuk' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pasien = Pasien::findOrFail($id);

        $data = $request->only(['name', 'nik', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'status', 'tanggal_masuk']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($pasien->gambar && Storage::disk('public')->exists($pasien->gambar)) {
                Storage::disk('public')->delete($pasien->gambar);
            }

            // Upload gambar baru
            $path = $request->file('gambar')->store('pasien', 'public');
            $data['gambar'] = $path;
        }

        $pasien->update($data);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);

        // Hapus gambar jika ada
        if ($pasien->gambar && Storage::disk('public')->exists($pasien->gambar)) {
            Storage::disk('public')->delete($pasien->gambar);
        }

        // Hapus pasien dari database
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
