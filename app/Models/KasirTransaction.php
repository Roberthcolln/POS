<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemesanan_id',
        'total_harga',
        'jumlah_bayar',
        'kembalian',
        'status',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'id_pemesanan');
    }
}
