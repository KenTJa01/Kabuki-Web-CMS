<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving_detail extends Model
{

    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'rec_id',
        'item_id',
        'item_code',
        'item_desc',
        'unit_price',
        'quantity',
        'created_by',
        'updated_by'
    ];

    protected $table = "receiving_details";

}
