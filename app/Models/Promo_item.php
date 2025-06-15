<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo_item extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'promo_id',
        'item_id',
        'created_by',
        'updated_by',
    ];

    protected $table = 'promo_items';

}
