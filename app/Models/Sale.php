<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id', 'id');
    }

    public function partnership()
    {
        return $this->belongsTo(Partnership::class)->withTrashed();
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method' , 'name');
    }

    public function saleStatus()
    {
        return $this->belongsTo(SaleStatus::class, 'status', 'name');
    }

    public static function autogenerateCode($prefix, $date)
    {
        $dateCode = $date->format('Ym');
        $code = $prefix . $dateCode;
        $code_length = strlen($code);
        $count = self::withTrashed()->whereRaw("SUBSTRING(code,1,'$code_length')='$code'")->select(DB::raw('max(CONVERT(SUBSTRING(code,-3,3),UNSIGNED)) as count'))->value('count');
        $count++;
        $code = $code . str_pad($count, 3, '0', STR_PAD_LEFT);

        return $code;
    }
}
