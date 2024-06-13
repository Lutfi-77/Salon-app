<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use Illuminate\Support\Facades\Storage;

class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = User::where('role', 'worker')->get();
        // $workers = User::all();
        $title = 'Delete Account!';
        $text = "Yakin mau dihapus?";
        confirmDelete($title, $text);
        return view('admin.account.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $worker = new Worker;
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        $worker->phone = $request->phone;
        $worker->address = $request->address;
        $worker->price = $request->price;
        $worker->user_id = $user->id;
        if ($request->hasFile('image')){
            $picture = $request->file('image')->store('/worker_img');
            $worker->image = $picture;
        }
        $worker->save();

        Alert::toast('Data berhasi ditambahkan', 'success');
        return redirect()->route('admin.account.index');
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
        $worker = User::find($id);
        return view('admin.account.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $user = User::find($id);
        // $worker = Worker::find();
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->role = $request->role;

        $user->worker()->updateOrCreate(["user_id" => $user->id], [
            "phone" => $request->phone,
            "address" => $request->address,
            "price" => $request->price,
            "image" => $request->hasFile('image') ? $request->file('image')->store('/worker_img') : $user->worker->image,
        ]);
        $user->save();

        Alert::toast('Data berhasi ditambahkan', 'success');
        return redirect()->route('admin.account.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if($user){
            if($user->worker && $user->worker->image != null){
                Storage::delete($user->worker->image);
                // dd("masuk");
            }
            $user->delete();
            Alert::toast('Gambar berhasil dihapus', 'success');
            return redirect()->back();
        }else{
            Alert::toast('Gambar tidak tersedia untuk dihapus', 'error');
            return redirect()->back();
        }
    }
}
