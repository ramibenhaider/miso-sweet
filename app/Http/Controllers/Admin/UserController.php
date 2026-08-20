<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')->where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Toggle status of user.
     */
    public function toggleStatus(User $user)
    {
        if ($user->is_active == true) {
            $user->is_active = false;
        } else {
            $user->is_active = true;
        }
        $user->save();
        return redirect()->back()->with('success', 'تم تغيير حالة المستخدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->picture && Storage::disk('public')->exists($user->picture)) {
            Storage::disk('public')->delete($user->picture);
        }
        $user->delete();
        return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح');
    }
}
