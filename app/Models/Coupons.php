<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'couponable_type',
        'couponable_id',
    ];

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($totalPrice)
    {
        if ($this->type == 'fixed' && $this->minimum_price >= 50) {
            $discount = $this->value_off;
            $totalPrice = $totalPrice - $discount;
            return $totalPrice;
        } elseif ($this->type == 'percent' && $this->minimum_price >= 100 && $this->minimum_quantity >= 2) {
            $discount = $this->percentage_off / 100 * $totalPrice;
            $totalPrice = $totalPrice - $discount;
            return $totalPrice;
        } elseif ($this->type == 'mixed' && $this->minimum_price >= 200 && $this->minimum_quantity >= 3) {
            $discount = $this->percentage_off / 100 * $totalPrice;
            $totalPrice = $totalPrice - $discount;
            return $totalPrice;
        } elseif ($this->type == 'rejected' && $this->minimum_price >= 1000) {
            $Price = $totalPrice - $this->value_off;
            $discount = $this->percentage_off / 100 * $Price;
            $totalPrice = $Price - $discount;
            return $totalPrice;
        } else {
            return 0;
        }
    }
}
