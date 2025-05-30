<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_movement extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'mov_date',
        'item_id',
        'item_code',
        'quantity',
        'mov_code',
        'ref_no',
        'purch_price',
        'sales_price',
        'created_by',
        'updated_by',
    ];

    protected $table = 'stock_movements';

}
