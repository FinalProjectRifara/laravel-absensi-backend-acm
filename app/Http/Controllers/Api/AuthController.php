<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $loginData['email'])->first();

        // Check user exist
        // if (!$user) {
        //     return response([
        //         'message' => 'User not found'
        //     ], 401);
        // }

        if(!$user) {
            return response()->json([
                'meesage' => 'User not found.'
            ], 401);
        }

        // Check Password
        if (!Hash::check($loginData['password'], $user->password)) {
            return response()->json( [
                'message'=> 'Password mismatched / invalid password'
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    // Log Out
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            'message' => 'Logout successfully'
        ], 200);
    }

    // Update image absensi profile & face_embedding
    public function updateProfile(Request $request)
    {
        $request->validate([
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'face_embedding' => 'required',
        ]);

        $user = $request->user();
        // $image = $request->file('image');
        $face_embedding = $request->face_embedding;

        //save image
        // $image->storeAs('public/images', $image->hashName());
        // $user->image_url = $image->hashName();
        $user->face_embedding = $face_embedding;
        $user->save();

        return response([
            'message' => 'Profile updated',
            'user' => $user,
        ], 200);
    }

        // Update firebase cloud messaging (fcm_token)
        public function updateFcmToken(Request $request){
            // Validate the request
            $validated = $request->validate([
                'fcm_token' => 'required',
            ]);

            $user = $request->user();
            $user -> fcm_token = $request->fcm_token;
            $user->save();

            return response()->json([
                'message' => 'FCM Token updated',
            ], 200);
        }
}
