<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('jabatan')->latest()->get();

        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:users,nip',
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
            'kd_jabatan' => 'required'
        ]);

        try {
            $user = User::create([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
                'kd_jabatan' => $request->kd_jabatan
            ]);

            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data perawat berhasil ditambahkan.',
                    'data' => $user
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Data perawat tidak ditemukan.'
            ], 404);
        }

        return new UserResource($user);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Data perawat tidak ditemukan.'
            ], 404);
        }

        $this->validate($request, [
            'nama' => 'required|string',
            'nip' => 'required|string|unique:users,nip'
        ]);

        $user->nama = $request->nama;
        $user->nip = $request->nip;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tgl_lahir = $request->date('tgl_lahir', 'd-m-Y');
        $user->jns_kelamin = $request->jns_kelamin;
        $user->golongan = $request->golongan;
        $user->kd_jabatan = $request->kd_jabatan;

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Data perawat berhasil diupdate.'
        ]);
    }

    public function passwordChange(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'new_password' => ['required', 'confirmed', Password::defaults()]
        ]);

        $user = User::find((int)$request->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password lama yang anda masukkan tidak valid.'
            ], 422);
        }

        $user->password = Hash::make($request->new_password);

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password berhasil diubah, silahkan login ulang.'
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Data perawat tidak ditemukan.'
            ], 404);
        }

        $user->delete();

        return response()->json([], 204);
    }
}
