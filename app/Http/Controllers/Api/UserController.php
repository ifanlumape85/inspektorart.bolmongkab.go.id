<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $items = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Irban');
            }
        )->get();

        $response = [
            'code' => 1,
            'message' => 'Sukses',
            'users' => $items->toArray()
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'photo' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => 'Lengkapi form'
            ];
            return response()->json($validator->errors(), 422);
        }

        try {
            if ($request->photo) {
                $image = $request->photo;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(60) . '.png';
                Storage::disk('local')->put('/public/assets/photo/' . $imageName, base64_decode($image));

                $user = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'photo' => 'assets/photo/' . $imageName
                ];
            } else {
                $user = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ];
            }

            User::create($user);

            $response = [
                'code' => '1',
                'status' => 'success',
                'message' => 'success'
            ];

            return response()->json($response, 201);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'code' => '2',
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:users,id'],
            'nik' => ['required', 'unique:users,nik,' . $request->id],
            'nama' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . $request->id],
            'telpon' => ['required', 'unique:users,telpon,' . $request->id],
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $response = [
                'code' => '2',
                'status' => false,
                'message' => $error
            ];
            return response()->json($response, 422);
        }

        try {
            $user = User::findOrFail($request->id);

            $profile_photo_path = '';
            if ($request->photo) {
                Storage::delete($user->photo);
                $image = $request->photo;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(60) . '.png';
                $profile_photo_path = 'assets/photo/' . $imageName;
                Storage::disk('local')->put('/public/assets/photo/' . $imageName, base64_decode($image));

                $user->photo = 'assets/photo/' . $imageName;
            }

            $user->name = $request->nama;
            $user->email = $request->email;
            $user->telpon = $request->telpon;
            $user->nik = $request->nik;
            $user->update();

            $response = [
                'code' => '1',
                'status' => true,
                'message' => 'Sukses',
                'profile_photo_path' => $profile_photo_path
            ];

            return response()->json($response, 201);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'code' => '2',
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => $validator->errors()->first()
            ];
            return response()->json($response, 422);
        }

        try {

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                $response = [
                    'code' => '2',
                    'status' => false,
                    'message' => 'Unauthorized.'
                ];
                return response()->json($response, 422);
            }

            $user = User::where('email', $request->email)->first();
            $user->getRoleNames();

            if (!Hash::check($request->password, $user->password, [])) {
                $response = [
                    'code' => '2',
                    'status' => false,
                    'message' => 'Invalid Credentials.'
                ];
                return response()->json($validator->errors(), 422);
            }

            $rememberToken = Str::random(60);
            $user->remember_token = $rememberToken;
            $user->update();

            $response = [
                'code' => '1',
                'message' => 'Sukses',
                'status' => true,
                'users' => [$user]
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'code' => '2',
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'status' => false,
                'message' => 'Yah, maaf masih gagal logout.'
            ];
            return response()->json($validator->errors(), 422);
        }

        try {
            $user = User::findOrFail($request->id);
            $user->remember_token = "";
            $user->update();
            $response = [
                'code' => '1',
                'message' => 'Sukses',
                'status' => true,
                'token' => ""
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'code' => '2',
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }
}
