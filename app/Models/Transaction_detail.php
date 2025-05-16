<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'trs_id',
        'item_id',
        'item_code',
        'item_desc',
        'quantity',
        'total_price_per_item',
        'created_by',
        'updated_by',
    ];

    protected $table = 'transaction_details';

}
