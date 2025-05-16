<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'item_id',
        'item_code',
        'quantity',
        'so_flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'stocks';

}
