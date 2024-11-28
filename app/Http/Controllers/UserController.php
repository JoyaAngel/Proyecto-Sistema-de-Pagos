<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', ['users' => User::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.register_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $validated['type'] = $validated['type'] == 'admin' ? 'a' : 'u';

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return back()->with('status', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('status', 'User deleted successfully');
    }

    public function passwordReset($id)
    {
        $user = User::find($id);

        $newPassword = Str::random(10);

        $user->update([
            'password' => Hash::make($newPassword),
            'must_change_password' => true
        ]);

        session()->flash('password', $newPassword);

        return back();
    }

    public function changePassword()
    {
        return view('users.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::find(Auth::user()->id);

        $user->update([
            'password' => Hash::make($request->password),
            'must_change_password' => false
        ]);

        return redirect()->route('index')->with('status', 'Password updated successfully');
    }
}
