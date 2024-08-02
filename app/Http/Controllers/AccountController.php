<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $account = Account::all();
        return view('account.index', compact('account'));
    }

    public function create()
    {
        return view('account.add');
    }

    public function edit($id)
    {
        $account = Account::find($id);
        return view('account.edit', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required|boolean',
            'role' => 'required',
            'password' => 'required',
        ]);
        $account = Account::find($id);

        $existingaccount = Account::where('username', $request->username)
            ->exists();
        if ($existingaccount) {
            return redirect()->back()->withInput()->withErrors(['username' => 'Sudah terdaftar.']);
        }

        $account->update([
            'username' => $request->username,
            'name' => $request->name,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        return redirect()->route('account.index')->with('success', 'Akun berhasil diubah');
    }

    public function delete($id)
    {
        $account = Account::find($id);
        $account->delete();

        return redirect()->route('account.index')->with('success', 'Akun berhasil dihapus');
    }
}
