<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('role-view'), only: ['index', 'show']),
            new Middleware(PermissionMiddleware::using('role-create'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('role-update'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('role-delete'), only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('pages.app.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('pages.app.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        try {
            $role = Role::create([
                'name' => $request->name,
            ]);

            $role->syncPermissions($request->permission);

            return redirect()->route('app.role.index')->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create role, ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);

        return view('pages.app.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);

        $permissions = Permission::all();

        return view('pages.app.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, string $id)
    {
        try {
            $role = Role::findOrFail($id);

            if ($role->name === 'admin' && $request->name !== 'admin') {
                return back()->with(['error' => 'You cannot update the name of the admin role.']);
            }

            $role->update([
                'name' => $request->name,
            ]);

            $role->syncPermissions($request->permission);

            return redirect()->route('app.role.index')->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);

            if ($role->name === 'admin') {
                return back()->with(['error' => 'You cannot delete the admin role.']);
            }

            $role->delete();

            return redirect()->route('app.role.index')->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
