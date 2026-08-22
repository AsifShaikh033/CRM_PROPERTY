<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class ManageUserController extends Controller
{
   public function list(){
         $user = User::whereNot('email', 'admin@gmail.com')->get();
         $userType = 'User';

         return view('Admin.user.list',compact('user', 'userType'));
     }
     public function agentList()
    {
        $user = User::with('roles')
            ->where('email', '!=', 'admin@gmail.com')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Agent')
                    ->where('guard_name', 'web');
            })
            ->orderBy('id', 'desc')
            ->get();
            $userType = 'Agent';

        return view('Admin.user.list', compact('user', 'userType'));
    }
    public function ownerList()
    {
        $user = User::with('roles')
            ->where('email', '!=', 'admin@gmail.com')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Owner')
                    ->where('guard_name', 'web');
            })
            ->orderBy('id', 'desc')
            ->get();
            $userType = 'Owner';

        return view('Admin.user.list', compact('user', 'userType'));
    }
    public function tenantList()
    {
        $user = User::with('roles')
            ->where('email', '!=', 'admin@gmail.com')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Tenant')
                    ->where('guard_name', 'web');
            })
            ->orderBy('id', 'desc')
            ->get();
            $userType = 'Tenant';

        return view('Admin.user.list', compact('user', 'userType'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'web')
            ->where('name', '!=', 'Admin')
            ->orderBy('name')
            ->get();

        return view('Admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'mob_number' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'role' => 'required|exists:roles,name',
            'profile' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mob_number = $request->mob_number;
        $user->address = $request->address;
        $user->city = $request->city;

        if ($request->hasFile('profile')) {
            $user->identity_image = $request->file('profile')->store('uploads/user/profile', 'public');
        }

        $user->save();

        $user->assignRole($request->role);

        return redirect()->route('admin.user.list')
            ->with('success', 'User created successfully and role assigned.');
    }


     public function editUser($id)
    {
        $Data = User::find($id);
        $roles = Role::where('guard_name', 'web')
            ->where('name', '!=', 'Admin')
            ->orderBy('name')
            ->get();
        return view('Admin.user.edit', compact('Data', 'roles'));
    }
    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'mob_number' => 'required|string|unique:users,mob_number,' . $id . '|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required|exists:roles,name',
            //'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = User::findOrFail($id);
        if ($request->hasFile('profile')) {
            if ($user->identity_image && Storage::exists('public/' . $user->identity_image)) {
                Storage::delete('public/' . $user->identity_image);
            }
            $folderPath = 'public/uploads/user/profile';
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
            }
        
            $user->identity_image = $request->file('profile')->store('uploads/user/profile', 'public');
        }
        

        $user->name = $request  ->name;
        $user->email =  $request->email;
        $user->address = $request->address;
        $user->mob_number = $request->mob_number;
        $user->city = $request->city;
        $user->save();
       
        $user->syncRoles([
            $request->role
        ]);

        return redirect()->route('admin.user.list')->with('success', 'User updated successfully!');
    }


    public function destroy(Request $request)
    {
        $userId = $request->input('user_id'); 
        $user = User::findOrFail($userId); 
        $user->delete();
        return redirect()->route('admin.user.list')->with('success', 'User deleted successfully.');
    }
    

}
