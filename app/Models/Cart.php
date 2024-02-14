<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'product_title',
        'price',
        'quantity',
        'image',
        'product_id',
        'user_id',

    ];




    public static function getData($id)
    {
        // $cart = self::where('user_id', $id)->paginate(2);
        $cart = self::where('user_id', $id)->get();
        return $cart;
    }
}
