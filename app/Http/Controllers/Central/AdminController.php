<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::all();
        return view('central.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('central.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admins.index')->with('success', 'Administrador creado correctamente.');
    }

    public function edit(User $admin)
    {
        return view('central.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',email,' . $admin->id],
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $admin->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admins.index')->with('success', 'Administrador actualizado correctamente.');
    }

    public function destroy(User $admin)
    {
        if (auth()->id() === $admin->id) {
            return back()->withErrors(['message' => 'No puedes eliminar tu propia cuenta.']);
        }
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Administrador eliminado correctamente.');
    }
}
