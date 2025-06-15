<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'promo_code',
        'promo_name',
        'promo_desc',
        'price',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'promos';

}
