<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Menyimpan resource baru ke penyimpanan.
     */
    // Menambahkan rekening baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
        ]);

        BankAccount::create($validated);

        return back()->with('success', 'Rekening berhasil ditambahkan.');
    }

    /**
     * Menghapus resource dari penyimpanan.
     */
    // Menghapus data rekening
    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();

        return back()->with('success', 'Rekening berhasil dihapus.');
    }
}
