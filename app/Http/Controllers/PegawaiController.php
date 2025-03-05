<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Yajra\DataTables\Facades\DataTables;



class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.index');
    }

    public function data(Request $request)
    {
        $query = Pegawai::query();

        if ($request->filled('search.value')) {
            $search = $request->input('search.value');
            $query->where('nama', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }

        if ($request->filled('jabatan')) {
            $query->where('jabatan', $request->input('jabatan'));
        }

        return DataTables::of($query)->make(true);
    }


    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:pegawais,email',
                'jabatan' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'foto' => 'nullable|image|max:2048'
            ]);

            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('pegawai', 'public');
            }

            Pegawai::create($data);

            return response()->json(['success' => true, 'message' => 'Pegawai berhasil ditambahkan']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
    }
    public function getPegawaiData(Request $request)
    {
        $query = Pegawai::query();

        // Filtering Jabatan
        if ($request->has('jabatan') && $request->jabatan != '') {
            $query->where('jabatan', $request->jabatan);
        }

        return Datatables()->of($query)
            ->addColumn('foto', function ($pegawai) {
                return $pegawai->foto ? '<img src="' . asset('storage/' . $pegawai->foto) . '" width="50"/>' : '<img src="' . asset('storage/pegawai/th.jpeg') . '" width="50"/>';
            })
            ->rawColumns(['foto'])
            ->make(true);
    }
}
