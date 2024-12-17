<?php

namespace App\Http\Controllers;

use App\Models\BarOrder;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class BarOrderController extends Controller
{

    public function index()
    {
        $title = 'Data Pesanan Bar';
        $barOrders = BarOrder::with('pemesanan.produk')->get();
        return view('bar.index', compact('barOrders', 'title'));
    }



    public function approve($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Pastikan data sudah ditemukan sebelum membuat record
        BarOrder::create([
            'pemesanan_id' => $pemesanan->id_pemesanan,
            'status' => 'approved',
        ]);

        // Hapus dari tabel pemesanan
        $pemesanan->delete();

        return redirect()->route('bar.index')->with('success', 'Pesanan telah di-approve untuk Bar.');
    }

    public function done($id)
    {
        $order = BarOrder::findOrFail($id);
        $order->status = 'done';
        $order->save();

        // Tambahkan data ke kasir
        (new KasirController)->createFromKitchenOrBar($order->pemesanan_id);

        return redirect()->route('bar.index')->with('success', 'Pesanan telah selesai dan ditambahkan ke sistem kasir.');
    }
}
