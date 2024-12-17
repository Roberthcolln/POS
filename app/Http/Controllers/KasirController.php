<?php

namespace App\Http\Controllers;

use App\Models\KasirTransaction;
use App\Models\Pemesanan;
use App\Models\Setting;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $title = 'Sistem Kasir';
        $transactions = KasirTransaction::with(['pemesanan.produk'])->get(); // Pastikan relasi di-load
        return view('kasir.index', compact('transactions', 'title'));
    }


    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        $transaction = KasirTransaction::findOrFail($id);

        if ($request->jumlah_bayar < $transaction->total_harga) {
            return back()->withErrors(['error' => 'Jumlah bayar kurang.']);
        }

        $transaction->jumlah_bayar = $request->jumlah_bayar;
        $transaction->kembalian = $request->jumlah_bayar - $transaction->total_harga;
        $transaction->status = 'paid';
        $transaction->save();

        return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil diselesaikan.');
    }

    public function createFromKitchenOrBar($pemesananId)
    {
        $pemesanan = Pemesanan::findOrFail($pemesananId);

        KasirTransaction::create([
            'pemesanan_id' => $pemesanan->id_pemesanan,
            'total_harga' => $pemesanan->total_harga,
        ]);

        return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil ditambahkan ke sistem kasir.');
    }

    public function printReceipt($id)
    {
        $konf = Setting::first();
        $title = 'Struk Pembayaran';
        $transaction = KasirTransaction::with('pemesanan.produk')->findOrFail($id);

        if ($transaction->status !== 'paid') {
            return redirect()->route('kasir.index')->withErrors(['error' => 'Struk hanya dapat dicetak untuk transaksi yang telah dibayar.']);
        }

        return view('kasir.receipt', compact('transaction', 'title', 'konf'));
    }
}
