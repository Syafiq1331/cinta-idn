<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;


class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data masukan
        $validatedData = $request->validate([
            'ID_Mahasiswa' => 'required|exists:mahasiswa,id',
            'Tanggal' => 'required|date',
            'Isi_Feedback' => 'required|string',
            'Tampilkan_Nama' => 'required|boolean',
        ]);

        // Simpan feedback ke database
        $feedback = Feedback::create($validatedData);

        return response()->json(['message' => 'Feedback berhasil disimpan'], 201);
    }

    public function index()
    {
        $feedback = Feedback::all();

        return response()->json($feedback, 200);
    }

    public function show($id)
    {
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json(['message' => 'Feedback tidak ditemukan'], 404);
        }

        return response()->json($feedback, 200);
    }

    public function update(Request $request, $id)
    {
        // Validasi data masukan
        $validatedData = $request->validate([
            'ID_Mahasiswa' => 'exists:mahasiswa,id',
            'Tanggal' => 'date',
            'Isi_Feedback' => 'string',
            'Tampilkan_Nama' => 'boolean',
        ]);

        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json(['message' => 'Feedback tidak ditemukan'], 404);
        }

        $feedback->update($validatedData);

        return response()->json(['message' => 'Data feedback berhasil diperbarui'], 200);
    }

    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json(['message' => 'Feedback tidak ditemukan'], 404);
        }

        $feedback->delete();

        return response()->json(['message' => 'Feedback berhasil dihapus'], 200);
    }
}
