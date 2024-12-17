<?php

namespace App\Http\Controllers;

use App\Models\KitchenOrder;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class KitchenOrderController extends Controller
{

    public function index()
    {
        $title = 'Data Pesanan Kitchen';
        $kitchenOrders = KitchenOrder::with('pemesanan.produk')->get();
        return view('kitchen.index', compact('kitchenOrders', 'title'));
    }




    public function approve($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Pastikan data sudah ditemukan sebelum membuat record
        KitchenOrder::create([
            'pemesanan_id' => $pemesanan->id_pemesanan,
            'status' => 'approved',
        ]);

        // Hapus dari tabel pemesanan
        $pemesanan->delete();

        return redirect()->route('kitchen.index')->with('success', 'Pesanan telah di-approve untuk Kitchen.');
    }

    public function done($id)
    {
        $order = KitchenOrder::findOrFail($id);
        $order->status = 'done';
        $order->save();

        // Tambahkan data ke kasir
        (new KasirController)->createFromKitchenOrBar($order->pemesanan_id);

        return redirect()->route('kitchen.index')->with('success', 'Pesanan telah selesai dan ditambahkan ke sistem kasir.');
    }
}
