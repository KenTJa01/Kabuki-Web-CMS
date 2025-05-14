<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'item_code',
        'item_name',
        'item_desc',
        'price',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'items';

}
