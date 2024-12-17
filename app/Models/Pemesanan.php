<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    protected $fillable = [
        'id_produk',
        'jumlah',
        'total_harga',
        'status',
        'nomor_meja',
    ];
    

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function barOrder() 
    {
        return $this->hasOne(BarOrder::class, 'pemesanan_id', 'id_pemesanan');
    }

    public function kitchenOrder()
    {
        return $this->hasOne(KitchenOrder::class, 'pemesanan_id', 'id_pemesanan');
    }
}
