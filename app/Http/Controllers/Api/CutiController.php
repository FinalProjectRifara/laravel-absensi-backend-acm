<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    // Create
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'reason' => 'required',
        ]);

        $user = $request->user();

        // Check if user has enough cuti left
        if ($user->cuti <= 0) {
            return response()->json(['message' => 'No cuti left'], 400);
        }

        $cuti = new Cuti();
        $cuti->user_id = $user->id;
        $cuti->date_cuti = $request->date;
        $cuti->reason = $request->reason;
        $cuti->is_approved = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/cuti', $image->hashName());
            $cuti->image = $image->hashName();
        }

        $cuti->save();

        // Decrement user's cuti
        $user->cuti -= 1;
        $user->save();

        return response()->json([
            'message' => 'Cuti created successfully',
            'data' => $cuti,
        ], 201);
    }
}
