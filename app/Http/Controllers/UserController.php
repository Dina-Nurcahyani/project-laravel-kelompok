<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function home()
    {
        $totalUser = User::count();
        $totalPasien = Pasien::count();

        $status = [
            'Rawat Jalan' => Pasien::where('status', 'Rawat Jalan')->count(),
            'Rawat Inap' => Pasien::where('status', 'Rawat Inap')->count(),
            'Rujuk Keluar' => Pasien::where('status', 'Rujuk Keluar')->count(),
        ];

        $gender = [
            'Laki-laki' => Pasien::where('jenis_kelamin', 'L')->count(),
            'Perempuan' => Pasien::where('jenis_kelamin', 'P')->count(),
        ];


        return view('home', compact('totalUser', 'totalPasien', 'status', 'gender'));
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Nama atau password salah.',
        ])->onlyInput('password');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'password' => $request->password,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function data()
    {
        $pegawai = User::query();

        return DataTables::of($pegawai)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
    <a href="' . route('pegawai.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
    <form action="' . route('pegawai.destroy', $row->id) . '" method="POST" style="display:inline;">
        ' . csrf_field() . method_field('DELETE') . '
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Hapus?\')">Hapus</button>
    </form>
    ';
            })
            ->rawColumns(['aksi']) // agar gambar dan tombol tidak di-escape
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
        $pegawai = User::all(); // ambil semua data user

        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',

        ]);

        User::create([
            'name' => $request->name,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
        $pegawai = User::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'role' => 'sometimes|in:admin,user',
            'old_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);

        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }

        if ($request->filled('role')) {
            $data['role'] = $request->role;
        }

        if ($request->filled('password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama salah']);
            }

            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('pegawai.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        $user->delete();
        return redirect()->route('pegawai.index')->with('success', 'User berhasil dihapus.');
    }
}
