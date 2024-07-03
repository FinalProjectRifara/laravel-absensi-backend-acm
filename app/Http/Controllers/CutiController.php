<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class CutiController extends Controller
{
    //index
    public function index(Request $request)
    {
        $cutis = Cuti::with('user')
            ->when($request->input('name'), function ($query, $name) {
                $query->whereHas('user', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                });
            })->orderBy('id', 'desc')->paginate(10);
        return view('pages.cuti.index', compact('cutis'));
    }

    // View
    public function show($id)
    {
        $cuti = Cuti::with('user')->find($id);
        return view('pages.cuti.show', compact('cuti'));
    }

    // Edit
    public function edit($id)
    {
        $cuti = Cuti::find($id);
        return view('pages.cuti.edit', compact('cuti'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $cuti = Cuti::find($id);
        $cuti->is_approved = $request->is_approved;
        $str = $request->is_approved == 1 ? 'Disetujui' : 'Ditolak';
        $cuti->save();
        $this->sendNotificationToUser($cuti->user_id, 'Status Cuti Anda adalah ' . $str);
        return redirect()->route('cutis.index')->with('success', 'Cuti updated successfully');
    }

    // Destroy
    public function destroy($id)
    {
        $user = Cuti::find($id);
        $user->delete();

        return redirect()->route('cutis.index')->with('success', 'Cuti deleted successfully.');
    }

    public function sendNotificationToUser($userId, $message)
    {
        // Dapatkan FCM Token user dari tabel 'users'
        $user = User::find($userId);
        $token = $user->fcm_token;

        // Kirim notifikasi ke perangkat Android
        $messaging = app('firebase.messaging');
        $notification = Notification::create('Status cuti', $message);

        $message = CloudMessage::withTarget('token', $token)->withNotification($notification);

        $messaging->send($message);
    }
}
