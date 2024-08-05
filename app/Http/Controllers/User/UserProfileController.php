<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Alert;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Auth::user();
        return view('users.profile.index', compact('customer'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            // 'email' => 'required|unique:users,email',
            'password' => 'confirmed',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,jpeg,bmp,png',
        ]);
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;;
        $user->role = 'customer';
        $user->save();

        $user->customer()->updateOrCreate(["user_id" => $user->id], [
            "phone" => $request->phone,
            "address" => $request->address,
            "image" => $request->hasFile('image') ? $request->file('image')->store('/customer_img') : $user->customer->image,
        ]);
        $user->save();

        Alert::toast('Data berhasil di diubah', 'success');
        return redirect()->route('user.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
