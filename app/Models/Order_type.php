<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_type extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'order_type_code',
        'order_type_name',
        'order_type_desc',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'order_types';

}
