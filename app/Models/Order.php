<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory;
    use Notifiable;


    //text need to bold
    public static function makeTextBold($text)
    {
        return '<b>' . $text . '</b>';
    }
}
