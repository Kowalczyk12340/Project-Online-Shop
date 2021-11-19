<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller 
{
    public function index()
    {
        $users = User::all();
        return view('user.users', compact('users'));
    }

    public function create()
    {
        $edit = false;
        $roles = Role::all();
        return view('user.create', compact('edit','roles'));
    }

    public function show(User $user)
    {
        return view('user.create', compact('user'));
    }

    public function store(Request $r)
    {
        $user = new User();
        $user->name = $r->name();
        $user->surname = $r->surname;
        $user->email = $r->email;
        $user->password = Hash::make($r->password);
        $user->assignRole($r->role);
        $user->street = $r->street;
        $user->house_number = $r->house_number;
        $user->apartment_number = $r->apartment_number;
        $user->postcode  = $r->postcode;
        $user->town = $r->town;
        $user->phone_number = $r->phone_number;
        $user->photo = $r->photo;
        $user->save();

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        $edit = true;
        $roles = Role::all();
        return view('user.create', compact('user', 'edit','roles'));
    }

    public function update(Request $r, User $user)
    {
        $user = User::findOrFail($user->id);
        $user->name = $r->name;
        $user->surname = $r->surname;
        $user->role_id = $r->role_id;
        $user->email = $r->email;
        $user->assignRole($r->role);
        $user->street = $r->street;
        $user->house_number = $r->house_number;
        $user->apartment_number = $r->apartment_number;
        $user->postcode = $r->postcode;
        $user->town = $r->town;
        $user->phone_number = $r->phone_number;
        if($r->photo != null){
            $file = $r->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public/user/photos', $filename);
            $user->photo = '/storage/user/pgotos/' . $filename;
        }
        else{
            $user->photo = $user->photo;
        }
        $user->save();
        return redirect()->route('user.index');
    }

    public function delete(User $user)
    {
        $user = User::findOrFail($user->id);
        $user->delete();
        return redirect()->route('user.index');
    }
}