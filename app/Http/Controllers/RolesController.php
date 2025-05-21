<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use App\Models\Groups;
use App\Models\PermissionModel;
use Exception;
use Illuminate\Http\Request;
use App\Services\Permission;
use App\Enums\RolePermissionLabels;
use Spatie\Permission\Models\Role;


class RolesController extends Controller
{

    public function rolesIndex()
    {

         if ($response = Permission::check('view_role')) {
             return $response;
         }

        $roles = Cache::flexible('roles', [432000, 604800], function () {
            return Role::all();
        });

        return view('panel.roles.index', [
            'roles' => $roles
        ]);
    }

    public function roleCreate()
    {

         if ($response = Permission::check('create_role')) {
             return $response;
         }

        $groups = Cache::flexible('groups', [432000, 604800], function () {
            return Groups::all();
        });

        $permissions = Cache::flexible('permissions', [432000, 604800], function () {
            return PermissionModel::all();
        });


        return view('panel.roles.create', [
            'groups' => $groups,
            'permissions' => $permissions
        ]);
    }

    public function roleStore(Request $request)
    {

         if ($response = Permission::check('create_role')) {
             return $response;
         }

        try {
            $request->validate([
                'roleName' => 'required|string',
                'permissions' => 'required|array',
            ]);

            if (Role::where('name', Purifier::clean($request->name))->exists()) {
                return back()->with('error', 'Role already exists');
            }

            $role = new Role();

            $role->name = Purifier::clean($request->roleName);
            $role->save();

            // sync permissions
            $role->syncPermissions($request->permissions);

            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function roleEdit($name)
    {

         if ($response = Permission::check('update_role')) {
             return $response;
         }

        $groups = Groups::all();

        // get permissions associated with the role
        $permissions = PermissionModel::all();

        $role = Role::where('name', $name)->first();


        $hasPermissions = $role->permissions()->get();

        return view('panel.roles.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'groups' => $groups,
            'hasPermissions' => $hasPermissions
        ]);
    }

    public function roleUpdate(Request $request)
    {

         if ($response = Permission::check('update_role')) {
             return $response;
         }

        try {

            $request->validate([
                'roleName' => 'required|string',
                'permissions' => 'required|array',
                'roleId' => 'required|integer',
            ]);

            $role = Role::find($request->roleId);
            $role->name = Purifier::clean($request->roleName);
            $role->save();

            // sync permissions
            $role->syncPermissions($request->permissions);


            // Clear old permissions cache
            Cache::delete('roles');

            // Repopulate the cache with the updated list of permissions
            Cache::flexible('roles', [1, 10], function () {
                return Role::all();
            });


            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }



    public function roleDelete(Request $request)
    {

         if ($response = Permission::check('delete_role')) {
             return $response;
         }

        $role = Role::where('id', $request->id)->first();
        $role->delete();

        // Clear old permissions cache
        Cache::delete('roles');

        // Repopulate the cache with the updated list of permissions
        Cache::flexible('roles', [1, 10], function () {
            return Role::all();
        });


        return back()->with('success', 'Role deleted successfully');
    }




    public function groupsIndex()
    {

         if ($response = Permission::check('view_groups')) {
             return $response;
         }

        $groups = Cache::flexible('groups', [432000, 604800], function () {
            return Groups::all();
        });

        return view('panel.groups.index', [
            'groups' => $groups
        ]);
    }


    public function groupStore(Request $request)
    {

         if ($response = Permission::check('create_group')) {
             return $response;
         }

        try {

            $request->validate([
                'name' => 'required|string',
            ]);

            if (Groups::where('name', Purifier::clean($request->name))->exists()) {
                return back()->with('error', 'Group already exists');
            }

            Groups::create([
                'name' => Purifier::clean($request->name),
            ]);

            // Clear old permissions cache
            Cache::delete('groups');

            // Repopulate the cache with the updated list of permissions
            Cache::flexible('groups', [1, 10], function () {
                return Groups::all();
            });

            return back()->with('success', 'Group created successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function groupUpdate(Request $request)
    {
         if ($response = Permission::check('update_group')) {
             return $response;
         }

        try {

            $request->validate([
                'name' => 'required|string',
            ]);

            if (Groups::where('name', Purifier::clean($request->name))->exists()) {
                return back()->with('error', 'Group already exists');
            }

            $group = Groups::find($request->id);
            $group->name = Purifier::clean($request->name);
            $group->save();

            // Clear old permissions cache
            Cache::delete('groups');

            // Repopulate the cache with the updated list of permissions
            Cache::flexible('groups', [1, 10], function () {
                return Groups::all();
            });

            return back()->with('success', 'Group updated successfully');
        } catch (Exeption $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function groupDelete(Request $request)
    {
         if ($response = Permission::check('delete_group')) {
             return $response;
         }

        $group = Groups::find($request->id);
        $group->delete();

        // Clear old permissions cache
        Cache::delete('groups');

        // Repopulate the cache with the updated list of permissions
        Cache::flexible('groups', [1, 10], function () {
            return Groups::all();
        });

        return back()->with('success', 'Group deleted successfully');
    }


    public function permissionsIndex()
    {

        // check permission
         if ($response = Permission::check('view_permission')) {
             return $response;
         }


        $permissions = PermissionModel::join('groups', 'groups.id', '=', 'permissions.group_id')
                ->select('permissions.id', 'permissions.name', 'permissions.label', 'permissions.group_id', 'groups.name as group_name')
                ->paginate(12);

        $groups = Groups::all();

        $labels = RolePermissionLabels::cases();


        return view('panel.permissions.index', [
            'permissions' => $permissions,
            'groups' => $groups,
            'labels' => $labels
        ]);
    }

    public function permissionStore(Request $request)
    {

         if($response = Permission::check('create_permission')){
             return $response;
         }


        try {

            $request->validate([
                'name' => 'required|string',
                'group_id' => 'required|integer',
                'label' => 'required|string',
            ]);

            if (PermissionModel::where('name', Purifier::clean($request->name))->exists()) {
                return back()->with('error', 'Permission already exists');
            }

            PermissionModel::create([
                'name' => Purifier::clean($request->name),
                'label' => Purifier::clean($request->label),
                'group_id' => Purifier::clean($request->group_id),
            ]);

            // Clear old permissions cache
            Cache::delete('permissions');

            // Repopulate the cache with the updated list of permissions
            Cache::flexible('permissions', [1, 10], PermissionModel::join('groups', 'groups.id', '=', 'permissions.group_id')
                ->select('permissions.id', 'permissions.name', 'permissions.label', 'permissions.group_id', 'groups.name as group_name')
                ->get());


            return back()->with('success', 'Permission created successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function permissionUpdate(Request $request)
    {
         if ($response = Permission::check('update_permission')) {
             return $response;
         }


        try {

            $request->validate([
                'name' => 'required|string',
                'group_id' => 'required|integer',
                'label' => 'required|string',
            ]);

            $permission = PermissionModel::find($request->id);

            // Check if any other permission with the same name exists (excluding current one)
            if (PermissionModel::where('name', Purifier::clean($request->name))
                ->where('id', '!=', $permission->id) // Ignore the current permission by ID
                ->exists()
            ) {
                return back()->with('error', 'Permission with this name already exists');
            }

            $permission->name = Purifier::clean($request->name);
            $permission->label = Purifier::clean($request->label);
            $permission->group_id = Purifier::clean($request->group_id);
            $permission->save();

            // Clear old permissions cache
            Cache::delete('permissions');

            // Repopulate the cache with the updated list of permissions
            Cache::flexible('permissions', [1, 10], PermissionModel::join('groups', 'groups.id', '=', 'permissions.group_id')
                ->select('permissions.id', 'permissions.name', 'permissions.label', 'permissions.group_id', 'groups.name as group_name')
                ->get());


            return back()->with('success', 'Permission updated successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function permissionDelete(Request $request)
    {
         if ($response = Permission::check('delete_permission')) {
             return $response;
         }

        $permission = PermissionModel::find($request->id);
        $permission->delete();

        // Clear old permissions cache
        Cache::delete('permissions');

        // Repopulate the cache with the updated list of permissions
        Cache::flexible('permissions', [1, 10], PermissionModel::join('groups', 'groups.id', '=', 'permissions.group_id')
            ->select('permissions.id', 'permissions.name', 'permissions.label', 'permissions.group_id', 'groups.name as group_name')
            ->get());

        return back()->with('success', 'Permission deleted successfully');
    }
}
