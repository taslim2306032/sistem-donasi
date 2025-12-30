<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\DonationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        // Admin sees all, User/Public sees only active & verified
        if (Auth::check() && Auth::user()->role === 'admin') {
            $donasi = Donasi::latest()->get();
        } else {
            $donasi = Donasi::where('status', 'active')
                ->where('is_verified', true)
                ->latest()
                ->get();
        }
        
        return view('donasi.index', compact('donasi'));
    }

    // ================= CREATE =================
    public function create()
    {
        // Any authenticated user can create a donation
        return view('donasi.create');
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'judul_donasi' => 'required',
            'deskripsi' => 'required',
            'target_donasi' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['donasi_terkumpul'] = 0;
        $data['created_by'] = Auth::id();

        // If Admin -> Active & Verified
        // If User -> Pending & Unverified
        if (Auth::user()->role === 'admin') {
            $data['status'] = 'active';
            $data['is_verified'] = true;
        } else {
            $data['status'] = 'pending';
            $data['is_verified'] = false;
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('donasi', 'public');
        }

        Donasi::create($data);

        if (Auth::user()->role === 'admin') {
            return redirect()->route('donasi.index')->with('success', 'Donasi telah di tambahkan');
        }

        return redirect()->route('donasi.index')->with('success', 'Donasi berhasil diajukan. Menunggu verifikasi admin.');
    }

    // ================= SHOW =================
    public function show($id)
    {
        $donasi = Donasi::findOrFail($id);
        
        // Prevent users from seeing pending donations via direct link (unless they are admin or owner)
        if ($donasi->status !== 'active' || !$donasi->is_verified) {
            if (!Auth::check() || (Auth::user()->role !== 'admin' && Auth::id() !== $donasi->created_by)) {
               abort(404);
            }
        }

        return view('donasi.show', compact('donasi'));
    }

    // ================= DONASI FORM =================
    public function donasiForm($id)
    {
        $donasi = Donasi::findOrFail($id);
        return view('donasi.donasi', compact('donasi'));
    }

    // ================= SIMPAN DONASI =================
    // ================= SIMPAN DONASI (UPLOAD BUKTI) =================
    public function donasiStore(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1000',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
            'pesan' => 'nullable|string|max:500', // Validasi pesan optional
        ]);

        $donasi = Donasi::findOrFail($id);

        // Upload Bukti
        $path = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        // Simpan History dengan status PENDING
        // NOTE: Donasi terkumpul TIDAK ditambah dulu. Nunggu verifikasi admin.
        DonationHistory::create([
            'user_id' => Auth::id(),
            'donasi_id' => $donasi->id,
            'nominal' => $request->nominal,
            'bukti_pembayaran' => $path,
            'status' => 'pending',
            'pesan' => $request->pesan, // Simpan pesan
        ]);

        return redirect()->route('donasi.show', $id)->with('success', 'Donasi di kirimkan dan akan segera di verifikasi');
    }

    // ================= RIWAYAT =================
    public function riwayat()
    {
        $riwayat = DonationHistory::where('user_id', Auth::id())
            ->with('donasi')
            ->latest()
            ->get();

        return view('donasi.riwayat', compact('riwayat'));
    }

    // ================= EDIT =================
    public function edit($id)
    {
        // Middleware handled, but good to be safe
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $donasi = Donasi::findOrFail($id);
        return view('donasi.edit', compact('donasi'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'judul_donasi' => 'required',
            'deskripsi' => 'required',
            'target_donasi' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'required|in:active,pending,completed,expired',
            'is_verified' => 'required|boolean',
        ]);

        $donasi = Donasi::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('donasi', 'public');
        }

        $donasi->update($data);

        return redirect()->route('donasi.index')->with('success', 'Donasi berhasil diperbarui');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        Donasi::findOrFail($id)->delete();
        return redirect()->route('donasi.index')->with('success', 'Donasi berhasil dihapus');
    }

    // ================= ADMIN: LIST PENDING PAYMENTS =================
    public function pending()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $pendingDonations = DonationHistory::where('status', 'pending')
                            ->with(['user', 'donasi'])
                            ->latest()
                            ->get();

        return view('admin.pending', compact('pendingDonations'));
    }

    // ================= ADMIN: VERIFY PAYMENT =================
    public function verify(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $history = DonationHistory::findOrFail($id);

        if ($request->action === 'approve') {
            // 1. Update status history
            $history->status = 'verified';
            $history->save();

            // 2. Tambahkan ke total donasi kampanye
            $donasi = Donasi::findOrFail($history->donasi_id);
            $donasi->donasi_terkumpul += $history->nominal;
            $donasi->save();

            return redirect()->back()->with('success', 'Pembayaran diterima. Dana ditambahkan ke donasi.');
        } elseif ($request->action === 'reject') {
            // Update status history only
            $history->status = 'rejected';
            $history->save();

            return redirect()->back()->with('error', 'Pembayaran ditolak.');
        }

        return redirect()->back();
    }
}
