<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;

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
