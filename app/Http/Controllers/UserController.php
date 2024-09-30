<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Index
    public function index(Request $request)
    {
        // Search by name, pagination
        $users = DB::table('users')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    // Create
    public function create()
    {
        return view('pages.users.create');
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'position' => 'required',
            'department' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->position = $request->position;
        $user->department = $request->department;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Edit
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.users.edit', compact('user'));
    }

    // Show
    // public function show($id)
    // {
    //     $user = User::find($id);
    //     return view('pages.users.show', compact('user'));
    // }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'cuti' => 'required',
            'position' => 'required',
            'department' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->cuti = $request->cuti;
        $user->position = $request->position;
        $user->department = $request->department;
        $user->role = $request->role;

        // If password filled
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Destroy / Delete Data
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    // Update Data
    public function updateData(Request $request, $id)
    {
        // $user = Auth::user();
        // $user = Auth::user()($id);

        $data = $request->all();
        $user = User::findOrFail($id);

        $validator = Validator::make($data, [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'sometimes|string|max:18',
            // 'address' => 'sometimes|string|max:200',
            // 'roles' => 'sometimes|string',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // $user->update($data);
        $user->fill($request->only('name', 'email', 'phone',));
        $user->save();
        Log::info('User after update', ['user' => $user]);

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    // Tambahkan ini di dalam controller yang menangani dashboard
    public function dashboard()
    {
        // Hitung Total Staff
        $totalStaff = User::where('role', 'staff')->count();

        // Hitung total admin
        $totalAdmin = User::where('role', 'admin')->count();

        // Hitung total supervisor
        $totalSupervisor = User::where('role', 'supervisor')->count();

        return view('pages.dashboard', compact('totalStaff' , 'totalAdmin', 'totalSupervisor'));
    }
}
