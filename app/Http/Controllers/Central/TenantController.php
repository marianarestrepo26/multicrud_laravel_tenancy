<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        return view('central.tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('central.tenants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:tenants|max:255',
            'name' => 'required|string|max:255',
            'domain' => 'required|string|unique:domains,domain|max:255',
            'type' => 'required|string|max:255',
        ]);

        $tenant = Tenant::create([
            'id' => $validated['id'],
            'name' => $validated['name'],
            'type' => $validated['type'],
            'status' => true,
        ]);

        $tenant->domains()->create([
            'domain' => $validated['domain']
        ]);

        return redirect()->route('tenants.index')->with('success', 'Tenant created successfully.');
    }

    public function edit(Tenant $tenant)
    {
        return view('central.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        $tenant->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'status' => $request->has('status'),
        ]);

        return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully.');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->domains()->delete();
        $tenant->delete();
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
    }
}
