<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'customer_code',
        'customer_name',
        'no_telp',
        'address',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'customers';

}
