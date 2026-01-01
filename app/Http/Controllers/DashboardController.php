<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donasi;
use App\Models\DonationHistory;
use App\Models\User;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard (Admin & User)
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // DATA UNTUK ADMIN
            $totalDonasiTerkumpul = Donasi::sum('donasi_terkumpul');
            // FIX: Hitung Donasi (Uang) yang pending, bukan Kampanye yang pending
            $donasiPerluVerifikasi = DonationHistory::where('status', 'pending')->count();
            $jumlahUser = User::where('role', 'user')->count();
            $jumlahKampanye = Donasi::where('status', 'active')->count();
            
            // 5 Donasi (Uang) Terakhir Masuk
            $transaksiTerbaru = DonationHistory::with(['user', 'donasi'])
                                ->where('status', '!=', 'rejected')
                                ->latest()
                                ->take(5)
                                ->get();

            return view('dashboard', compact(
                'totalDonasiTerkumpul', 
                'donasiPerluVerifikasi', 
                'jumlahUser', 
                'jumlahKampanye',
                'transaksiTerbaru'
            ));
        } else {
            // DATA UNTUK USER
            $totalDonasiSaya = DonationHistory::where('user_id', $user->id)
                                ->where('status', 'verified')
                                ->sum('nominal');
            $riwayatSaya = DonationHistory::where('user_id', $user->id)
                            ->with('donasi')
                            ->latest()
                            ->take(5)
                            ->get();
            
            // Rekomendasi Donasi (yang belum tercapai target)
            $rekomendasiDonasi = Donasi::where('status', 'active')
                                 ->whereRaw('donasi_terkumpul < target_donasi')
                                 ->inRandomOrder() // Acak biar variatif
                                 ->take(3)
                                 ->get();

            return view('dashboard', compact(
                'totalDonasiSaya',
                'riwayatSaya',
                'rekomendasiDonasi'
            ));
        }
    }

    // Menampilkan daftar user (Admin)
    public function users()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users', compact('users'));
    }
}
