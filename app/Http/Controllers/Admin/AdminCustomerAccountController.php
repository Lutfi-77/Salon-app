<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Hash;

class AdminCustomerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customer.index', compact('customers'));
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
        $customer = User::find($id);
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,bmp,png,jpeg,webp',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->role = 'customer';

        $user->customer()->updateOrCreate(["user_id" => $user->id], [
            "phone" => $request->phone,
            "address" => $request->address,
            "image" => $request->hasFile('image') ? $request->file('image')->store('/customer_img') : $user->customer->image,
        ]);
        $user->save();

        Alert::toast('Data berhasil diubah', 'success');
        return redirect()->route('admin.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
