<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        return User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }

   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name'  => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'role'  => 'required',
    ]);

    $user->update($request->only(['name', 'email', 'role']));

    return response()->json([
        'message' => 'User updated successfully',
        'user' => $user
    ]);
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
