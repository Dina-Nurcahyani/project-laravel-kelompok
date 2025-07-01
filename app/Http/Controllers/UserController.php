<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
