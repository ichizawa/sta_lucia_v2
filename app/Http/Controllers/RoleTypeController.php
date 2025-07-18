<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleType;

class RoleTypeController extends Controller
{

    public function adminRoles() {
        $roles = RoleType::all(); // 
    return view('admin.roles', compact('roles'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
        
        RoleType::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);
        
        // Redirect back with success
        return redirect()->back()->with('success', 'Role Type added successfully!');
    }
    
    public function index()
    {
        $roles = RoleType::all();
        return view('admin.roles.index', compact('roles'));
    }
    
    

public function destroy(Request $request)
{
    $roleType = RoleType::find($request->id);

    if (!$roleType) {
        return response()->json(['error' => 'Role type not found'], 404);
    }

    $roleType->delete();

    return response()->json(['success' => 'Role type deleted successfully']);
}






    // CREATE
    //public function store(Request $request)
    //{
      //  RoleType::create($request->all());
      //  return redirect()->back()->with('success', 'Role Type created successfully!');
   // }

    // UPDATE
   // public function update(Request $request, $id)
   // {
      //  $role = RoleType::findOrFail($id);
      //  $role->update($request->all());
      //  return redirect()->back()->with('success', 'Role Type updated successfully!!');
    //}

    // DELETE
    //public function destroy($id)
    //{
        //RoleType::destroy($id);
        //return redirect()->back()->with('success', 'Role deleted successfully!!');
    //}
}
