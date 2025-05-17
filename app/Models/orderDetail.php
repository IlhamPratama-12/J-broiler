<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetail extends Model
{
    // Nama tabel di database
    protected $table = 'order_details';

    // Primary key jika selain 'id', ubah sesuai kebutuhan
    protected $primaryKey = 'id';

    // Kalau tidak pakai timestamps (created_at, updated_at), set false
    public $timestamps = false;

    // Jika kamu ingin mengizinkan mass-assignment (opsional)
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price', // tambahkan sesuai kolom di tabel
        'order_date', // jika ada
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }   
}
