<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenOrder extends Model
{
    use HasFactory;

    protected $fillable = ['pemesanan_id', 'status'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'id_pemesanan');
    }
}
