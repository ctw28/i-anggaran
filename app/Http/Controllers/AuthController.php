<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

// use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function check(Request $request)
    {

        $token = $request->header('Authorization');
        try {
            // Memeriksa validitas token
            $token = JWTAuth::parseToken()->authenticate();
            // Jika tidak ada pengecualian (exception), maka token valid

            return response()->json(['valid' => true]); // Atau lakukan tindakan lain sesuai kebutuhan
        } catch (TokenInvalidException $e) {
            // Tangkap pengecualian jika token tidak valid
            return response()->json(['valid' => false]); // Atau tindakan lain jika token tidak valid
        }
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        $data = [];
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $user = auth()->user();
            $role = [];
            foreach ($user->userRole as $index => $userRole) {
                $namaRole = $userRole->role->role_nama;
                $role[$index]['role'] = $namaRole;
                $role[$index]['is_default'] = $userRole->is_default;
                if ($namaRole === "user_organisasi") {
                    $role[$index]['organisasi']['id'] = $userRole->userOrganisasi->organisasi->id;
                    $role[$index]['organisasi']['nama_organisasi'] = $userRole->userOrganisasi->organisasi->organisasi_singkatan;
                } else {
                    // $organisasi = 
                    if ($namaRole == "admin")
                        $organisasi = "Administrator";
                    if ($namaRole == "spi")
                        $organisasi = "Admin SPI";
                    if ($namaRole == "keuangan")
                        $organisasi = "Admin Keuangan";
                    $role[$index]['organisasi'] = $organisasi;
                }
            }
            $organisasi = []; // Inisialisasi $organisasi sebagai array kosong

            $defaultRole = $user->userRole->where('is_default', true)->first()->role->role_nama;
            if ($defaultRole === "user_organisasi") {
                $organisasi['id'] = $user->userRole->where('is_default', true)->first()->userOrganisasi->organisasi->id;
                $organisasi['nama_organisasi'] = $user->userRole->where('is_default', true)->first()->userOrganisasi->organisasi->organisasi_singkatan;
                $namaLengkap = $user->userPegawai->pegawai->dataDiri->nama_lengkap;
                $nomorInduk = $user->userPegawai->pegawai->pegawai_nomor_induk;
            } else {
                if ($defaultRole == "admin")
                    $organisasi = "Administrator";
                if ($defaultRole == "spi")
                    $organisasi = "Admin SPI";
                if ($defaultRole == "keuangan")
                    $organisasi = "Admin Keuangan";
                $namaLengkap = $organisasi;
                $nomorInduk = "-";
            }
            $customData = [
                'organisasi' => $organisasi,
                'user_data' => [
                    'nama_lengkap' => $namaLengkap,
                    'nomor_induk' => $nomorInduk,
                ],
                'roles' => $role,
                'current_role' => $user->userRole->where('is_default', true)->first()->role->role_nama,
            ];

            // Membuat token dengan data tambahan di payload
            $token = JWTAuth::customClaims($customData)->fromUser($user);
        }
        // return auth()->attempt($credentials);
        return $this->respondWithToken($token);
    }

    public function switcRole(Request $request)
    {
        $validatedData = $request->validate([
            'switchRole' => 'required|string', // Pastikan ada informasi peran yang dikirim dari klien
        ]);
        $user = auth()->user();

        $userRoles = $user->userRole->pluck('role.role_nama')->toArray(); // Ambil daftar peran pengguna

        if (in_array($request->switchRole, $userRoles)) {
            // $newToken = JWTAuth::fromUser($user, ['role' => $validatedData['newRole']]);
            $user = auth()->user();
            $role = [];
            foreach ($user->userRole as $index => $userRole) {
                $namaRole = $userRole->role->role_nama;
                $role[$index]['role'] = $namaRole;
                $role[$index]['is_default'] = $userRole->is_default;
                if ($namaRole === "user_organisasi") {
                    // $role[$index]['organisasi'] = $userRole->userOrganisasi->organisasi->organisasi_singkatan;
                    $role[$index]['organisasi']['id'] = $userRole->userOrganisasi->organisasi->id;
                    $role[$index]['organisasi']['nama_organisasi'] = $userRole->userOrganisasi->organisasi->organisasi_singkatan;
                } else {
                    // $organisasi = 
                    if ($namaRole == "admin")
                        $organisasi = "Administrator";
                    if ($namaRole == "spi")
                        $organisasi = "Admin SPI";
                    if ($namaRole == "keuangan")
                        $organisasi = "Admin Keuangan";
                    $role[$index]['organisasi'] = $organisasi;
                }
            }
            $switchRole = $request->switchRole;
            $organisasi = []; // Inisialisasi $organisasi sebagai array kosong

            if ($switchRole === "user_organisasi") {
                foreach ($user->userRole as $roleSwitch) {
                    $namaRole = $roleSwitch->role->role_nama;
                    if ($namaRole === "user_organisasi") {
                        $organisasi['id'] = $roleSwitch->userOrganisasi->organisasi->id;
                        $organisasi['nama_organisasi'] = $roleSwitch->userOrganisasi->organisasi->organisasi_singkatan;
                    }
                }
                $namaLengkap = $user->userPegawai->pegawai->dataDiri->nama_lengkap;
                $nomorInduk = $user->userPegawai->pegawai->pegawai_nomor_induk;
            } else {
                if ($switchRole == "admin")
                    $organisasi = "Administrator";
                if ($switchRole == "spi")
                    $organisasi = "Admin SPI";
                if ($switchRole == "keuangan")
                    $organisasi = "Admin Keuangan";
                if ($user->userPegawai) {
                    $namaLengkap = $user->userPegawai->pegawai->dataDiri->nama_lengkap;
                    $nomorInduk = $user->userPegawai->pegawai->pegawai_nomor_induk;
                } else {
                    $namaLengkap = $organisasi;
                    $nomorInduk = "-";
                }
            }
            $customData = [
                'organisasi' => $organisasi,
                'user_data' => [
                    'nama_lengkap' => $namaLengkap,
                    'nomor_induk' => $nomorInduk,
                ],
                'roles' => $role,
                'current_role' => $validatedData['switchRole'],
            ];

            // Membuat token dengan data tambahan di payload
            $token = JWTAuth::customClaims($customData)->fromUser($user);
            // return response()->json(['newToken' => $newToken]);
            return $this->respondWithToken($token);
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 3600
        ]);
    }
}
