<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $user
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found'], 404);
        }
        $rules = [
            'description' => 'required',
            'lat' => 'required',
            'longi' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Failed to update data', 'errors' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->description = $request->description;
        $user->lat = $request->lat;
        $user->longi = $request->longi;

        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->hasFile('image')) {
            $userName = $request->filled('name') ? $request->name : $user->name;
            $filename = $userName . '_' . time();
            $extension = $request->file('image')->extension();
            $image = $filename . '.' . $extension;
            if ($user->image) {
                Storage::delete('users/' . $user->image);
            }
            $request->file('image')->storeAs('users', $image);
            $user->image = $image;
        }
        $user->save();
        return response()->json(['status' => true, 'message' => 'User updated successfully']);
    }
}
