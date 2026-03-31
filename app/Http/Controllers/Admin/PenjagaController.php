<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenjagaController extends Controller
{
    public function index()
    {
        $penjagas = User::where('role', 'penjaga')->latest()->get();
        return view('admin.penjaga.index', compact('penjagas'));
    }

    public function create()
    {
        return view('admin.penjaga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'penjaga'
        ]);

        return redirect()->route('penjaga.index')->with('success', 'Penjaga berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penjaga = User::findOrFail($id);
        return view('admin.penjaga.edit', compact('penjaga'));
    }

    public function update(Request $request, $id)
    {
        $penjaga = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $penjaga->id
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $penjaga->update($data);

        return redirect()->route('penjaga.index')->with('success', 'Penjaga berhasil diupdate');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Penjaga dihapus');
    }
}
