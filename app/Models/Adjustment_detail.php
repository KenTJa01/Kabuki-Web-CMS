<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment_detail extends Model
{

    protected $table = "adjustment_details";
    protected $primaryKey = "id";
    protected $fillable = [
        'adj_id',
        'item_id',
        'item_code',
        'item_desc',
        'adj_qty',
        'stock_before_adj',
        'stock_after_adj',
        'reason',
        'created_by',
        'updated_by'
    ];

}
