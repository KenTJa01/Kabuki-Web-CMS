<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment_header extends Model
{
    protected $table = "adjustment_headers";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'adj_no',
        'adj_date',
        'flag',
        'created_by',
        'updated_by'
    ];
}
