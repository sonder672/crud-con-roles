<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    function __construct() {
    $this->middleware('permission:showRol|createRol|editRol|deleteRol', 
    ['only' => ['index']]);
    $this->middleware('permission:createRol', ['only' => ['create', 'store']]);
    $this->middleware('permission:editRol', ['only' => ['edit', 'update']]);
    $this->middleware('permission:deleteRol', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles/index', compact('roles'));
    }

    public function create()
    {
        $permission =  Permission::get();
        return view('roles/create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'permission' => 'required']);
        $roles = Role::create(['name' => $request->input('name')]);
        //Sincronizar permisos.
        $roles->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $roles = Role::find($id);
        $permission = Permission::get();
        $rolesPermissions = DB::table('role_has_permissions')
                            ->where('role_id', $id)
                            ->pluck('permission_id')
                            ->all();
        return view('roles/edit', compact('roles', 'permission', 'rolesPermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required', 'permission' => 'required']);
        $roles = Role::find($id);
        $roles->name = $request->input('name');
        $roles->save();
        //Sincronizar permisos.
        $roles->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        DB::table('roles')
        ->where('id', $id)
        ->delete();
        return redirect()->route('roles.index');
    }
}
