<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Keunggulan;
use App\Models\Lapor;
use App\Models\Lokasi;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konf = Setting::first();

        // Ambil data produk dan kelompokkan berdasarkan kategori_produk
        $produk = Produk::with('kategoriProduk')->get()->groupBy('kategoriProduk.nama_kategori_produk');

        return view('welcome', compact('konf', 'produk'));
    }

    public function cart()
    {
        $konf = Setting::first();
        return view('cart', compact('konf'));
    }

    public function addToCart($productId)
    {
        // Ambil data produk berdasarkan ID
        $product = Produk::find($productId);

        // Cek jika produk ada
        if ($product) {
            // Ambil cart yang ada di session, jika tidak ada buat array kosong
            $cart = session()->get('cart', []);

            // Jika produk sudah ada di cart, tambahkan kuantitasnya
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            } else {
                // Jika produk belum ada di cart, tambahkan produk ke cart
                $cart[$productId] = [
                    'id' => $product->id,
                    'name' => $product->nama_produk,
                    'price' => $product->harga_jual,
                    'image' => asset('file/foto_produk/' . $product->foto_produk),
                    'quantity' => 1
                ];
            }

            // Simpan cart ke session
            session()->put('cart', $cart);

            // Redirect ke halaman cart
            return redirect()->route('cart');
        }

        // Jika produk tidak ditemukan
        return redirect()->route('cart');
    }

    public function removeFromCart($productId)
    {
        // Ambil cart yang ada di session
        $cart = session()->get('cart', []);

        // Jika produk ada di cart, hapus produk tersebut
        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Menghapus produk berdasarkan ID
        }

        // Simpan cart yang sudah diperbarui kembali ke session
        session()->put('cart', $cart);

        // Redirect kembali ke halaman cart setelah produk dihapus
        return redirect()->route('cart')->with('success', ' products have been removed from your cart');
    }

    public function removeAllFromCart()
    {
        // Hapus seluruh produk dari session cart
        session()->forget('cart');

        // Redirect kembali ke halaman cart
        return redirect()->route('cart')->with('success', 'All products have been removed from your cart');
    }

    public function updateCart($id, $quantity)
    {
        // Periksa apakah cart ada di session
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            // Update quantity produk yang dipilih
            $cart[$id]['quantity'] = $quantity;

            // Simpan kembali ke session
            session(['cart' => $cart]);

            // Hitung ulang subtotal dan total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Kirimkan data kembali ke view
            return response()->json([
                'success' => true,
                'total' => number_format($cart[$id]['price'] * $cart[$id]['quantity'], 0, ',', '.'),
                'subtotal' => number_format($total, 0, ',', '.'),
                'total_price' => number_format($total, 0, ',', '.')
            ]);
        }

        return response()->json(['success' => false]);
    }

}
