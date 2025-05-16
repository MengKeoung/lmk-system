<?php

namespace App\Http\Controllers\Backends;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('backends.role.index', compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::get()->groupBy(function ($data) {
            return $data->module;
        });
        return view('backends.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role_name = $request->input('name');
        $permissions = $request->input('permissions');

        $count = Role::where('name', $role_name)->count();
        if ($count == 0) {

            $role = new Role;
            $role->name = $role_name;
            $role->save();
            // return 2;
            $this->__createPermissionIfNotExists($permissions);

            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }

            $output = [
                'success' => 1,
                'msg' => __("Created Successfully!")
            ];

        } else {
            $output = [
                'success' => 0,
                'msg' => __("Something went wrong!")
            ];
        }

        return redirect()->route('admin.roles.index')->with($output);
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->find($id);
        $permissions = Permission::get()->groupBy(function ($data) {
            return $data->module;
        });
        $rolePermissions = [];
        foreach ($role->permissions as $rolePerm) {
            $rolePermissions[] = $rolePerm->name;
        }
        return view('backends.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role_name = $request->input('name');
        $permissions = $request->input('permissions'); // Can be null or an empty array

        $count = Role::where('name', $role_name)->where('id', '!=', $id)->count();
        if ($count == 0) {
            $role = Role::findOrFail($id);
            $role->name = $role_name;
            $role->save();

            $this->__createPermissionIfNotExists($permissions);

            // Sync permissions regardless of whether it's empty.
            $role->syncPermissions($permissions ?? []);

            $output = [
                'success' => 1,
                'msg' => __("Updated Successfully!")
            ];
        } else {
            $output = [
                'success' => 0,
                'msg' => __("Something went wrong!")
            ];
        }

        return redirect()->route('admin.roles.index')->with($output);
    }

    private function __createPermissionIfNotExists($permissions)
    {

        if (empty($permissions)) {
            return;
        }

        $exising_permissions = Permission::whereIn('name', $permissions)
            ->pluck('name')
            ->toArray();

        $non_existing_permissions = array_diff($permissions, $exising_permissions);
        if (!empty($non_existing_permissions)) {

            foreach ($non_existing_permissions as $new_permission) {
                $time_stamp = Carbon::now()->toDateTimeString();
                Permission::create([
                    'name' => $new_permission,
                    'guard_name' => 'web'
                ]);

            }
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $role = Role::findOrFail($id);
            $role->revokePermissionTo($role->permissions);
            $role->delete();

            // Retrieve updated roles list and re-render the table view
            $roles = Role::latest('id')->paginate(10);
            $view = view('backends.role._table', compact('roles'))->render();

            DB::commit();
            $output = [
                'status' => 1,
                'view' => $view,
                'msg' => __('Deleted Successfully!')
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $output = [
                'status' => 0,
                'msg' => __('Something went wrong!')
            ];
        }

        return response()->json($output);
    }
}
