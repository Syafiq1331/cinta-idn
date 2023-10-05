<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function register(Request $request)
    {
        // Validasi data masukan
        $validatedData = $request->validate([
            'Nama' => 'required|string',
            'NIM' => 'required|string|unique:mahasiswa,NIM',
            'Jurusan' => 'required|string',
            'Tahun_Masuk' => 'nullable|integer',
        ]);

        // Simpan data mahasiswa ke database
        $mahasiswa = Mahasiswa::create($validatedData);

        return response()->json(['message' => 'Registrasi berhasil'], 201);
    }

    public function index()
    {
        $mahasiswa = Mahasiswa::all();

        return response()->json($mahasiswa, 200);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        return response()->json($mahasiswa, 200);
    }

    public function update(Request $request, $id)
    {
        // Validasi data masukan
        $validatedData = $request->validate([
            'Nama' => 'string',
            'NIM' => 'string|unique:mahasiswa,NIM,' . $id,
            'Jurusan' => 'string',
            'Tahun_Masuk' => 'integer',
        ]);

        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $mahasiswa->update($validatedData);

        return response()->json(['message' => 'Data mahasiswa berhasil diperbarui'], 200);
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $mahasiswa->delete();

        return response()->json(['message' => 'Mahasiswa berhasil dihapus'], 200);
    }
}
