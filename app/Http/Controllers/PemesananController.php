<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function index()
    {
        // Fetch all products and group them by kategori_produk
        $produk = Produk::all()->groupBy('kategori_produk');

        // Fetch pemesanan
        $pemesanan = Pemesanan::with('produk')->get();
        $title = 'Data Pemesanan';

        return view('pemesanan.index', compact('pemesanan', 'produk', 'title'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->id_produk);

        // Periksa apakah stok cukup
        if ($request->jumlah > $produk->stok) {
            return redirect()->back()->withErrors(['error' => 'Stok produk tidak mencukupi.']);
        }

        $total_harga = $produk->harga_jual * $request->jumlah;


        Pemesanan::create([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
            'total_harga' => $total_harga,
        ]);

        // Kurangi stok produk
        $produk->stok -= $request->jumlah;
        $produk->save();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil ditambahkan');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        $title = "Detail Produk - $produk->nama_produk";
        return view('produk.show', compact('produk', 'title'));
    }



    public function destroy(Pemesanan $pemesanan)
    {
        // Get the associated product for the order being deleted
        $produk = $pemesanan->produk;

        // Add the quantity from the deleted order back to the product's stock
        $produk->stok += $pemesanan->jumlah;

        // Save the updated product record
        $produk->save();

        // Delete the order
        $pemesanan->delete();

        // Redirect with success message
        return redirect()->back()->with('success', 'Pemesanan berhasil dihapus.');
    }

    public function bayar($id)
    {
        // Ambil pemesanan yang akan dibayar
        $pemesanan = Pemesanan::findOrFail($id);

        // Pastikan status pemesanan adalah "done"
        if ($pemesanan->status != 'done') {
            return redirect()->route('pemesanan.index')->with('error', 'Pemesanan belum selesai.');
        }

        // Tampilkan halaman pembayaran
        $title = 'Transaksi Pembayaran';
        return view('pemesanan.bayar', compact('pemesanan', 'title'));
    }

    public function prosesBayar(Request $request, $id)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        // Ambil pemesanan yang akan dibayar
        $pemesanan = Pemesanan::findOrFail($id);

        // Pastikan jumlah bayar cukup
        if ($request->jumlah_bayar < $pemesanan->total_harga) {
            return redirect()->back()->withErrors(['error' => 'Jumlah bayar kurang.']);
        }

        // Menghitung pengembalian
        $jumlah_kembalian = $request->jumlah_bayar - $pemesanan->total_harga;

        // Update status pemesanan ke "lunas"
        $pemesanan->status = 'lunas';
        $pemesanan->save();

        // Tampilkan pesan sukses
        session()->flash('success', 'Pembayaran berhasil. Kembalian: Rp ' . number_format($jumlah_kembalian, 2));

        // Anda bisa menambahkan logika untuk mencetak struk di sini.
        // Bisa menggunakan library atau API pencetakan struk sesuai kebutuhan.

        return redirect()->route('pemesanan.index');
    }



    public function checkout(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|string|max:10',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }

        foreach ($cart as $id => $item) {
            $produk = Produk::findOrFail($id);

            if ($item['quantity'] > $produk->stok) {
                return redirect()->route('cart')->withErrors(['error' => 'Stok produk tidak mencukupi.']);
            }

            $produk->stok -= $item['quantity'];
            $produk->save();

            Pemesanan::create([
                'id_produk' => $id,
                'jumlah' => $item['quantity'],
                'total_harga' => $item['price'] * $item['quantity'],
                'status' => 'pending',
                'nomor_meja' => $request->nomor_meja,
            ]);
        }

        session()->forget('cart');
        return redirect()->route('cart')->with('success', 'Pemesanan berhasil.');
    }


    public function approve(Request $request, $id)
    {
        $pemesanan = Pemesanan::with('produk')->findOrFail($id);

        // Pastikan pemesanan memiliki produk terkait
        if (!$pemesanan->produk) {
            return redirect()->route('pemesanan.index')->withErrors(['error' => 'Produk tidak ditemukan dalam pemesanan.']);
        }

        // Update status pemesanan
        $pemesanan->status = 'approved';
        $pemesanan->save();

        // Pindahkan ke tabel Kitchen atau Bar berdasarkan kategori produk
        if ($pemesanan->produk->id_kategori_produk == 1) { // Kitchen
            DB::table('kitchen_orders')->updateOrInsert(
                ['pemesanan_id' => $pemesanan->id_pemesanan],
                ['status' => 'approved', 'created_at' => now(), 'updated_at' => now()]
            );
        } elseif ($pemesanan->produk->id_kategori_produk == 2) { // Bar
            DB::table('bar_orders')->updateOrInsert(
                ['pemesanan_id' => $pemesanan->id_pemesanan],
                ['status' => 'approved', 'created_at' => now(), 'updated_at' => now()]
            );
        }

        return redirect()->route('pemesanan.index')->with('success', 'Pesanan berhasil disetujui.');
    }
}
