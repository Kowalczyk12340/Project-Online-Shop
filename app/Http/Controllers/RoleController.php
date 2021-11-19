<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('welcome', compact('role'));
    }

    public function create()
    {

    }

    public function store(Request $r)
    {

    }

    public function edit(Role $role)
    {

    }

    public function update(Request $r, Role $role)
    {

    }

    public function delete(Role $role)
    {
        
    }
}
