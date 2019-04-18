<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use App\Models\{Module, RoleDefaultPermissions};
use Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('view.privilegios')) {
            return abort(403, 'Unauthorized action.');
        }

        $roles=Role::all();
        
        return view('admin.roles.index', compact('roles'));
    }

    public function grant($id, $permission)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::findOrFail($permission);

        $hasPermission = RoleDefaultPermissions::where('role_id', $role->id)
        ->where('permission_id', $permission->id)
        ->get()->first();

        if(!$hasPermission) {
            RoleDefaultPermissions::create([
                'role_id' => $role->id,
                'permission_id' => $permission->id,
            ]);
        }

        return response()->json([
          'success' => true,
          'message' => 'Permissão concedida com sucesso.'
        ]);
    }

    public function revoke($id, $permission)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::findOrFail($permission);

        $hasPermission = RoleDefaultPermissions::where('role_id', $role->id)
        ->where('permission_id', $permission->id)
        ->get()->first();

        $hasPermission->delete();

        return response()->json([
          'success' => true,
          'message' => 'Permissão revogada com sucesso.'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermission('view.privilegios')) {
            return abort(403, 'Unauthorized action.');
        }

        $role = Role::findOrFail($id);
        $permissions=Permission::all();
        $modules = Module::all();

        return view('admin.roles.permissions', compact('role', 'permissions', 'modules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
