<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // create permission
    public function store(Request $request)
    {
        $request->validate([
            'date_permission' => 'required',
            'reason' => 'required',
        ]);

        $permission = new Permission();
        $permission->user_id = $request->user()->id;
        $permission->date_permission = $request->date_permission;
        $permission->reason = $request->reason;
        $permission->is_approved = 0;

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('image');
            $image->storeAs('public/permissions', $image->hashName());

            $permission->image = $image->hashName();
        }

        $permission->save();

        return response(['message' => 'Permission created successfully', 'permission' => $permission], 201);
    }
}
