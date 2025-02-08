<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:create')->only('create');
    }

    public function index()
    {
        $this->authorize('read');
        $roles = Role::orderBy('created_at', 'desc')->get();
        return view('masterdata.role.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masterdata.role.role-action', ['role' => new Role()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'approval_level' => 'nullable|integer|min:1',
        ]);

        Role::create($validate);

        return response()->json([
            'status' => 'success',
            'message' => 'Role Added Successfully'
        ]);
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
        $role = Role::findOrFail($id);

        return view('masterdata.role.role-action', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'approval_level' => 'nullable|integer|min:1',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
            'approval_level' => $request->approval_level,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Role Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully',
        ]);
    }
}