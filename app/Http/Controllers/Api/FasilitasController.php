<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facility = Fasilitas::select('users.name as name', 'facility.*')
            ->leftJoin('users', 'facility.id_user', '=', 'users.id_user')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $facility
        ], 200);
    }


    public function store(Request $request)
    {
        $rules = [
            'id_user' => 'required|exists:users,id_user',
            'lat' => 'required|numeric',
            'longi' => 'required|numeric',
            'type' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukan data',
                'errors' => $validator->errors(),
            ], 400);
        }

        $facility = Fasilitas::create([
            'id_user' => $request->id_user,
            'lat' => $request->lat,
            'longi' => $request->longi,
            'type' => $request->type,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukan data',
            'data' => $facility,
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $facility = Fasilitas::select('users.name as name', 'facility.*')
            ->leftJoin('users', 'facility.id_user', '=', 'users.id_user')
            ->find($id);

        if (!$facility) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $facility
            ], 200);
        }
    }


    public function update(Request $request, string $id)
    {
        $rules = [
            'id_user' => 'sometimes|exists:users,id_user',
            'lat' => 'sometimes|numeric',
            'longi' => 'sometimes|numeric',
            'type' => 'sometimes|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperbarui data',
                'errors' => $validator->errors(),
            ], 400);
        }


        $facility = Fasilitas::find($id);

        if (!$facility) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
        $facility->update([
            'id_user' => $request->id_user,
            'lat' => $request->lat,
            'longi' => $request->longi,
            'type' => $request->type,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Sukses memperbarui data',
        ], 200);
    }

    public function destroy(string $id)
    {
        $facility = Fasilitas::find($id);

        if (!$facility) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $facility->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
