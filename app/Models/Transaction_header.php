<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_header extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'trs_no',
        'trs_date',
        'work_type_id',
        'order_type_id',
        'payment_type',
        'customer_fullname',
        'address',
        'no_telp',
        'vehicle_number',
        'total_price',
        'promo_id',
        'note',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'transaction_headers';

}
