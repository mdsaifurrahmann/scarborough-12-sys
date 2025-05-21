<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;
use App\Services\Permission;

class UsersController extends Controller
{
    public function index()
    {

        // check permission
         if ($response = Permission::check('user_view')) {
             return $response;
         }

        $users = User::with('roles')->paginate(16)->fragment(hash('crc32', 'users'));

        $roles = Role::pluck('name');

        return view('panel.users.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {

        // check permission
        if ($response = Permission::check('user_create')) {
            return $response;
        }

        try {

            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|same:password',
                'role' => 'required',
                'phone' => 'string|nullable|min: 11|max:14',
                'status' => 'required|in:0,1',
                'profile_image' => 'nullable|image|max:2048',
            ]);

            $user = new User();

            $user->name = Purifier::clean($request->name);
            $user->email = Purifier::clean($request->email);
            $user->password = Hash::make($request->password);
            $user->status = Purifier::clean($request->status);
            $user->phone = Purifier::clean($request->phone);

            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $file_name = time() . Str::random(16) . '.' . Str::replace(' ', '-', $file->getClientOriginalExtension());
                Storage::disk('public')->putFileAs('users', $file, $file_name);
                $user->profile_image = $file_name;
            } else {
                $user->profile_image = null;
            }

            $user->save();

            // assign role to user
            $user->assignRole($request->role);

            // send email notification to user with deferred job
            defer(function () use ($user) {
                $user->sendEmailVerificationNotification();
            });


            return back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($email)
    {
        $user = User::where('email', $email)->first();
        $roles = Role::all();
        return view('panel.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request)
    {

        // check permission
        if ($response = Permission::check('user_update')) {
            return $response;
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'min:8|confirmed|nullable',
            'password_confirmation' => 'same:password|nullable',
            'role' => 'required',
            'phone' => 'string|nullable|min: 11|max:14',
            'status' => 'required|in:0,1',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        try {



            $user = User::find($request->id);

            $user->name = Purifier::clean($request->name);
            $user->email = Purifier::clean($request->email);
            $user->status = Purifier::clean($request->status);
            $user->phone = Purifier::clean($request->phone);

            if ($request->hasFile('profile_image')) {

                if ($user->profile_image) {
                    Storage::disk('public')->delete('users/' . $user->profile_image);
                }

                $file = $request->file('profile_image');
                $file_name = time() . Str::random(16) . '.' . Str::replace(' ', '-', $file->getClientOriginalExtension());
                Storage::disk('public')->putFileAs('users', $file, $file_name);
                $user->profile_image = $file_name;
            } else {
                $user->profile_image = $user->profile_image;
            }

            $user->save();

            // assign role to user
            if (!empty($request->role)) {
                $user->syncRoles($request->role);
            }


            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy(Request $request)
    {

        // check permission
        if ($response = Permission::check('user_delete')) {
            return $response;
        }

        $user = User::find($request->id);
        if ($user) {
            // delete files
            if ($user->profile_image) {
                Storage::disk('public')->delete('users/' . $user->profile_image);
            }

            // delete associated roles
            $user->roles()->detach();

            // delete user
            $user->delete();

            return back()->with('success', 'User deleted successfully');
        } else {
            return back()->with('error', 'User not found');
        }
    }
}
