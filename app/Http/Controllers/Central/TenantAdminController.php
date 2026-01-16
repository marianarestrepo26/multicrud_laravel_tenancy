<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class TenantAdminController extends Controller
{
    public function index(Tenant $tenant)
    {
        $users = $tenant->run(function () {
            return User::all();
        });
        return view('central.tenants.admins.index', compact('tenant', 'users'));
    }

    public function create(Tenant $tenant)
    {
        return view('central.tenants.admins.create', compact('tenant'));
    }

    public function store(Request $request, Tenant $tenant)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'], // Unique validation needs care
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Validate unique email inside tenant context
        $emailExists = $tenant->run(function () use ($request) {
            return User::where('email', $request->email)->exists();
        });

        if ($emailExists) {
            return back()->withErrors(['email' => 'El correo ya está registrado en este tenant.'])->withInput();
        }

        $tenant->run(function () use ($request) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        });

        return redirect()->route('tenants.admins.index', $tenant->id)->with('success', 'Administrador de tenant creado correctamente.');
    }

    public function edit(Tenant $tenant, $userId)
    {
        $admin = $tenant->run(function () use ($userId) {
            return User::findOrFail($userId);
        });
        return view('central.tenants.admins.edit', compact('tenant', 'admin'));
    }

    public function update(Request $request, Tenant $tenant, $userId)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $tenant->run(function () use ($request, $tenant, $userId) {
            $user = User::findOrFail($userId);

            // Check unique email excluding current user
            if (User::where('email', $request->email)->where('id', '!=', $userId)->exists()) {
                // Throw validation exception or handle manually
                abort(422, 'El email ya existe');
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $request->validate([
                    'password' => ['confirmed', Rules\Password::defaults()],
                ]);
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }
        });

        return redirect()->route('tenants.admins.index', $tenant->id)->with('success', 'Administrador actualizado correctamente.');
    }

    public function destroy(Tenant $tenant, $userId)
    {
        $tenant->run(function () use ($userId) {
            User::findOrFail($userId)->delete();
        });
        return redirect()->route('tenants.admins.index', $tenant->id)->with('success', 'Administrador eliminado correctamente.');
    }
}
