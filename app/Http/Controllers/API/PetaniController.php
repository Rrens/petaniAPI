<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\petanis;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = petanis::all();
        // $data = petanis::getPetani()->get();
        $data = petanis::getPetani()->get();
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_petani' => 'required',
            'nik' => 'required|numeric',
            'alamat' => '',
            'telp' => 'required',
            'foto' => 'file|mimes:jpeg,png,jpg',
            'id_kelompok_jenis' => 'required',
            'status' => ''
        ]);
        try {
            $filename = time() . $request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('public/petani', $filename);
            $validasi['foto'] = $path;
            $response = petanis::create($validasi);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            // return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Err',
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama_petani' => 'required',
            'nik' => 'required|numeric',
            'alamat' => '',
            'telp' => 'required',
            'foto' => '',
            'id_kelompok_jenis' => 'required',
            'status' => ''
        ]);
        try {
            if ($request->file('foto')) {
                $filename = time() . $request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('public/petani', $filename);
                $validasi['foto'] = $path;
            }
            $response = petanis::find($id)->update($validasi);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diubah',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            // return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Err',
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
